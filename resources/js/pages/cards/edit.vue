<template>
    <form v-if="card">
        <div class="mb-3 row">
            <label for="receiver" class="col-sm-2 col-form-label">Send to</label>
            <div class="col-sm-10">
                <input type="email" class="form-control-plaintext disabled" id="receiver" placeholder="john@doe.com" disabled>
                <div id="emailHelp" class="form-text">The receiver's e-mail address</div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="title" v-model="card.title" disabled>
                <p class="form-text text-danger" v-if="error('title')">{{error('title')}}</p>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="text" class="col-sm-2 col-form-label">Text</label>
            <div class="col-sm-10">
                <textarea name="text" id="text" cols="30" rows="10" v-model="card.text" required></textarea>
                <p class="form-text text-danger" v-if="error('text')">{{error('text')}}</p>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="background" class="col-sm-2 col-form-label">Background</label>
            <div class="col-sm-10">
                <select class="form-select" id="background" name="background" aria-label="Background" v-model="card.background">
                    <option value="yellow" selected>Yellow</option>
                    <option value="green">Green</option>
                    <option value="red">Red</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <button type="submit" class="btn btn-primary col-md-4" @click="update">Update</button>
        </div>
    </form>
    <div class="col-md-12 text-center" v-else-if="loading">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="col-md-12 text-center" v-else>
        <div class="card-body">
            <p class="card-text text-info">Card Not found or you are not allowed to edit it!</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditCard",
    data() {
        return {
            card: null,
            loading: true,
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    },
    mounted() {
        this.getCard();
    },
    methods: {
        getCard(){
            this.errors = null;
            this.loading = true;
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/greetings/' + this.$route.params.id)
                .then(res => {
                    this.card = res.data.data;
                    this.loading = false;
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                })
            })
            //window.location.href = "/";
        },
        update(e){
            this.errors = null;
            e.preventDefault();
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.put('/api/greetings/' + this.$route.params.id, this.card)
                    .then(res => {
                        console.log('success', res);
                    })
                    .catch((err) => {
                        if (err.response.status === 422){
                            this.errors = err.response.data.errors;
                        }
                    })
            })
            //window.location.href = "/";
        },
        error(field){
          if(!this.errors) {
              return false;
          }
          const err = Object.keys(this.errors).includes(field);
          if(err){
              return this.errors[field][0];
          }
          return false;
        }
    }
}
</script>
