<template>
    <div v-if="visibility && type === 'success'" class="alert alert-success">
        {{ message }}
    </div>
    <div v-else-if="visibility && type === 'danger'" class="alert alert-danger">
        {{ message }}
    </div>
    <div v-else-if="visibility && type === 'warning'" class="alert alert-warning">
        {{ message }}
    </div>
    <div v-else-if="visibility && type === 'info'" class="alert alert-info">
        {{ message }}
    </div>
</template>

<style>

.alert {
    width: 100%;
    height: 3em;
    max-height: 3em;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1em;
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
        visibility: Boolean,
        type: String,
        message: String
    }
}

</script>