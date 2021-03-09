<template>
    <div class="container">

        <div>
            <div class="row py-1 justify-content-center">
                <h2>Feedbacks for:</h2>
            </div>
            <div class="row py-3 justify-content-center">
                <label>
                    <select v-model="selectedId" @change="loadFeedbacksForCurrentUser">
                        <option v-for="(email, id) in emails" v-bind:value="id">
                            {{ email }}
                        </option>
                    </select>
                </label>
            </div>

        </div>

        <div class="row py-3">
            <table class="table table-hover" id="feedbackTable">
                <thead>
                    <th scope="col">Date</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Description</th>
                </thead>
                <tbody>
                    <tr v-for="feedback in feedbacks">
                        <th scope="row">{{feedback.date}}</th>
                        <td>{{feedback.rating}} / 5</td>
                        <td>{{feedback.description}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(this.emails);
        },

        beforeMount() {
            this.loadFeedbacksForCurrentUser();
        },

        props: ["emails"],
        data() {
            return {
                selectedId: Object.keys(this.emails)[0],
                feedbacks: [],
            }
        },

        methods: {
            loadFeedbacksForCurrentUser() {
                console.log("selectedId: " + this.selectedId);
                axios.get('/feedback/' + this.selectedId)
                    .then(response => {
                        this.feedbacks = response.data.map(item => {
                            return {
                                date: new Date(item.created_at).toLocaleDateString("it-IT"),
                                rating: item.rating,
                                description: item.description
                            }
                        });
                        console.log(this.feedbacks);
                    }).catch(error => {
                        if (error.response) {
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                        } else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.log('Error', error.message);
                        }
                    console.log(error.config);
                })
            },
        }
    }
</script>
