<template>
    <div class="relative min-h-screen min-w-screen bg-page">
        <success-notification/>
        <top-navigation v-if="isAuthenticated"/>

        <router-view></router-view>
    </div>
</template>

<script>
import { mapState} from "vuex";

export default {
    name: "App.vue",

    computed: {
        ...mapState('authentication', {
            isAuthenticated: state => state.isAuthenticated
        })
    }
}
</script>
