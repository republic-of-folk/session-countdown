<template>
    <div class="modal"
         tabindex="-1"
         v-on="{'show.bs.modal': onModalOpen}"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit game session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control"
                                   placeholder="Event name"
                                   :id="`input-name-${id}`"
                                   v-model="form.name"
                            >
                            <label :for="`input-name-${id}`">Event name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control"
                                   placeholder="2020-01-01"
                                   :id="`input-date-${id}`"
                                   v-model="form.date"
                            >
                            <label :for="`input-date-${id}`">Event date</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control"
                                   placeholder="2020-01-01"
                                   :id="`input-time-${id}`"
                                   v-model="form.time"
                            >
                            <label :for="`input-time-${id}`">Event time</label>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue';
import {GameSession} from '../lib/GameSession';

// noinspection JSUnusedGlobalSymbols
export default Vue.extend({
    name: 'GameSessionModal',
    data() {
        return {
            id: '',
            form: {},
            session: {} as GameSession,
        };
    },
    mounted() {
        // @ts-ignore
        this.id = this._uid;
    },
    methods: {
        onModalOpen() {
            let date_iso = new Date(this.session.event_date).toISOString();
            this.form = {
                id: this.session.id,
                name: this.session.name,
                date: date_iso.slice(0, 10),
                time: date_iso.slice(11, 16),
            };
        },
    },
});
</script>

<style scoped>

</style>
