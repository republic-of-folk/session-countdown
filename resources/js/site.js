import('countdown-js').then(({default: Countdown}) => {

    const create_countdown_timer = (container) => {
        const game_date_el = container.querySelector('.game-date');
        const countdown_el = container.querySelector('.game-countdown');

        const game_date = game_date_el && game_date_el.dataset.date;

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
    };

    const current_game_el = document.querySelector('.current-game');
    if (current_game_el) {
        create_countdown_timer(current_game_el);
    }
    const next_game_el = document.querySelector('.next-game');
    if (next_game_el) {
        create_countdown_timer(next_game_el);
    }

});
