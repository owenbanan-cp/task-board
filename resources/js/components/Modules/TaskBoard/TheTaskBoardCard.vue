<template>
    <div class="mx-[10px] my-[16px] bg-[#4c4f53] px-[16px] py-[6px] text-white rounded-lg" :data-task-id="task.id">
        <div class="flex justify-between w-full mb-[8px]">
            <div class="text-sm">
                <i class="fa-solid fa-list-check mr-[4px]"></i>
                {{ status }}
            </div>
            <div class="w-fit text-right mb-[4px] text-sm">
                <i v-if="expanded" class="fa-solid fa-eye cursor-pointer mr-[6px]" title="Collapse" @click="expanded = false"></i>
                <i v-if="! expanded" class="fa-solid fa-eye-slash cursor-pointer mr-[6px]" title="Expand" @click="expanded = true"></i>
                <i class="fa-solid fa-pencil cursor-pointer mr-[6px]" @click="update"></i>
                <i class="fa-solid fa-trash-can cursor-pointer" @click="deleteTask"></i>
            </div>
        </div>
        <p class="text-2xl">{{ task.title }}</p>
        <p class="italic mb-[6px]">Due on: {{ dueDate }}</p>
        <div v-if="expanded">
            {{ task.description }}
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "TheTaskBoardCard",

    props: {
        task: { required: true },
        status: { required: true },
        taskIndex: { required: true, type: Number},
        columnIndex: { required: true, type: Number},
    },

    data () {
        return {
            expanded: false,
        }
    },

    methods: {
        deleteTask () {
            this.$store.commit('taskBoard/deleteTask', {
                columnIndex: this.columnIndex,
                taskIndex: this.taskIndex
            })

            axios.delete(`/api/tasks/${this.task.id}`)
        },

        update () {
            window.TheTaskForm.edit(this.task, {columnIndex: this.columnIndex, taskIndex: this.taskIndex})
        }
    },

    computed: {
        dueDate () {
            return moment(this.task.dueDate).format('MMM DD, YYYY')
        }
    }
}
</script>
