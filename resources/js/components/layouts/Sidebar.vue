<template>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link"  href="#">
                            <i class="nav-icon icon-chart"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="nav-icon icon-user"></i> Account</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="nav-icon icon-wrench"></i> Profile
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon icon-list"></i> ToDo</a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <Content></Content>

        <Rightbar></Rightbar>
    </div>
</template>

<script>
import Content from '../layouts/Content.vue';
import Rightbar from '../layouts/Rightbar.vue';

export default {
    name: 'Sidebar',
    components: {
        Content,
        Rightbar
    }
}
</script>

