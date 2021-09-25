<template>
    <div class="row">
        <div class="col-md-3" v-for="card of cards" v-if="cards.length && !loading">
            <Card :card="card" :edit="card.sender_id === user.id"></Card>
        </div>
        <div class="col-md-12 text-center" v-else-if="loading">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="col-md-12 text-center" v-else>
            <div class="card-body">
                <p class="card-text text-info">You didn't send any cards!</p>
                <p class="card-text">
                    <small class="text-muted">
                        But here is the good news, you can
                        <router-link to="/create">send a card</router-link>
                        to any member!
                    </small>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
import Card from "../../components/Card";
export default {
    name: "SentCards",
    components: {Card},
    data() {
        return {
            cards: [],
            loading: true,
            user: null,
        }
    },
    created() {
        this.user = window.Laravel.user;
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('api/sent')
                .then(response => {
                    if (response.data) {
                        this.cards = response.data.data;
                    } else {
                        this.error = response.data.message
                    }
                    this.loading = false;
                })
                .catch(e => {
                    console.error(e);
                    this.loading = false;
                });
        })
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    },

    methods: {
        getBackground(color){
            let actualColor = "warning";
            switch (color){
                case "green":
                    actualColor = "success";
                    break;
                case "red":
                    actualColor = "danger";
                    break;
            }
            return actualColor;
        }
    }
}
</script>
