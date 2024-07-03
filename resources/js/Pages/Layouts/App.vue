<script setup>

</script>

<template>
    <main>
        <div class="header">
            <h1>VM.pl recruitment task</h1>
        </div>
        <div class="content">
            <slot></slot>
        </div>
    </main>
</template>

<style scoped>
.header {
    display: flex;
    width: 100%;
    height: 10%;
    background: linear-gradient(90deg, #000000, #FFD700);
    color: white;
    align-items: center;
    justify-content: center;
    font-size: 1.5em;
}

.content {
    position: relative;
    height: 100vh;
}


.content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('/images/logo.png');
    background-repeat: no-repeat;
    background-position: center;
    background-size: 30%;
    opacity: 0.1;
    z-index: -1;
}
</style>
