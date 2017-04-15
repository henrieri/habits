<template>
    <div>
        <div class="view--habits">
            <h1 class="title">Habits</h1>
            <h2 class="subtitle">Your current habits</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th v-for="column in columns">
                            <a v-on:click="sortBy(column.key)">
                                {{ column.label }}
                            </a>
                        </th>
                        <th>
                            Edit
                        </th>
                        <th>
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="habit in sortedHabits">
                        <td v-for="column in columns">
                            {{ filter(column.key, habit[column.key]) }}
                        </td>
                        <td>
                            <router-link :to="'/habits/' + habit.id + '/edit'" class="button is-warning">Edit</router-link>
                        </td>
                        <td>
                            <button @click="deleteHabit(habit.id)" class="button is-danger">Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>

            <router-link to="/habits/create/" class="button is-primary is-pulled-left">Add new habit</router-link>
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
                columns: [
                    {
                        key: 'name',
                        label: 'Habit',
                    },
                    {
                        key: 'started',
                        label: 'Started',
                    },
                    {
                        key: 'points',
                        label: 'Points',
                    },
                    {
                        key: 'daysDone',
                        label: 'Days',
                    },
                    {
                        key: 'consistency',
                        label: 'Consistency',
                    },
                    {
                        key: 'totalPoints',
                        label: 'Total',
                    },

                ],
                sortKey: 'totalPoints',
                sortDirection: 'desc',
            }
        },

        computed: {
          sortedHabits() {
            return _.orderBy(this.habits, [this.sortKey], [this.sortDirection]);
          }
        },

        created() {
            this.fetchHabits();
        },

        methods: {
            fetchHabits() {
                api.get('habits').then(response => this.habits = response.data);

            },
            sortBy(sortKey)  {
                this.sortDirection = (this.sortKey === sortKey) ? this.sortDirection === 'asc' ? 'desc' : 'asc' : 'asc';
                this.sortKey = sortKey;
            },
            deleteHabit(habitId) {
                api.delete('habits/' + habitId).then(() => {
                    this.habits = this.habits.filter(habit => habitId !== habit.id);
                });
            },
            filter(key, value)  {
                switch(key) {
                    case 'started':
                        return moment.unix(value).format('MMMM Do, YYYY');
                    case 'consistency':
                        return Math.round(value * 100) + '%';
                    default:
                    return value;
                }
            }
        }
    }

</script>