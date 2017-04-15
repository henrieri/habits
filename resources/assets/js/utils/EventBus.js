import Vue from 'vue';

const EventBus = new Vue();

export default EventBus;

export function toast(message, type = 'success') {

    EventBus.$emit('toast', {
        message,
        type
    });

}