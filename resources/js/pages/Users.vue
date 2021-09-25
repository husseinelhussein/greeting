<template>
    <div class="row">
        <div class="col-md-3" v-for="user of users">
            <div class="card">
                <img src="https://via.placeholder.com/420x300" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{user.name}}</h5>
                    <p class="card-text"></p>
                    <p class="card-text"><small class="text-muted">{{user.role.name}}</small></p>
                    <p class="card-text"><small class="text-muted">{{user.created_at}}</small></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Users",
    data() {
        return {
            users: [],
        }
    },
    mounted() {
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.get('api/users')
                .then(response => {
                    console.log(response.data)
                    if (response.data) {
                        this.users = response.data.data;
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
    methods: {},
}
</script>
