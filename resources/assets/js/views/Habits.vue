<template>
    <div>
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
                </tr>
            </thead>
            <tbody>
                <tr v-for="habit in sortedHabits">
                    <td v-for="column in columns">
                        {{ habit[column.key] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    import axios from 'axios';
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
                        key: 'daysCount',
                        label: 'Days done',
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
          sortedHabits: function () {
            return _.orderBy(this.habits, [this.sortKey], [this.sortDirection]);
          }
        },

        created() {
            this.getHabits();
        },

        methods: {
            getHabits: function() {
                axios.get('/api/habits').then(response => this.habits = response.data);
            },
            sortBy: function(sortKey) {

                this.sortDirection = (this.sortKey === sortKey) ? this.sortDirection === 'asc' ? 'desc' : 'asc' : 'asc';

                this.sortKey = sortKey;
            },
        },

        filters: {
            moment: function (ts) {
                return moment.unix(ts).format('MMMM Do, YYYY');
            },
            percentage: function (perc) {
                return Math.round(perc * 100) + '%';
            }
        },

        components:{

        }
    }

</script>