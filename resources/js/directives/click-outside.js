import Vue from 'vue';

const clickOutside = {
    bind: function (el, binding, vnode) {
        el.clickOutsideEvent = function (event) {
            // Check if the clicked element is outside the bound element
            if (!(el === event.target || el.contains(event.target))) {
                // Invoke the provided method expression from the component
                vnode.context[binding.expression]();
            }
        };
        document.addEventListener('click', el.clickOutsideEvent);
    },
    unbind: function (el) {
        document.removeEventListener('click', el.clickOutsideEvent);
    }
};

Vue.directive('click-outside', clickOutside);

export default clickOutside;
