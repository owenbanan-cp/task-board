<template>
    <div class="w-full flex justify-between px-[30px] py-[20px] border-b  bg-[#1a1e24] border-[#303640]">
        <p class="w-fit text-[#afb1b3] text-lg font-bold">Task Board</p>

        <div class="relative" v-click-outside="hideUserPanel">
            <i class="fa-solid fa-circle-user text-3xl text-[#afb1b3] cursor-pointer" @click="showUserPanel = ! showUserPanel"></i>
            <div v-if="showUserPanel" class="text-white bg-[#282828] absolute w-[200px] -ml-[170px] overflow-hidden rounded-lg mt-[8px]">
                <div class="w-full hover:bg-[#333131] cursor-pointer px-[20px] py-[10px]"> Profile</div>
                <hr class="w-full border-b border-[#303640]">
                <div class="w-full hover:bg-[#333131] cursor-pointer px-[20px] py-[10px]" @click="logout">Logout</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TopNavigation",

    data () {
        return {
            showUserPanel: false
        }
    },

    methods: {
        hideUserPanel () {
            if (this.showUserPanel) {
                this.showUserPanel = false
            }
        },

        async logout () {
            await axios.get('/sanctum/csrf-cookie')
            axios.post('/api/logout')
                .then(() => {
                    this.$root.isAuthenticated = false
                    this.$router.push({ name: 'Login' })
                })
        }
    }
}
</script>
