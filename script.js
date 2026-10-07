document.querySelectorAll('.cat-btn').forEach(function (btn) {
    var note  = document.getElementById('note-' + btn.dataset.id);
    var audio = new Audio(btn.dataset.sound);
    audio.preload = 'auto';

    // When the sound finishes, fade the note away
    audio.addEventListener('ended', function () {
        note.classList.remove('show');
        note.classList.add('hide');
    });
    note.addEventListener('animationend', function (e) {
        if (e.animationName === 'noteOut') note.classList.remove('hide');
    });

    btn.addEventListener('click', function () {
        // 1. Cat bounce (remove + reflow so it replays every click)
        btn.classList.remove('bounce');
        void btn.offsetWidth;
        btn.classList.add('bounce');

        // 2. Note appears (restarts its pop-in if already showing)
        note.classList.remove('show', 'hide');
        void note.offsetWidth;
        note.classList.add('show');

        // 3. Play the sound from the start
        audio.currentTime = 0;
        audio.play().catch(function () {
            // If the sound can't play (missing file / blocked), don't leave the note stuck
            note.classList.remove('show');
            note.classList.add('hide');
        });
    });

    btn.querySelector('img').addEventListener('animationend', function () {
        btn.classList.remove('bounce');
    });
});


/* ---------- Star buttons: open the envelope, then go to the page ----------
   Only ONE envelope can be opened. Once a star is clicked, the other stars
   are locked until the page changes (or you come back with the Back button). */
var starLocked = false;

document.querySelectorAll('.star-btn[data-open]').forEach(function (star) {
    var openPic = document.getElementById(star.dataset.open);

    star.addEventListener('click', function (e) {
        // Let ctrl/cmd/middle-click open a new tab normally
        if (e.ctrlKey || e.metaKey || e.shiftKey || e.button !== 0) return;
        e.preventDefault();
        if (starLocked) return;            // another envelope is already open
        starLocked = true;

        // Lock the other two stars (no hover, no click)
        document.querySelectorAll('.star-btn').forEach(function (other) {
            if (other !== star) other.classList.add('locked');
        });

        openPic.classList.add('show');     // flap opens
        star.classList.add('is-open');     // star flies to the top of the flap
        setTimeout(function () { window.location.href = star.href; }, 850);
    });
});

// If the person comes back with the Back button, reset everything
window.addEventListener('pageshow', function () {
    starLocked = false;
    document.querySelectorAll('.open-bg').forEach(function (img) { img.classList.remove('show'); });
    document.querySelectorAll('.star-btn').forEach(function (s) { s.classList.remove('is-open', 'locked'); });
});