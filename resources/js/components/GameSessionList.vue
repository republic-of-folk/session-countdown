<template>
    <div>
        <game-session-modal v-on:game_session_edited="onGameSessionEdited"
                            ref="modal"
        ></game-session-modal>

        <table v-if="game_sessions.length"
               class="table table-bordered table-light table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
            </tr>
            </thead>
            <tbody>
            <game-session-list-item v-for="game_session in game_sessions"
                                    v-bind:key="game_session.id"
                                    :session="game_session"
                                    v-on:edit_game_session="open_edit_modal"
            />
            </tbody>
        </table>
        <p v-else>
            No game sessions
        </p>
    </div>
</template>

<script lang="ts">
import Vue from 'vue';
import {Component} from 'vue-property-decorator'
import {GameSession} from '../models/GameSession';
import GameSessionModal from './GameSessionModal.vue';
import GameSessionListItem from './GameSessionListItem.vue';

// noinspection JSUnusedGlobalSymbols
@Component({
    components: {
        GameSessionModal,
        GameSessionListItem,
    },
})
export default class GameSessionList extends Vue {
    game_sessions: Array<GameSession> = [];
    // modal_open: Boolean = false;
    // modal_session: GameSession | null = null;

    mounted() {
        let self = this;
        this.$root.$axios.get('/api/game-session').then(function (response) {
            let data: Array<GameSession> = [];
            response.data.forEach((game_session: GameSession) => {
                data.push(new GameSession(game_session.id, game_session.name, new Date(game_session.event_date)))
            });
            self.game_sessions = data;
        });
    };

    $refs!: {
        modal: GameSessionModal,
    }

    open_edit_modal(session: GameSession) {
        let $modal = (this.$refs.modal as Vue & { open: Function });

        $modal.open(session);
    };

    onGameSessionEdited(new_session_data: GameSession) {
        let new_session = new GameSession(new_session_data.id, new_session_data.name, new Date(new_session_data.event_date));

        let idx = this.game_sessions.findIndex(old_session => old_session.id == new_session.id);
        if (idx >= 0) {
            Vue.set(this.game_sessions, idx, new_session);
        } else {
            this.game_sessions.push(new_session);
        }
    };
};
</script>

<style scoped lang="scss">
</style>
