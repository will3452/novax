<template>
    <div>
        <div class="text-center uppercase font-bold mt-4 mb-2">
            My Skills
        </div>
       <div class="form-control">
        <div class="relative">
            <input v-model="description" type="text" placeholder="Add New Skill Here" class="w-full  rounded pr-16 input input-primary input-bordered">
            <button  @click="addSkill" :class="{'loading':isLoading}" class="absolute top-0 right-0 rounded-l-none btn btn-primary rounded">
                <span class="material-icons">
                        add
                    </span>
            </button>
        </div>
        <ul class="mt-2">
            <li class="p-2 block rounded shadow my-2 flex justify-between" v-for="skill in skills">
                <span v-text="skill.description"></span>
                <button class="btn btn-xs btn-ghost" @click="removeSkill(skill.id)">
                    <span class="material-icons">
                        remove_circle
                    </span>
                </button>
            </li>
        </ul>
        <div v-if="!skills.length" class="text-center p-2 bg-gray-200 text-gray-500 rounded font-bold">
            No Skill Found!
        </div>
        </div>
    </div>
</template>


<script>
export default {
    props: ['userid'],
    data() {
        return {
            skills:[],
            description: '',
            isLoading:false,
        }
    },
    methods: {
        addSkill(){
            this.isLoading = true;
            axios.post('/skills/' + this.userid, {'description' : this.description})
                .then(res=>{
                    this.skills = res.data.skills;
                    this.description = '';
                    this.isLoading = false;
                })
        },
        removeSkill(id) {
            axios.delete(`/skills/${this.userid}/${id}`)
                .then(res=>{
                    this.skills = res.data.skills;
                })
        }
    },
    mounted(){
        axios.get('/skills/' + this.userid)
            .then(res=>{
                this.skills = res.data.skills;
            })
    }
}
</script>
