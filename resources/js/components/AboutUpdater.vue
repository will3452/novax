<template>
    <form>
        <div class="form-control mb-4">
            <div class="text-center uppercase font-bold mt-4 mb-2">
                About me
            </div>
            <textarea v-model="newAbout" @focus="showHelp = true" @blur="updateAbout" name="about" class="textarea rounded h-24 textarea-bordered textarea-primary" placeholder="Write About you here.">{{about}}</textarea>
            <button class="btn btn-sm btn-ghost loading" v-if="isLoading">updating</button>
        </div>
        <span class="text-gray-500 p-2 mt-4 text-sm font-bold" v-if="showHelp">
            Press <kbd class="kbd kbd-xs">Tab</kbd> to save changes!
        </span>
    </form>
</template>

<script>
export default {
    props: ['userid', 'about'],
    data() {
        return {
            isLoading:false,
            newAbout:this.about,
            showHelp:false,
            oldAbout:'',
        }
    },
    methods:{
        updateAbout() {
            this.showHelp = false;
            if(this.newAbout == this.oldAbout || this.newAbout == this.about) {
                return;
            }
            this.isLoading = true;
            axios.post('/profile-save/' + this.userid, {'about':this.newAbout,})
                .then(res=>{
                    if(res.status == 200) {
                        console.log('updated about');
                        this.isLoading = false;
                        this.oldAbout = this.newAbout;
                    }
                })
        }
    }
}
</script>
