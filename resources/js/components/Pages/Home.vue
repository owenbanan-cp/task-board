<template>
    <div class="">
        <the-task-form/>

        <the-task-board/>
    </div>
</template>

<script>
import TheTaskBoard from "../Modules/TaskBoard/TheTaskBoard.vue";
import TheTaskForm from "../Modules/TaskBoard/TheTaskForm.vue";

export default {
    name: "Home",

    components: {
        TheTaskForm,
        TheTaskBoard
    }
}
</script>
