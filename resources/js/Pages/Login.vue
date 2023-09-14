<template>
    <div>
        <a-row type="flex" justify="center" align="middle" style="height:100vh; ">
            <a-col :span="8">
                <a-card title="Welcome to U-VAN Express, Please login.">
                    <a-alert v-for="error in payload.errors" :key="error" :message="error" type="warning" size="small"></a-alert>
                    <a-form-model ref="login" :rules="rules" :model="payload">
                        <a-form-model-item label="Email" prop="email">
                            <a-input type="email" v-model="payload.email"></a-input>
                        </a-form-model-item>
                        <a-form-model-item label="Password" prop="password">
                            <a-input-password v-model="payload.password"></a-input-password>
                        </a-form-model-item>
                        <a-button :loading="payload.processing" type="primary" block @click="login" icon="key">Login</a-button>
                        <a-divider>or</a-divider>
                        <a-button type="secondary" block icon="plus" @click="$inertia.visit('/register')">Register</a-button>
                    </a-form-model>
                </a-card>
            </a-col>
        </a-row>
    </div>
</template>


<script>
export default {
    layout: null,
    data() {
        return {
            payload: this.$inertia.form({
                email:'',
                password: '',
            }),
            rules: {
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
    },
    methods: {
        login () {
            this.$refs['login'].validate((isValid) => {
                this.payload.post('/login', {
                    preserveScroll: true,
                });
            })
        }
    }
}
</script>
