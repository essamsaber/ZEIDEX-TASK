<template>

    <div class="container">
        <div class="container">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/categories" class="nav-link">Categories</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/products" class="nav-link">Products</router-link>
                    </li>
                </ul>
            </nav><br />
            <router-view></router-view>
        </div>
    </div>

</template>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>


<script>
    import ListAll from './category/Categories';
    export default {
        components: {ListAll},

    }
</script>
