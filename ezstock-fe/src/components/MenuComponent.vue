<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded p-3">
        <a class="navbar-brand mg-5" href="/search">EzStock</a>
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/search">Search</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/history">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/chart">Charts</a>
            </li>
            </ul>
        </div>
        <div class="form-inline my-6 ">
            <button class="btn btn-danger mr-2 my-sm-0" v-on:click="logout()">Log out</button>
        </div>
        </nav>
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