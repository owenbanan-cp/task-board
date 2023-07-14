<template>
    <div class="mt-[50px] z-20 absolute w-[340px] md:w-[300px] top-0 right-1/2 translate-x-1/2 md:translate-x-0 md:right-0">
        <TransitionGroup name="list">
            <div v-for="(message, index) in messages" :key="index">
                <div class="mb-[10px] w-full bg-[#6dd791] py-[10px] px-[10px] rounded-lg md:rounded-none overflow-hidden relative">
                    <p class="px-[10px] text-green-700 text-lg">{{ message }}</p>
                </div>
            </div>
        </TransitionGroup>
    </div>
</template>

<script>
export default {
    name: "Success",

    data () {
        return {
            messages: [],
        }
    },

    created() {
        window.SuccessNotification = this
    },

    methods: {
        notify (message) {
            this.messages.push(message)

            setTimeout(() => {
                this.messages.pop()
            }, 2000)
        }
    },
}
</script>

<style scoped>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
</style>
