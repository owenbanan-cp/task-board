<template>
    <div class="container">
        <div class="flex flex-row-reverse w-full px-[30px] py-[20px]">
            <div class="cursor-pointer text-[#afb1b3]" @click="toggleForm">
                <i class="fa-solid fa-plus"></i>
                Add Task
            </div>
        </div>
        <div class="min-w-0 max-w-screen overflow-scroll">
            <div class="flex xl:justify-between">
                <div v-for="(column, columnIndex) in columns" :data-column-id="column.id" :key="columnIndex" class="board flex-shrink-0 xl:shrink bg-[#1a1e24] w-[400px] xl:w-[500px] rounded-lg border h-screen border-2 border-[#303640] overflow-y-scroll mx-[20px]">
                    <div class="text-left bg-[#3b4148] px-[20px] py-[10px]">
                        <p class="text-white text-lg"> {{ column.name }} </p>
                    </div>
                    <draggable @change="(event) => handleChange(event, columnIndex)" class="min-h-[400px]" :list="column.tasks" :options="{group:'people'}">
                        <the-task-board-card v-for="(task, index) in column.tasks"
                                             :status="column.name"
                                             :task.sync="task"
                                             :key="task.id"
                                             :task-index="index"
                                             :column-index="columnIndex"/>
                    </draggable>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TheTaskBoardCard from "./TheTaskBoardCard.vue";
import TheTaskForm from "./TheTaskForm.vue";
import Draggable from "vuedraggable";
import { mapState } from "vuex";

export default {
    name: "TheTaskBoard",

    components: {
        TheTaskBoardCard,
        TheTaskForm,
        Draggable,
    },

    data () {
        return {
            api: '/api/boards',
        }
    },

    created () {
        axios.get(this.api)
            .then(({data: { data }}) => {
                this.$store.commit('taskBoard/syncColumns', data)
            })
    },

    methods: {
        toggleForm () {
            window.TheTaskForm.create()
        },

        handleChange (event, columnIndex) {
            let tasks = this.columns[columnIndex].tasks.map((item) => item.id)
            axios.put(`/api/boards/${this.columns[columnIndex].id}/sync-and-reorder-tasks`, {tasks: tasks})
        }
    },

    computed: {
        ...mapState('taskBoard', {
            columns: state => state.columns
        }),
    },
}
</script>

<style scoped>
.board {
    max-height: calc(100vh - 160px);
    min-height: 400px;
}
</style>
