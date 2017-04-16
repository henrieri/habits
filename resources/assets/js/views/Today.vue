<template>
    <div>
        <h1 class="title">Today</h1>
        <h2 class="subtitle">Habits you have done today</h2>
        <div class="columns">
            <div class="column is-6">
                <div class="columns">
                    <div class="column is-10">
                        Habit
                    </div>
                    <div class="column is-2">
                        Done
                    </div>
                </div>
                <div class="columns" v-for="habit in habits">
                    <div class="column is-10">
                        {{ habit.name }}
                    </div>
                    <div class="column is-2">
                        <input @click="updateHabitDoneStatus(habit)" class="checkbox" type="checkbox" v-model="habit.isDoneToday">
                        {{ habit.isTodayDone }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import api from '../utils/Api';
    import moment from 'moment';
    import _ from 'lodash';

    export default{
        data(){
            return{

                habits: [],
            }
        },

        computed: {
          sortedHabits() {
            return _.orderBy(this.habits, [this.sortKey], [this.sortDirection]);
          }
        },

        created() {
            this.fetchToday();
        },

        methods: {
            fetchToday() {
                api.get('today').then(response => this.habits = this.enrichHabits(response.data));
            },

            enrichHabits(habits) {
                habits.forEach((habit) => {
                    console.log(habit.today[0]);
                    habit.isDoneToday = typeof habit.today[0] !== 'undefined' && habit.today[0].pivot.fulfilled === 1;
                });

                console.log(habits);

                return habits;
            },

            updateHabitDoneStatus(habit) {
                api.put('today/habits/' + habit.id, {
                    fulfilled: habit.isDoneToday
                });
            }

        },
    }

</script>
