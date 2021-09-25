<template>
    <div class="card text-white" :class="'bg-' + getBackground(card.background)">
        <div class="card-body">
            <h5 class="card-title">{{card.title}}</h5>
            <p class="card-text">{{card.text}}</p>
            <p class="card-text"><small>{{card.created_at}}</small></p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Card",
    props: ['card'],

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
