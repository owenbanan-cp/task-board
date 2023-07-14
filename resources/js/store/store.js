import authentication from "./authentication/index";
import taskBoard from "./taskBoard/index";
import Vue from "vue";
import Vuex from 'vuex';

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        authentication: authentication,
        taskBoard: taskBoard,
    }
})
