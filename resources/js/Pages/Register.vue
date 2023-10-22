<template>
    <div>
        <a-row type="flex" justify="center" align="middle" style="height:100vh; ">
            <a-col :span="8">
                <a-card  title="Welcome to U-VAN Express, Please register as client.">
                    <a-alert v-for="error in payload.errors" :key="error" :message="error" type="warning" size="small"></a-alert>
                    <a-row>
                            <a-form-model-item label="Mobile No." prop="mobile">
                                <a-row type="flex" :gutter="[6 , 6]">
                                    <a-col :span="20">
                                        <a-input  v-model="payload.mobile"></a-input>
                                    </a-col>
                                    <a-col :span="4">
                                        <a-button @click="sendOtp" :loading="isLoading">
                                            Send OTP
                                        </a-button>
                                    </a-col>
                                </a-row>
                                <a-row type="flex" :gutter="[6 , 6]">
                                    <a-col :span="12">
                                        <a-input  placeholder="Enter Code here" v-model="payload.code"></a-input>
                                    </a-col>
                                    <a-col :span="12">
                                        <a-button type="primary" block>
                                            Continue
                                        </a-button>
                                    </a-col>
                                </a-row>
                            </a-form-model-item>
                        </a-row>
                    <a-form-model :model="payload" :rules="rules" v-if="isVerified">

                        <a-form-model-item label="Name" prop="name">
                            <a-input type="email" v-model="payload.name"></a-input>
                        </a-form-model-item>
                        <a-form-model-item label="Email" prop="email">
                            <a-input type="email" v-model="payload.email"></a-input>
                        </a-form-model-item>
                        <a-form-model-item label="Password" prop="password">
                            <a-input-password v-model="payload.password"></a-input-password>
                        </a-form-model-item>
                        <a-button :disable="payload.processing" @click="save" type="primary" block >REGISTER</a-button>
                        <a-divider>or</a-divider>
                        <a-button type="secondary" block  @click="$inertia.visit('/login')">Already Have An Account?</a-button>
                    </a-form-model>
                </a-card>
            </a-col>
        </a-row>
    </div>
</template>


<script>
export default {
    methods: {
        save() {
            this.payload.post('/register');
        },
        async sendOtp() {
            this.isLoading = true;
            await window.axios.post('/send-otp', {mobile: this.payload.mobile});
            this.isLoading = false;
        }
    },
    data() {
        return {
            isVerified: false,
            isLoading: false,
            payload: this.$inertia.form({
                email: '',
                name: '',
                password: '',
            }),

            rules: {
                name: [
                    {
                            required:true,
                    }
                ],
                email: [
                    {
                            required:true,
                    }
                ],
                password: [
                    {
                        required: true,
                    }
                ]
            },
        }
    }
}
</script>
