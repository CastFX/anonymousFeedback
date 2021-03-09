<template>
    <div class="container">
        <div class="row py-3">
            <table class="table table-hover" id="feedbackTable">
                <thead>
                <th scope="col">Rank</th>
                <th scope="col">Email</th>
                <th scope="col">Average Rating</th>
                </thead>
                <tbody>
                <tr v-for="user in rankings">
                    <th scope="row">{{user.rank}}</th>
                    <td>{{user.email}} </td>
                    <td>{{user.average}} / 5</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.rankings = this.calculateTopRankings();
    },
    props: ['feedbacks', 'numberOfRankings'],

    data: function() {
        return {
            rankings: []
        }
    },

    methods: {
        calculateTopRankings: function() {
            console.log("here")
            console.log(this.feedbacks)
            let groupedFeedbacks = this.feedbacks.reduce((accumulator, feedback) => {
                accumulator[feedback.email] = [...(accumulator[feedback.email] || []), parseInt(feedback.rating)]
                return accumulator;
            }, {});
            //{email1 : [1,2,3,4], email2: [1,2], email3: [1]}

            return Object.keys(groupedFeedbacks).map(email => {
                let sum = groupedFeedbacks[email].reduce((a, b) => a + b, 0);
                let average = Math.round(sum / groupedFeedbacks[email].length * 100) / 100;
                return {email:email, average:average};
            }).sort((a,b) => {
                return b.average - a.average;
            }).slice(0, this.numberOfRankings)
            .map((el, index) => {
                el.rank = index+1;
                return el;
            });
        }
    }
}
</script>
