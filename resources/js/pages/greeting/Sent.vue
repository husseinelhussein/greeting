<template>
    <div class="row">
        <div class="col-md-3" v-for="card of cards" v-if="cards.length">
            <div class="card text-white" :class="'bg-' + getBackground(card.background)">
                <div class="card-body">
                    <h5 class="card-title">{{card.title}}</h5>
                    <p class="card-text">{{card.text}}</p>
                    <p class="card-text"><small>{{card.created_at}}</small></p>
                </div>
            </div>
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
                        <router-link to="/greetings/create">send a card</router-link>
                        to any member!
                    </small>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "SentCards",
    data() {
        return {
            cards: [],
            loading: true,
        }
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
