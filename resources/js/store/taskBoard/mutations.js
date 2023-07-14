export default {
    appendInTodo(state, task) {
        state.columns[0].tasks.unshift(task);
    },

    syncColumns(state, columns) {
        state.columns = columns;
    },

    deleteTask(state, {columnIndex, taskIndex}) {
        state.columns[columnIndex].tasks.splice(taskIndex, 1);
    },

    updateTask(state, {columnIndex, taskIndex, formData}) {
        let task = state.columns[columnIndex].tasks[taskIndex];
        let updatedTask = Object.assign({}, task, formData);
        state.columns[columnIndex].tasks.splice(taskIndex, 1, updatedTask);
        state.columns[columnIndex].tasks[taskIndex] = Object.assign({}, task, formData)
    }
}
