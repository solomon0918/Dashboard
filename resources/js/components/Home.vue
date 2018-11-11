<template>
    <!-- sidebar-fixed aside-menu-fixed -->
    <div class="app header-fixed">
        <Header></Header>
        <Sidebar></Sidebar>
    </div>
</template>

<style>
body{
    background-image: none;
}
</style>

<script>
import Header from '../components/layouts/Header.vue';
import Sidebar from '../components/layouts/Sidebar.vue';

export default {
    name: 'Home',
    components: {
        Header,
        Sidebar
    }
}
</script>

