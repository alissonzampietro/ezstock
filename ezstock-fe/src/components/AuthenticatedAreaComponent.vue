<template>
    <MenuComponent />
    <slot></slot>
</template>
<script>
import MenuComponent from './MenuComponent.vue';

export default {
    components: {
        MenuComponent
    }
}
</script>