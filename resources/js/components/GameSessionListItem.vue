<template>
    <tr>
        <td>
            <a href="#" role="button"
               v-on:click="$emit('edit_game_session', session, 123)"
            >
                {{ session.name }}
            </a>
        </td>
        <td>{{ session.date }}</td>
        <td>{{ session.time }}</td>
    </tr>
</template>

<script lang="ts">
import Vue, {PropType} from 'vue';
import {GameSession} from '../models/GameSession';

// noinspection JSUnusedGlobalSymbols
export default Vue.extend({
    name: "GameSessionListItem",
    props: {
        session: {
            type: Object as PropType<GameSession>
        }
    },
});
</script>

<style scoped lang="scss">
</style>
