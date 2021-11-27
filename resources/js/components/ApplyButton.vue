<template>
     <form action="#" @submit.prevent="submitApplication">
        <button class="btn" :class="{'loading':isLoading, 'btn-secondary':is_applied, 'btn-primary':!is_applied}">
            <span class="material-icons" v-if="!isLoading" v-text="is_applied ? 'check' : 'upload_file'">
            </span>
            <span v-text="is_applied ? 'Applied': 'Apply now'"></span>
        </button>
        <small v-if="showError" class="text-xs text-red-600 block brea-words">
            You already applied to this offer!
        </small>
    </form>
</template>

<script>
    export default {
        props: ['job_offer_id', 'is_applied'],
        methods : {
            submitApplication() {
                if(this.is_applied) {
                    this.showError = true;
                    this.resetShowError();
                    return false;
                }
                this.isLoading = true;
                axios.post('/applications', {
                    job_offer_id: this.job_offer_id
                }).then((response)=>{
                    if(response.status === 200) {
                        this.is_applied = true;
                    }
                    this.isLoading = false;
                })
            },
            resetShowError() {
                setInterval(() => {
                    this.showError = false;
                }, 3000);
            }
        },
        data() {
            return {
                isLoading:false,
                showError:false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
