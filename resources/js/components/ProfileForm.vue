<template>
    <div>
        <div class="text-center uppercase font-bold mt-4 mb-2">
            Account setting
        </div>
        <form @submit.prevent="submitForm">
            <transition name="fade">
                <i v-if="showWarning" class="block bg-warning p-2 rounded relative">You're not allowed to update your Name And your Email, please contact the system administrator to do so.
                    <span @click="showWarning = false" class="font-bold underlined not-italic btn btn-sm absolute bottom-1 right-1" >close</span>
                </i>
            </transition>
            <div class="mb-3">
                <label for="" class="mb-2 block font-bold uppercase">Name</label>
                <input @click="showWarning = true" class="block p-2 w-full input-primary input-bordered input rounded" type="text" :value="name" readonly placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="" class="mb-2 block font-bold uppercase">Email</label>
                <input @click="showWarning = true" class="block p-2 w-full input-primary input-bordered input rounded" type="text" :value="email" readonly placeholder="Email">
            </div>
            <div class="mb-3" v-if="!isPasswordCorrect">
                <label for="" class="mb-2 block font-bold uppercase">Enter Password <span class="text-xs font-normal">(To change password, please enter the current password)</span></label>
                <div class="flex">
                    <input ref="currentPassword"  class="block p-2 w-full input-primary input-bordered input rounded" type="password" placeholder="Current Password">
                    <button class="btn rounded" type="button" @click="checkIfCorrect">Change</button>
                </div>
                <span class="text-red-500 text-sm" v-if="passwordWrong">Wrong password!</span>
            </div>
            <div class="mb-3" v-if="isPasswordCorrect">
                <div class="alert alert-success" v-if="showSuccessAlert">
                    Great! you may now change your password!
                </div>
                <label for=""  class="mb-2 block font-bold uppercase">New Password</label>
                <input v-model="newPassword" @focus="showSuccessAlert = false" class="block p-2 w-full input-primary input-bordered input rounded" type="password" placeholder="New Password">
            </div>
            <div class="mb-3" v-if="newPassword != ''">
                <label for="" class="mb-2 block font-bold uppercase">Re-Type New Password</label>
                <input v-model="confirmPassword" class="block p-2 w-full input-primary input-bordered input rounded" type="password" placeholder="New Password">
                <span class="text-red-500 text-sm" v-if="!passwordMatched && confirmPassword.length">Password does not matched!</span>
            </div>
            <div class="mb-3">
                <label for="" class="mb-2 block font-bold uppercase">Address</label>
                <input v-model="newAddress" class="block p-2 w-full input-primary input-bordered input rounded"  type="text" placeholder="Address">
            </div>
            <div class="mb-3">
                <label for="" class="mb-2 block font-bold uppercase">Your School</label>
                <input v-model="newSchool" class="block p-2 w-full input-primary input-bordered input rounded"  type="text" placeholder="School">
            </div>
            <div class="mb-3">
                <label for="" class="mb-2 block font-bold uppercase">Your Mobile Number</label>
                <input v-model="newMobile"  class="block p-2 w-full input-primary input-bordered input rounded" type="text" placeholder="Mobile Number">
            </div>
            <div class="text-right">
                <button class="btn btn-primary btn-sm" type="submit">save</button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: [
            'name',
            'email',
            'address',
            'school',
            'mobileNumber'
        ],

        data() {
            return {
                newPassword:'',
                confirmPassword:'',
                showWarning:false,
                isPasswordCorrect:false,
                newAddress:'',
                newSchool:'',
                newMobile:'',
                showSuccessAlert:true,
                passwordWrong:false,
            }
        },

        mounted() {
            this.newAddress = this.address;
            this.newMobile = this.mobileNumber;
            this.newSchool = this.school;
        },

        computed: {
            passwordMatched(){
                return this.newPassword === this.confirmPassword;
            }
        },

        methods: {
            checkIfCorrect(){
                let currentPassword = this.$refs.currentPassword.value;
                axios.post('/check-password', {currentPassword})
                    .then(res=>{
                        this.isPasswordCorrect = res.data;
                        this.passwordWrong = !res.data;
                    })
            },

            submitForm(){

                let newPassword = this.newPassword;
                let newSchool = this.newSchool;
                let newMobile = this.newMobile;
                let newAddress = this.newAddress;

                let payload = {
                        newAddress,
                        newSchool,
                        newMobile,
                };


                if (newPassword.length && this.passwordMatched) {
                    payload = {
                        newPassword,
                        newAddress,
                        newSchool,
                        newMobile,
                    };
                }

                //submit  to the server
                axios.post('/update-account', payload)
                    .then(res=>{
                        console.log(res);
                    })
            }
        }

    }
</script>


<style>
    .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
    }
</style>
