<template>
    <div v-if="type === 'success'" class="alert alert-success">
        Message !
    </div>
    <div v-else-if="type === 'danger'" class="alert alert-danger">
        Message !
    </div>
    <div v-else-if="type === 'warning'" class="alert alert-warning">
        Message !
    </div>
    <div v-else-if="type === 'info'" class="alert alert-info">
        Message !
    </div>
</template>

<style>

.alert {
    width: 100%;
    height: 2em;
    max-height: 2em;
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert-success {
    border-left: 5px solid #79AE79;
    background-color: #A8CD5D;
    color: white;
}

.alert-info {
    border-left: 5px solid #076D91;
    background-color: #3397DB;
    color: white;
}

.alert-danger {
    border-left: 5px solid #EA9496;
    background-color: #F79E9F;
    color: white;
}

.alert-warning {
    border-left: 5px solid #DD6137;
    background-color: #F7931D;
    color: white;
}

</style>

<script>

export default {
    props: {
        type: ''
    }
}

</script>