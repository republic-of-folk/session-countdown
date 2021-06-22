var Countdown = require('countdown-js')

const current_game_el = document.querySelector('.current-game');
const game_date_el = current_game_el && current_game_el.querySelector('.game-date');
const game_date = game_date_el && game_date_el.dataset.date;
const countdown_el = current_game_el && current_game_el.querySelector('.game-countdown');

if (game_date && countdown_el) {
    const end = new Date(game_date);
    // noinspection JSUnusedLocalSymbols
    let timer = Countdown.timer(end, function (timeLeft) {
        countdown_el.innerHTML
            = `in ${timeLeft.days} days, ${timeLeft.hours} hours, ${timeLeft.minutes} minutes, ${timeLeft.seconds} seconds`;
    }, function () {
        console.log("Countdown Finished!")
    });
}
