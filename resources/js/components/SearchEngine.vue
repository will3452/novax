<template>
    <form @submit.prevent="submit()">
        <div class="flex-1 lg:flex-none">
        <div class="form-control">
            <input type="text" v-model="keyword" ref="input" name="keyword" placeholder="Search OJT" class="input input-ghost">
            <div class="text-xs text-red-600 font-bold text-center" v-if="hasError">
                Please input the keyword.
            </div>
        </div>
        </div>
        <div class="flex-none">
        <button class="btn btn-square btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            console.log('search mounted.')
        },
        data() {
            return {
                keyword:'',
                hasError:false,
            }
        },
        methods : {
            submit() {
                if(!this.keyword.length) {
                    this.hasError = true;
                    this.$refs.input.focus();
                    return;
                }
                window.location.href = `/jobs?keyword=${this.keyword}`;
            }
        }
    }
</script>
