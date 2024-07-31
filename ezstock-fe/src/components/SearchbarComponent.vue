<template>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <input
                type="text"
                class="form-control"
                :placeholder="placeholder"
                v-model="symbol"
            />
        </div>
        <div class="col">
            <button class="btn btn-primary w-100" @click="emitResult">{{ buttonPlaceholder }}</button>
        </div>
    </div>
</div>

</template>

<script>
export default {
    name: 'SearchBarComponent',
    props: {
        placeholder: {
            default: 'Search by symbol'
        },
        buttonPlaceholder: {
            default: 'Search'
        },
    },
    data() {
        return {
            symbol: ''
        }
    },
    methods: {
        emitResult() {
            this.$emit('onSearch', this.symbol);
            this.symbol = ''
        }
    }

}
</script>