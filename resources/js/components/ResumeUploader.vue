<template>
    <div class="card lg:card-side bordered">
    <div class="card-body text-center">
        <div v-if="noresume == 'true'">
            <h2 class="card-title">No Resume Found</h2>
            <p>Please Upload Your resume (PDF format), In order for you to find Job.</p>
        </div>
        <div v-if="noresume != 'true'">
            <h2 class="card-title">Update Your Resume</h2>
            <p class="p-2 rounded w-full md:w-1/2 mx-auto py-4">Your Current Resume : <a :href="resumelink" class="link" target="_blank">click here to view</a></p>
        </div>
        <div class="card-actions flex justify-center">
            <form @submit="isLoading = true" action="/resume" method="POST" enctype="multipart/form-data">
                <slot></slot>
                <div class="form-group">
                    <input type="file" name="file"  required class="form-control border-4 p-4 border-dashed" accept="application/pdf,application/vnd.ms-excel">
                    <div v-if="error !== ''" v-text="error" class="text-xs text-center text-red-600">
                    </div>

                </div>
                <button  :class="{'loading':isLoading}" class="mt-2 px-8 btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props:['error', 'noresume', 'resumelink'],
        data() {
            return {
                isLoading: false
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
