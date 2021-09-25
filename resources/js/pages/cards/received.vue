<template>
    <div class="row">
        <div class="col-md-3" v-for="card of cards" v-if="cards.length">
            <Card :card="card"></Card>
        </div>
        <div class="col-md-12 text-center" v-else>
            <div class="card-body">
                <p class="card-text text-info">Sorry, no received cards!</p>
                <p class="card-text"><small class="text-muted">Wait for few days, maybe you will get lucky, maybe not :)</small></p>
            </div>
        </div>
    </div>
</template>

<script>
import Card from "../../components/Card";
export default {
    name: "ReceivedCard",
    components: {Card},
    data() {
        return {
            cards: [],
        }
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('api/greetings/received')
                .then(response => {
                    if (response.data) {
                        this.cards = response.data.data;
                    } else {
                        this.error = response.data.message
                    }
                })
                .catch(console.error);
        })
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
