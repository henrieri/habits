<template>
    <div>
        <h1 class="title">
            Habit: {{ habit.name }}
        </h1>
        <div class="columns">
            <div class="column is-6">
                <div class="control">
                    <label class="label">Habit Name</label>
                    <input :class="'input' + (errors.name ? ' is-danger' : '')" v-model="habit.name" class="input">
                    <p v-if="errors.name" class="help is-danger">{{ errors.name[0] }}</p>
                </div>
                <div class="control">
                    <label class="label">Habit Description</label>
                    <textarea :class="'textarea' + (errors.description ? ' is-danger' : '')" v-model="habit.description" class="textarea">
                    </textarea>
                    <p v-if="errors.description" class="help is-danger">{{ errors.description[0] }}</p>
                </div>
                <div class="control">
                    <label class="label">Points (0 - 100)</label>
                    <input :class="'input' + (errors.points ? ' is-danger' : '')" v-model="habit.points" type="number" class="input">
                    <p v-if="errors.points" class="help is-danger">{{ errors.points[0] }}</p>
                </div>
                <button v-if="habit.id === null" @click="createHabit" class="button is-primary">Create</button>
                <button v-if="habit.id !== null" @click="saveHabit" class="button is-primary">Save</button>
            </div>
            <div class="column is-6" v-if="habit.id !== null" transition="fade">
                <h2 class="subtitle">
                    Reasons for the habit
                </h2>
                <p v-if="habit.reasons.length < 1">
                    There are no reasons to do this habit yet. Make sure to add few so you know why you need to be
                    motivated.
                </p>
                <div class="columns" v-for="reason in habit.reasons">

                    <div class="column is-9">
                        {{ reason.name }}
                    </div>
                    <div class="column is-3">
                        <button @click="deleteReason(reason.id)" class="button is-danger">X</button>
                    </div>
                </div>

                <form @submit.prevent="addReason">
                    <div class="columns">
                        <div class="column is-9">
                            <input :class="'input' + (reasonErrors.name ? ' is-danger' : '')" v-model="newReasonName">
                            <p v-if="reasonErrors.name" class="help is-danger">{{ reasonErrors.name[0] }}</p>
                        </div>
                        <div class="column is-3">
                            <button class="button is-primary">Add</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>

    import api from '../../utils/Api';
    import { toast } from '../../utils/EventBus';

    export default{
        data(){
            return{
                habit: {
                    id: null,
                    name: '',
                    description: '',
                    points: 0,
                    reasons: [],
                },
                errors: {},
                reasonErrors: {},
                newReasonName: ''

            }
        },
        created() {

            if (typeof this.$route.params.id !== 'undefined') {
                this.habit.id = this.$route.params.id;
            }


            if (this.habit.id !== null) {
                this.fetchHabit();
            }
        },
        methods: {
            fetchHabit() {
                api.get('habits/' + this.habit.id).then((response) => this.habit = response.data);
            },

            habitModel() {
                return {
                    name: this.habit.name,
                    description: this.habit.description,
                    points: this.habit.points
                }
            },

            createHabit() {

                api.post('habits', this.habitModel()).then((response) => {

                    toast('Habit created successfully');
                    this.errors = {};
                    this.habit = response.data;

                 }).catch((error) => {

                    this.errors = error.response.data;
                    toast('Errors on creating habit', 'danger');
                });
            },

            saveHabit() {

                api.put('habits/' + this.habit.id, this.habitModel()).then((response) => {

                    toast('Habit updated successfully');
                    this.errors = {};

                }).catch((error) => {

                    this.errors = error.response.data;
                    toast('Errors on saving habit', 'danger');
                });
            },

            deleteReason(reasonId) {
                api.delete('habits/' + this.habit.id + '/reasons/' + reasonId).then(() => {
                    this.habit.reasons = this.habit.reasons.filter( (reason) => {
                        return reason.id !== reasonId
                    });
                });
            },

            addReason() {

                api.post('habits/' + this.habit.id + '/reasons', {
                    name: this.newReasonName
                }).then((response) => {
                    this.reasonErrors = {};
                    this.newReasonName = '';
                    this.habit.reasons.push(response.data);

                }).catch((error) => {

                    this.reasonErrors = error.response.data;

                });
            },

        },
        components:{

        }
    }
</script>
