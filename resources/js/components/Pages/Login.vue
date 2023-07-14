<template>
    <div class="px-[20px] absolute top-1/2 w-full lg:w-[800px] lg:right-1/2 lg:translate-x-1/2 -translate-y-1/2">
        <form class="bg-white grid grid-cols-1 md:grid-cols-2 w-full rounded-lg overflow-hidden" @submit="authenticate">
            <div class="hidden lg:block">
                <img src="/assets/login-left-bg.jpg"
                     class="w-full h-full object-cover">
            </div>
            <div class="px-[30px] py-[80px]">
                <p class="text-2xl font-bold mb-[20px]">
                    Log In
                </p>
                <div class="w-full relative mb-[10px]">
                    <input v-model="formData.email"
                           type="email"
                           :class="{'border-red-500' : validationMessages.email}"
                           class="border-black border-b focus:outline-none w-full pl-[34px] py-[6px]"
                           placeholder="Email">
                    <i :class="{'text-red-500' : validationMessages.email}"
                        class="absolute left-0 mt-[14px] ml-[6px] fa-solid fa-user"></i>

                    <div v-if="validationMessages.email" class="text-red-500">
                        {{ validationMessages.email[0] }}
                    </div>
                </div>
                <div class="w-full relative mb-[10px]">
                    <input v-model="formData.password"
                           type="password"
                           :class="{'border-red-500' : validationMessages.password}"
                           class="border-black border-b focus:outline-none w-full pl-[34px] py-[6px]"
                           placeholder="password">
                    <i :class="{'text-red-500' : validationMessages.password}"
                        class="absolute left-0 mt-[14px] ml-[6px] fa-solid fa-lock"></i>

                    <div v-if="validationMessages.password || errorMessage" class="text-red-500">
                        {{ validationMessages.password ? validationMessages.password[0] : errorMessage }}
                    </div>
                </div>
                <div class="w-full flex cursor-pointer items-center mb-[20px]"
                     @click="formData.rememberMe = ! formData.rememberMe">
                    <input v-model="formData.rememberMe"
                           type="checkbox"
                           class="mr-[10px]">
                    Remember Me
                </div>
                <div class="relative">
                    <button type="submit" class="w-full text-center bg-secondary rounded-lg text-white py-[6px] text-lg mb-[2px]">
                        Log in
                    </button>
                    <a href="#" class="focus:outline-none float-right mr-[6px] text-sm">Forgot Password</a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Login",

    data () {
        return {
            api: '/api/login',
            errorMessage: null,
            validationMessages: {},
            formData: {
                email: null,
                password: null,
                rememberMe: false,
            }
        }
    },

    methods: {
        async authenticate (event) {
            this.validationMessages = {}
            this.errorMessage = null

            event.preventDefault()
            await axios.get('/sanctum/csrf-cookie')
            axios.post(this.api, this.formData)
                .then(() => {
                    this.$root.isAuthenticated = true
                    this.$router.push({ name: 'Home' })
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.validationMessages = error.response.data.errors
                    }

                    if (error.response.status === 401) {
                        this.errorMessage = error.response.data.message
                    }
                })
        }
    }
}
</script>
