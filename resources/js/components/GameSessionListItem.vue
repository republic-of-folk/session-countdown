<template>
    <tr>
        <td>{{ session.name }}</td>
        <td>{{ session.event_date }}</td>
    </tr>
</template>

<script>
export default {
    name: "GameSessionListItem",
    props: ["session"],
}
</script>

<style scoped lang="scss">
td {
    &:not(:last-child) {
        border-right: 1px solid black;
    }
}
</style>
