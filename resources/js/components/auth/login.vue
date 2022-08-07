<template>
    <a-row type="flex" justify="center" align="center">
        <a-col :xs="24" :md="12">
            <a-card title="Login">
                <form :action="login" method="POST" ref="form">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="email" :value="payload.email">
                    <input type="hidden" name="password" :value="payload.password">
                </form>
                <a-form-model :model="payload">
                    <a-form-model-item label="Email" required>
                        <a-input type="email" v-model="payload.email"></a-input>
                    </a-form-model-item>
                    <a-form-model-item label="Password" required>
                        <a-input-password v-model="payload.password"></a-input-password>
                    </a-form-model-item>
                    <a-button type="primary" block @click="submit" :loading="loginLoading">
                        LOGIN
                    </a-button>
                    <a-divider>or</a-divider>
                    <a-button type="link" block @click="gotoRegister">
                        REGISTER
                    </a-button>
                </a-form-model>
            </a-card>
        </a-col>
    </a-row>
</template>

<script>
export default {
    props: ['csrf', 'login', 'register'],
    data () {
        return {
            loginLoading: false,
            payload: {}
        }
    },
    methods: {
        submit () {
            try {
                this.loginLoading = true
                this.$refs.form.submit()
            } catch (err) {
                this.$notification.error(err)
            }
        },
        gotoRegister () {
            window.location.href = this.register
        }
    }
}
</script>
