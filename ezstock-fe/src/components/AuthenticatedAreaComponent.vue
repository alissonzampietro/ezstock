<template>
    <div class="d-flex justify-content-between">
        <a href="/history">History</a>
        <a href="/search">Search</a>
        <button type="submit" v-on:click="logout()" class="btn btn-danger btn-block mr-10">
                    Log out
        </button>

    </div>
    <slot></slot>
</template>
<script>
export default {
    methods: {
        logout() {
            localStorage.removeItem('token');
            window.location.href = '/login'
        }
    }
}
</script>