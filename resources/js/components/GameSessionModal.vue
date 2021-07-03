<template>
    <div class="modal"
         tabindex="-1"
         v-on="{'show.bs.modal': onShow, 'hide.bs.modal': onHide,}"
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
                    <button type="button" class="btn btn-primary" v-on:click="onSaveClick">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue';
import {Component} from 'vue-property-decorator'
import {GameSession} from '../models/GameSession';
import {Modal} from 'bootstrap';

type GameSessionForm = {
    name: string,
    date: string,
    time: string,
};

// noinspection JSUnusedGlobalSymbols
@Component
export default class GameSessionModal extends Vue {
    id: string = '';
    form: GameSessionForm = {} as GameSessionForm;
    modal?: Modal;
    session: GameSession = {} as GameSession;

    mounted() {
        // @ts-ignore
        this.id = this._uid;
        this.modal = new Modal(this.$el, {});
    }

    public open(game_session: GameSession) {
        this.session = game_session;
        this.modal?.show();
    };

    onSaveClick() {
        this.$root.$axios.put(`/api/game-session/${this.session.id}`, {
            name: this.form.name,
            event_date: new Date(`${this.form.date} ${this.form.time}`),
        }).then((response) => {
            if (response.status == 200) {
                this.$emit('game_session_edited', response.data);
                this.modal?.hide();
            } else {
                // TODO: Show validation errors
                console.log(response);
            }
        });
    }

    onShow() {
        console.log('onShow');
        let date_iso = new Date(this.session.event_date).toISOString();
        this.form = {
            name: this.session.name,
            date: date_iso.slice(0, 10),
            time: date_iso.slice(11, 16),
        };
    }

    onHide() {
        console.log('onHide');
    }
}
</script>

<style scoped>

</style>
