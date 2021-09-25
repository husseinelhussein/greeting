<template>
    <div class="card text-white" :class="'bg-' + getBackground(card.background)">
        <div class="card-body">
            <h5 class="card-title">{{card.title}}</h5>
            <p class="card-text">{{card.text}}</p>
            <p class="card-text"><small>{{card.created_at}}</small></p>
            <p v-if="edit">
                <router-link :to="'/edit/' + card.id" class="btn btn-primary">Edit</router-link>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Card",
    props: ['card', 'edit'],

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
    },
}
</script>
