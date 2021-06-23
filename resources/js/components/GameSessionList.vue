<template>
    <table v-if="game_sessions.length">
        <tr>
            <th>Name</th>
            <th>Date</th>
        </tr>
        <game-session-list-item v-for="game_session in game_sessions"
                                v-bind:key="game_session.id"
                                :session="game_session"/>
    </table>
    <p v-else>
        No game sessions
    </p>
</template>

<script>
export default {
    name: "GameSessionList",
    data() {
        return {
            game_sessions: [],
        }
    },
    mounted() {
        let self = this;
        window.axios.get('/api/game-session').then(function (response) {
            self.game_sessions = response.data;
            console.log(response);
        });
    },
}
</script>

<style scoped lang="scss">
table {
    border: 1px solid black;

    th {
        border-bottom: 1px solid black;
    }

    th {
        &:not(:last-child) {
            border-right: 1px solid black;
        }
    }
}
</style>
