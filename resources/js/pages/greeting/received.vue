<template>
    <div class="row">
        <div class="col-md-3" v-for="greeting of greetings" v-if="greetings.length">
            <div class="card text-white" :class="'bg-' + getBackground(greeting.background)">
                <div class="card-body">
                    <h5 class="card-title">{{greeting.title}}</h5>
                    <p class="card-text">{{greeting.text}}</p>
                    <p class="card-text"><small>{{greeting.created_at}}</small></p>
                </div>
            </div>
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
export default {
    name: "ReceivedGreetings",
    data() {
        return {
            greetings: [],
        }
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('api/greetings/received')
                .then(response => {
                    if (response.data) {
                        this.greetings = response.data.data;
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
