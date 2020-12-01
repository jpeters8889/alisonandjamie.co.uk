<template>
    <div>{{ value.join(', ') }}</div>
</template>

<script>
    export default {
        props: ['value', 'id'],
    }
</script>
