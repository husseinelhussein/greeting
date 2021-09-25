<template>
    <form>
        <div class="mb-3 row">
            <label for="receiver" class="col-sm-2 col-form-label">Send to</label>
            <div class="col-sm-10">
                <input type="email" class="form-control-plaintext" id="receiver" placeholder="john@doe.com" v-model="receiver" required>
                <div id="emailHelp" class="form-text">The receiver's e-mail address</div>
                <p class="form-text text-danger" v-if="error('receiver')">{{error('receiver')}}</p>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="title" v-model="title" required>
                <p class="form-text text-danger" v-if="error('title')">{{error('title')}}</p>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="text" class="col-sm-2 col-form-label">Text</label>
            <div class="col-sm-10">
                <textarea name="text" id="text" cols="30" rows="10" v-model="text" required></textarea>
                <p class="form-text text-danger" v-if="error('text')">{{error('text')}}</p>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="background" class="col-sm-2 col-form-label">Background</label>
            <div class="col-sm-10">
                <select class="form-select" id="background" name="background" aria-label="Background" v-model="background">
                    <option value="yellow" selected>Yellow</option>
                    <option value="green">Green</option>
                    <option value="red">Red</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <button type="submit" class="btn btn-primary col-md-4" @click="create">Create</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "CreateGreeting",
    data() {
        return {
            title: "",
            text: "",
            receiver: "",
            background: "yellow",
            errors: null,
        }
    },
    mounted() {

    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    },
    methods: {
        create(e){
            this.errors = null;
           e.preventDefault();
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/greetings', this.$data)
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
