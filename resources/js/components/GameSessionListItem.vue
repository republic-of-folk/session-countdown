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
import {Component} from 'vue-property-decorator'
import {GameSession} from '../models/GameSession';

const GameSessionListItemProps = Vue.extend({
    props: {
        session: {
            type: Object as PropType<GameSession>
        }
    }
});

// noinspection JSUnusedGlobalSymbols
@Component
export default class GameSessionListItem extends GameSessionListItemProps {
};
</script>

<style scoped lang="scss">
</style>
