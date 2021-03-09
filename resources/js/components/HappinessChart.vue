<template>
    <div id='app' ref="table_div"></div>
</template>

<script>
import {GoogleCharts} from 'google-charts';

export default {
    mounted() {
        GoogleCharts.load(this.drawTable);
        // window.onresize = this.drawTable();
        console.log(this.happinessValues)
    },

    props: ['feedbacks'],

    data: function() {
        return {
            "happinessValues": this.calculateHappinessValues(),
        }
    },
    methods: {
        drawTable: function() {
            let data = GoogleCharts.api.visualization.arrayToDataTable(
                [['Day', 'Average rating for the day']].concat(this.happinessValues)
            );

            let lineChart = new GoogleCharts.api.visualization.LineChart(this.$refs.table_div);

            lineChart.draw(data, {
                showRowNumber: true,
                width: '100%',
                height: '100%',
                legend: { position: 'top' },
                vAxis: {
                    viewWindowMode: 'explicit',
                    viewWindow: {
                        max: 5,
                        min: 0
                    }
                }
            });
        },

        calculateHappinessValues: function() {
            let today = new Date();
            let millisPerDay = 1000*60*60*24;
            let groupedRatings = this.feedbacks.reduce((accumulator, feedback) => {
                let date = new Date(feedback.created_at);
                let diffDays = Math.ceil((today-date) / (millisPerDay));
                if (diffDays <= 15) {
                    let dateKey = new Date(date.toDateString());
                    accumulator[dateKey] = [...(accumulator[dateKey] || []), parseInt(feedback.rating)]
                }
                return accumulator;
            }, {});
            //{date1 : [1,2,3,4], date2: [1,2], date3: [1]}
            console.log(groupedRatings)

            return Object.keys(groupedRatings).sort((date1, date2) => {
                return new Date(date1) - new Date(date2);
            }).map((key) => {
                let sum = groupedRatings[key].reduce((a, b) => a + b, 0);
                let average = Math.round(sum / groupedRatings[key].length * 100) / 100;
                let formatter = new Intl.DateTimeFormat('it', {month: 'short', day: 'numeric'});
                return [formatter.format(new Date(key)), average];
            });
        },
    }
}
</script>
