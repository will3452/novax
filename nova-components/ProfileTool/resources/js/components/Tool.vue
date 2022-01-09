<template>
    <div>
        <heading class="mb-6">Profile</heading>

        <card v-if="!isLoading"
            style="min-height: 300px"
        >
            <div class="flex border-b border-40">
                <div class="px-8 py-6 w-1/3">
                    <label for="position" class="inline-block text-80 pt-2 leading-tight">
                        Name <span class="text-danger text-sm">*</span>
                    </label>
                </div>
                <div class="py-6 px-8 w-11/12">
                    <input v-model="name" id="position" list="position-list" type="text" placeholder="Name" class="w-full form-control form-input form-input-bordered">
                    <small class="text-danger" v-if="!name.length">
                        field is required
                    </small>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="px-8 py-6 w-1/3">
                    <label for="position" class="inline-block text-80 pt-2 leading-tight">
                        Company Name <span class="text-danger text-sm">*</span>
                    </label>
                </div>
                <div class="py-6 px-8 w-11/12">
                    <input v-model="companyName" id="position" list="position-list" type="text" placeholder="Company Name" class="w-full form-control form-input form-input-bordered">
                    <small class="text-danger" v-if="!companyName.length">
                        field is required
                    </small>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="px-8 py-6 w-1/3">
                    <label for="position" class="inline-block text-80 pt-2 leading-tight">
                        Email <span class="text-danger text-sm">*</span>
                    </label>
                </div>
                <div class="py-6 px-8 w-11/12">
                    <input v-model="email" id="position" list="position-list" type="text" placeholder="Email" class="w-full form-control form-input form-input-bordered">
                    <small class="text-danger" v-if="!email.length">
                        field is required
                    </small>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="px-8 py-6 w-1/3">
                    <label for="position" class="inline-block text-80 pt-2 leading-tight">
                        Mobile No. <span class="text-danger text-sm">*</span>
                    </label>
                </div>
                <div class="py-6 px-8 w-11/12">
                    <input v-model="mobileNumber" id="position" list="position-list" type="text" placeholder="Mobile No." class="w-full form-control form-input form-input-bordered">
                    <small class="text-danger" v-if="!mobileNumber.length">
                        field is required
                    </small>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="px-8 py-6 w-1/3">
                    <label for="position" class="inline-block text-80 pt-2 leading-tight">
                        Address <span class="text-danger text-sm">*</span>
                    </label>
                </div>
                <div class="py-6 px-8 w-11/12">
                    <input v-model="address" id="position" list="position-list" type="text" placeholder="Address" class="w-full form-control form-input form-input-bordered">
                    <small class="text-danger" v-if="!address.length">
                        field is required
                    </small>
                </div>
            </div>
            <div class="flex justify-end">
                <div style="width:200px; height:200px;" :style="`background:url('${publicLogo}');background-size:cover; background-position:center;`" class=" bg-90 border border-gray-100 m-4"></div>
            </div>
            <div class="flex border-b border-40">
                <div class="px-8 py-6 w-1/3">
                    <label for="position" class="inline-block text-80 pt-2 leading-tight">
                        Logo <span class="text-danger text-sm">*</span>
                    </label>
                </div>
                <div class="py-6 px-8 w-11/12">
                    <input id="position" list="position-list" type="file" ref="logo" @change="setFile">
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="px-8 py-6 w-1/3">
                    <label for="position" class="inline-block text-80 pt-2 leading-tight">
                        Password
                    </label>
                </div>
                <div class="py-6 px-8 w-11/12">
                    <input id="position" v-model="password" list="position-list" type="password" placeholder="Password" class="w-full form-control form-input form-input-bordered">
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="px-8 py-6 w-1/3">
                    <label for="position" class="inline-block text-80 pt-2 leading-tight">
                        Confirm Password
                    </label>
                </div>
                <div class="py-6 px-8 w-11/12">
                    <input id="position" v-model="cpassword" list="position-list" type="password" placeholder="confirm password" class="w-full form-control form-input form-input-bordered">
                    <small class="text-danger" v-if="password.length && (cpassword != password)">
                        Password is not match!
                    </small>
                </div>
            </div>
            <div class="p-6 text-right">
                <button class="btn btn-primary btn-default" :disabled='hasError' @click="updateProfile">
                    Update Profile
                </button>
            </div>
        </card>
        <div v-if="isLoading">
            Please Wait, Loading...
        </div>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
          title: 'ProfileTool',
        }
    },
    data() {
        return {
            name:'',
            companyName:'',
            email:'',
            password:'',
            cpassword:'',
            mobileNumber:'',
            logo:'',
            isLoading:false,
            address:'',
            file:'',
        };
    },

    mounted() {
        this.isLoading = true;
        axios.get('/nova-vendor/profile-tool/current-user')
            .then(({data})=>{
                this.email = data.email ? data.email : '';
                this.name = data.name ? data.name :'';
                this.companyName = data.company_name ? data.companyName :'';
                this.mobileNumber = data.mobile_number ? data.mobile_number : '';
                this.isLoading = false;
                this.address = data.address != null ? data.address : '';
                this.logo = data.logo ;
            })
            .catch(err=>{
                console.log(err)
            })
    },
    methods: {
        updateProfile() {
            this.isLoading = true;
            const formData = new FormData();
            formData.append('logo', this.file);
            formData.append('name', this.name);
            formData.append('company_name', this.companyName);
            formData.append('mobile_number', this.mobileNumber);
            formData.append('email', this.email);
            formData.append('password', this.password);
            formData.append('address', this.address);
            axios.post('/nova-vendor/profile-tool/update',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress(progress){
                    console.log(progress.loaded)
                }
            }
            )
                .then(({data})=>{
                    this.isLoading = false;
                    window.location.reload();
                })
                .catch(err=>{
                    alert('Something went wrong!');
                })
        },
        setFile() {
            this.file = this.$refs.logo.files[0];
        },

    },
    computed: {
        hasError () {
            if(this.name.length == 0 || this.email.length == 0 || this.address.length == 0) {
                return true;
            }

            if(this.cpassword != this.password) {
                return true;
            }

            return false;
        },
        publicLogo() {
            return '/' + this.logo.replace('public', 'storage');
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
