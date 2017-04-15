<template>
    <transition name="fade">
        <div v-if="show" :class="'toast message is-' + type">
            <div class="message-header">
                <p>{{ type | capitalize }}</p>
                <button @click="show=false" class="delete"></button>
            </div>
            <div class="message-body">
                {{ message }}
            </div>
        </div>
    </transition>
</template>
<style>

</style>
<script>
    import EventBus from '../utils/EventBus';

    export default{

        data() {
            return {
                show: false,
                message: '',
                type: '',
                timeout: null
            }
        },
        created() {
            EventBus.$on('toast', (params) => {
                this.showToast();
                this.message = params.message;
                this.type = params.type;
            });
        },
        methods: {
            showToast() {
                if (this.timeout !== null) {
                    clearTimeout(this.timeout);
                }

                this.show = true;

                this.timeout = setTimeout( () => {

                    this.show = false;
                },5000);
            }
        }

    }
</script>
