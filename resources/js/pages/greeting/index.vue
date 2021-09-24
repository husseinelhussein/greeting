<template>
    <div class="row">
        <div class="col-md-3" v-for="greeting of greetings">
            <div class="card">
                <img src="https://via.placeholder.com/420x300" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{greeting.title}}</h5>
                    <p class="card-text"></p>
                    <p class="card-text"><small class="text-muted">{{greeting.created_at}}</small></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Greeting",
    data() {
        return {
            greetings: [],
        }
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('api/greetings')
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
}
</script>
