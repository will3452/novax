<template>
    <a-layout id="components-layout-demo-custom-trigger">
        <a-alert :description="$page.props.message" type="success" :style="{borderRadius: 0}" v-if="$page.props.message"></a-alert>
        <a-layout-header :style="{ width: '100vw', textAlign:'center' }">
            <a-menu
                mode="horizontal"
                theme="dark"
                :style="{ lineHeight: '64px' }"
            >
                <a-menu-item key="1"  @click="$inertia.visit('/dashboard')">
                HOME
                </a-menu-item>
                <a-menu-item key="3"  @click="$inertia.visit('/notifications')">
                NOTIFICATIONS
                </a-menu-item>
                <a-menu-item key="4s"  @click="confirmLogout">
                LOGOUT
                </a-menu-item>
            </a-menu>
        </a-layout-header>
      <a-layout>
        <a-layout-content style="minHeight: 100vh !important; padding: 1em; ">
          <slot></slot>
        </a-layout-content>
      </a-layout>
    </a-layout>
  </template>
  <script>
  export default {
    methods: {
        confirmLogout() {
            let modal = this.$confirm({content: 'Are you sure you want to logout?', onOk: (e) => {
                this.$inertia.visit('/logout');
                modal.destroy()
            }, onCancel() {},})
        },
    },
    data() {
      return {
        collapsed: true,
      };
    },
    mounted() {
      

      setInterval(() => {

        navigator.geolocation.getCurrentPosition(({coords}) => {
          let { latitude, longitude } = coords;
          
        window.axios.post('/location-update', {lat: latitude, lng: longitude, user_id: this.$page.props.user.id});
        }, () => {
          this.$notification.error({message:'Failed to get current position.'})
        })

      }, 1000*2); // 30 seconds
      

      
    }

    
  };
  </script>
