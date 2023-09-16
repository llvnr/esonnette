<template>
    <div class="Card">
        <div class="Card__counter">{{ counter }}</div>
        <div class="Card__title">{{ title }}</div>
        <div class="Card__infos">
            {{ description }}
        </div>
    </div>
</template>

<style>
.Card {
    background-color: white;
    border: 2px solid #E5E9F0;
    min-height: 150px;
    height: auto;
    max-height: 250px;
    padding: 0.5em;
}

.Card__counter {
    font-size: 3em;
}

.Card__title {
    font-size: 2em;
}

.Card__infos {
    margin-top: 1em;
    text-align: justify;
    margin-right: 3em;
}
</style>

<script>

export default {
    props: {
        counter: null,
        title: null,
        description: null
    }
}
</script>