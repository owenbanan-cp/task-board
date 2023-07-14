<template>
    <div v-if="showForm">
        <modal>
            <form class="md:w-[400px] xl:w-[500px] rounded-lg overflow-hidden" @submit="submit">
                <div class="w-full text-right bg-[#3b4148] text-2xl px-[20px] py-[6px]">
                    <button class="text-2lx text-white" @click="close">x</button>
                </div>
                <div class="w-full bg-white px-[20px] py-[30px] grid grid-cols-12">
                    <div :class="{'text-red-500' : validationErrors.title}" class="col-span-3 text-lg mb-[10px]">
                        Title
                    </div>
                    <div class="col-span-9 mb-[10px]">
                        <input v-model="formData.title" class="focus:outline-none border-b border-[#3b4148] w-full">
                        <div v-if="validationErrors.title" class="w-full text-red-500">
                            {{ validationErrors.title[0] }}
                        </div>
                    </div>
                    <div :class="{'text-red-500' : validationErrors.title}" class="col-span-3 text-lg mb-[10px]">
                        Due Date
                    </div>
                    <div class="col-span-9 mb-[10px]">
                        <date-picker v-model="formData.dueDate"
                                     input-class="focus:outline-none border-b border-[#3b4148] w-full"
                                     :default-value="formData.dueDate"/>
                        <div v-if="validationErrors.dueDate" class="w-full text-red-500">
                            {{ validationErrors.dueDate[0] }}
                        </div>
                    </div>

                    <div class="col-span-12 text-lg mb-[4px]">
                        Description
                    </div>
                    <div class="col-span-12  mb-[16px]">
                        <textarea v-model="formData.description" class="focus:outline-none rounded-lg border w-full border-[#3b4148] min-h-[200px] px-[6px] py-[4px]"></textarea>
                    </div>
                    <div class="col-span-12">
                        <button type="submit" class=" bg-secondary rounded-lg text-white py-[6px] px-[40px] text-lg mb-[2px] float-right">
                            {{ action === 'create' ? 'Create' : 'Update' }}
                        </button>
                    </div>
                </div>
            </form>
        </modal>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

export default {
    name: "TheTaskForm",

    components: { DatePicker },

    data () {
        return {
            showForm: false,
            action: null,
            validationErrors: {},
            task: null,
            position: null,
            formData: {
                title: null,
                dueDate: new Date,
                description: null,
            }
        }
    },

    created () {
        window.TheTaskForm = this
    },

    methods: {
        close () {
            this.action = null
            this.position = null
            this.task = null
            this.formData = {
                title: null,
                dueDate: new Date,
                description: null,
            }
            this.showForm = false
        },

        create () {
            this.action = 'create'
            this.showForm = true
        },

        edit (resource, position) {
            this.position = position
            this.action = 'edit'
            this.task = resource
            this.formData = {
                title: resource.title,
                dueDate: new Date(resource.dueDate),
                description: resource.description,
            }
            this.showForm = true
        },

        async submit (event) {
            event.preventDefault();

            try {
                if (this.action === 'edit') {
                    await axios.put(this.route, this.formData)
                    this.$store.commit('taskBoard/updateTask', {...this.position, formData: this.formData})
                    window.SuccessNotification.notify('Task successfully updated.')
                }

                if (this.action === 'create') {
                    let response = await axios.post(this.route, this.formData)
                    this.$store.commit('taskBoard/appendInTodo', response.data.data)
                    window.SuccessNotification.notify('Task successfully created.')
                }

                this.close()
            } catch (error) {
                console.log(error)
                if (error.response.status === 422) {
                    this.validationErrors = error.response.data.errors
                }
            }
        },
    },

    computed: {
        route () {
            if (this.action === 'create') {
                return '/api/tasks'
            }

            if (this.action === 'edit') {
                return `/api/tasks/${this.task.id}`
            }
        },
    }
}
</script>

<style scoped>
.mx-datepicker {
    width: 100% !important;
}
</style>
