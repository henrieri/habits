<template>
    <div>
        <h1 class="title">History</h1>
        <table class="table">
            <tr>
                <th>Habit</th>
                <th v-for="day in days">{{ day.label }}</th>
            </tr>
            <tr v-for="habit in habits">
                <td>{{ habit.name }}</td>
                <td :class="isHabitDone(habit, day) ? 'is-success' : 'is-danger'" v-for="day in days">
                    {{ isHabitDone(habit, day) ? habit.points : 0}}
                </td>
            </tr>
            <tr>
                <td>
                    Total points
                </td>
                <td v-for="day in days">
                    {{ totalPoints(day) }}
                </td>
            </tr>
        </table>
    </div>
</template>

<script>

    import api from '../utils/Api';
    import moment from 'moment';
    import _ from 'lodash';

    export default{
        data(){
            return{
                habits: []
            }
        },

        computed: {

            days: () => {
                const dayCount = 7;

                let days = [];

                for (let i = 0; i < 7; i++) {
                    days.push(
                        {
                            value: moment().subtract(i, "days").format("YYYY-MM-DD"),
                            label: moment().subtract(i, "days").format("MMMM Do"),
                        }
                    );
                }



                return days;
            }

        },

        created() {
            this.fetchHistory();
        },

        methods: {
            fetchHistory() {
                api.get('history').then(response => this.habits = response.data);
            },

            isHabitDone(habit, day) {

                let habitDay = habit.days.filter( (habitDay) => {
                    return habitDay.day === day.value;
                });

                if (typeof habitDay[0] === 'undefined') {
                    return false;
                }

                return habitDay[0].pivot.fulfilled === 0 ? false : true;
            },

            totalPoints(day) {

                let totalPoints = 0;

                this.habits.forEach( (habit) => {
                    if (this.isHabitDone(habit, day)) {
                        totalPoints += habit.points;
                    }
                });

                return totalPoints;
            }

        },
    }
</script>

