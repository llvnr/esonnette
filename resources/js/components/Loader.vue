<template>
    <div class="loader"></div>
</template>

<style>
.loader {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 10px solid transparent;
    border-top: 10px solid #3056D3;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>