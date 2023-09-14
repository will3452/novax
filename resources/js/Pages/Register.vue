<template>
    <div>
        <a-row type="flex" justify="center" align="middle" style="height:100vh; ">
            <a-col :span="8">
                <a-card title="Welcome to U-VAN Express, Please register.">
                    <a-form-model :model="payload">
                        <a-form-model-item label="Name" prop="name">
                            <a-input type="email" v-model="payload.name"></a-input>
                        </a-form-model-item>
                        <a-form-model-item label="Email" prop="email">
                            <a-input type="email" v-model="payload.email"></a-input>
                        </a-form-model-item>
                        <a-form-model-item label="Password" prop="password">
                            <a-input-password v-model="payload.password"></a-input-password>
                        </a-form-model-item>
                        <a-button type="primary" block >REGISTER</a-button>
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
    data() {
        return {
            payload: {},
        }
    }
}
</script>
