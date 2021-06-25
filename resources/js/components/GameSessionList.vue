<template>
    <div>
        <game-session-modal ref="modal"></game-session-modal>

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
import {GameSession} from '../lib/GameSession';

// noinspection JSUnusedGlobalSymbols
export default Vue.extend({
    name: "GameSessionList",
    data() {
        return {
            game_sessions: [] as Array<GameSession>,
        }
    },
    mounted() {
        let self = this;
        this.$root.$axios.get('/api/game-session').then(function (response) {
            let data: Array<GameSession> = [];
            response.data.forEach((game_session: GameSession) => {
                data.push(new GameSession(game_session.id, game_session.name, new Date(game_session.event_date)))
            });
            self.game_sessions = data;
        });
    },
    methods: {
        open_edit_modal(session: GameSession) {
            let $modal = (this.$refs.modal as Vue & { session: GameSession });
            $modal.session = session;
            let bs_modal = new this.$bootstrap.Modal($modal.$el, {});
            bs_modal.show();
        }
    },
});
</script>

<style scoped lang="scss">
</style>
