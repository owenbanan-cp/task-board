export default {
    task: (state) => (columnIndex, taskIndex) => {
        return state.columns[columnIndex].tasks[taskIndex]
    }
}
