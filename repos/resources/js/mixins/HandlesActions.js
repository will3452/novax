import { Errors } from 'laravel-nova'

export default {
  props: {
    resourceName: String,

    actions: {},

    pivotActions: {
      default: () => [],
    },

    endpoint: {
      type: String,
      default: null,
    },

    queryString: {
      type: Object,
      default: () => ({
        currentSearch: '',
        encodedFilters: '',
        currentTrashed: '',
        viaResource: '',
        viaResourceId: '',
        viaRelationship: '',
      }),
    },
  },

  data: () => ({
    working: false,
    selectedActionKey: '',
    errors: new Errors(),
    confirmActionModalOpened: false,
  }),

  methods: {
    /**
     * Determine whether the action should redirect or open a confirmation modal
     */
    determineActionStrategy() {
      if (this.selectedAction.withoutConfirmation) {
        this.executeAction()
      } else {
        this.openConfirmationModal()
      }
    },

    /**
     * Confirm with the user that they actually want to run the selected action.
     */
    openConfirmationModal() {
      this.confirmActionModalOpened = true
    },

    /**
     * Close the action confirmation modal.
     */
    closeConfirmationModal() {
      this.confirmActionModalOpened = false
      this.errors = new Errors()
    },

    /**
     * Close the action response modal.
     */
    closeActionResponseModal() {
      this.showActionResponseModal = false
    },

    /**
     * Initialize all of the action fields to empty strings.
     */
    initializeActionFields() {
      _(this.allActions).each(action => {
        _(action.fields).each(field => {
          field.fill = () => ''
        })
      })
    },

    /**
     * Execute the selected action.
     */
    executeAction() {
      this.working = true

      Nova.request({
        method: 'post',
        url: this.endpoint || `/nova-api/${this.resourceName}/action`,
        params: this.actionRequestQueryString,
        data: this.actionFormData(),
      })
        .then(response => {
          this.confirmActionModalOpened = false
          this.handleActionResponse(response.data)
          this.working = false
        })
        .catch(error => {
          this.working = false

          if (error.response.status == 422) {
            this.errors = new Errors(error.response.data.errors)
            Nova.error(this.__('There was a problem executing the action.'))
          }
        })
    },

    /**
     * Gather the action FormData for the given action.
     */
    actionFormData() {
      return _.tap(new FormData(), formData => {
        formData.append('resources', this.selectedResources)

        _.each(this.selectedAction.fields, field => {
          field.fill(formData)
        })
      })
    },

    /**
     * Handle the action response. Typically either a message, download or a redirect.
     */
    handleActionResponse(data) {
      let execute = callback => {
        this.$emit('actionExecuted')
        Nova.$emit('action-executed')

        if (typeof callback === 'function') {
          callback()
        }
      }

      if (data.modal) {
        execute(() => {
          this.actionResponseData = data
          this.showActionResponseModal = true
        })
      } else if (data.message) {
        execute(() => {
          Nova.success(data.message)
        })
      } else if (data.deleted) {
        execute()
      } else if (data.danger) {
        execute(() => {
          Nova.error(data.danger)
        })
      } else if (data.download) {
        execute(() => {
          let link = document.createElement('a')
          link.href = data.download
          link.download = data.name
          document.body.appendChild(link)
          link.click()
          document.body.removeChild(link)
        })
      } else if (data.redirect) {
        window.location = data.redirect
      } else if (data.push) {
        this.$router.push(data.push)
      } else if (data.openInNewTab) {
        execute(() => {
          window.open(data.openInNewTab, '_blank')
        })
      } else {
        execute(() => {
          Nova.success(this.__('The action ran successfully!'))
        })
      }
    },
  },

  computed: {
    /**
     * Get the query string for an action request.
     */
    actionRequestQueryString() {
      return {
        action: this.selectedActionKey,
        pivotAction: this.selectedActionIsPivotAction,
        search: this.queryString.currentSearch,
        filters: this.queryString.encodedFilters,
        trashed: this.queryString.currentTrashed,
        viaResource: this.queryString.viaResource,
        viaResourceId: this.queryString.viaResourceId,
        viaRelationship: this.queryString.viaRelationship,
      }
    },

    /**
     * Get all of the available actions.
     */
    allActions() {
      return this.actions.concat(this.pivotActions.actions)
    },

    /**
     * Return the selected action being executed.
     */
    selectedAction() {
      if (this.selectedActionKey) {
        return _.find(this.allActions, a => a.uriKey == this.selectedActionKey)
      }
    },

    /**
     * Determine if the selected action is a pivot action.
     */
    selectedActionIsPivotAction() {
      return (
        this.hasPivotActions &&
        Boolean(
          _.find(this.pivotActions.actions, a => a === this.selectedAction)
        )
      )
    },

    /**
     * Get all of the available actions for the resource.
     */
    availableActions() {
      return _(this.actions)
        .filter(action => {
          return this.selectedResources.length > 0 && !action.standalone
        })
        .value()
    },

    /**
     * Get all of the available actions for the resource.
     */
    availableStandaloneActions() {
      return _(this.actions)
        .filter(action => {
          return action.standalone
        })
        .value()
    },

    /**
     * Get all of the available pivot actions for the resource.
     */
    availablePivotActions() {
      return _(this.pivotActions.actions)
        .filter(action => {
          if (this.selectedResources.length == 0) {
            return action.standalone
          }

          if (this.selectedResources != 'all') {
            return true
          }

          return action.availableForEntireResource
        })
        .value()
    },

    /**
     * Determine whether there are any pivot actions
     */
    hasPivotActions() {
      return this.availablePivotActions.length > 0
    },
  },
}
