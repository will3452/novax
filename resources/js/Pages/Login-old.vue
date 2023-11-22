<template>
    <div>
        <a-row type="flex"  align="middle" style="height:100vh; " :gutter="[18, 18]">
            <a-col  :md="12"  :sm="24" v-if="bp.breakpoint != 'xs' && bp.breakpoint != 'sm'" style="background: url('/login.png'); height: 100%; background-position: center;background-size: cover;" >
            </a-col>
            <a-col :md="12" style="padding: 2em;" :sm="24">
                <h1>Welcome to U-Van express! </h1>
                <a-alert v-for="error in payload.errors" :key="error" :message="error" type="warning" size="small"></a-alert>
                    <a-form-model ref="login" :rules="rules" :model="payload">
                        <a-form-model-item label="Email" prop="email">
                            <a-input size="large" type="email" v-model="payload.email"></a-input>
                        </a-form-model-item>
                        <a-form-model-item label="Password" prop="password">
                            <a-input-password size="large" v-model="payload.password"></a-input-password>
                        </a-form-model-item>
                        <a-button size="large" :loading="payload.processing" type="primary" block @click="login" icon="key">Login</a-button>
                        <a-divider>or</a-divider>
                        <a-button size="large" type="secondary" block icon="plus" @click="$inertia.visit('/register')">Register</a-button>
                    </a-form-model>
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
