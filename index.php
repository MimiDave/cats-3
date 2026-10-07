<?php
// Folder that holds the .wav files (change this if yours is somewhere else)
$soundDir = 'Sounds/';

// All positions are the CENTER of each item, in % of the 1920x1080 background.
// star = closed position, open = where the star lands when the envelope opens.
$envelopes = [
    ['id' => 'oreo',   'cat' => 'Images/oreo.png',   'sound' => $soundDir . 'oreosound.wav',   'page' => 'Catpages/Oreopage.php',   'note' => 'Images/note1.png',
     'catX' => 17.0, 'catY' => 75.3, 'starX' => 17.92, 'starY' => 25.09, 'openX' => 17.50, 'openY' => 4.35, 'noteX' => 9.8,  'noteY' => 50.1, 'open' => 'Images/open1.png'],
    ['id' => 'mochi',  'cat' => 'Images/mochi.png',  'sound' => $soundDir . 'mochisound.wav',  'page' => 'Catpages/Mochipage.php',  'note' => 'Images/note2.png',
     'catX' => 50.0, 'catY' => 75.0, 'starX' => 50.36, 'starY' => 25.46, 'openX' => 50.42, 'openY' => 4.35, 'noteX' => 43.2, 'noteY' => 50.6, 'open' => 'Images/open2.png'],
    ['id' => 'cookie', 'cat' => 'Images/cookie.png', 'sound' => $soundDir . 'cookiesound.wav', 'page' => 'Catpages/Cookiepage.php', 'note' => 'Images/note3.png',
     'catX' => 83.3, 'catY' => 75.4, 'starX' => 83.18, 'starY' => 25.83, 'openX' => 83.54, 'openY' => 4.35, 'noteX' => 76.1, 'noteY' => 50.6, 'open' => 'Images/open3.png'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Choose a Cat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="stage">
        <?php foreach ($envelopes as $e): ?>
            <!-- Envelope-open picture (only this envelope's area is shown; fades in on star click) -->
            <img class="open-bg" id="open-<?= $e['id'] ?>" src="<?= $e['open'] ?>" alt="">

            <!-- Star button (your star.png). Sits on the flap; when clicked it flies to the top of the opened flap -->
            <a class="star-btn" href="<?= $e['page'] ?>" data-open="open-<?= $e['id'] ?>"
               style="--x: <?= $e['starX'] ?>%; --y: <?= $e['starY'] ?>%; --ox: <?= $e['openX'] ?>%; --oy: <?= $e['openY'] ?>%;"
               aria-label="Open <?= ucfirst($e['id']) ?>'s page">
                <img src="Images/star.png" alt="">
            </a>

            <!-- Music note: hidden until its cat is clicked -->
            <img class="note" id="note-<?= $e['id'] ?>" src="<?= $e['note'] ?>" alt=""
                 style="left: <?= $e['noteX'] ?>%; top: <?= $e['noteY'] ?>%;">

            <!-- Cat button -->
            <button class="cat-btn" type="button"
                    style="left: <?= $e['catX'] ?>%; top: <?= $e['catY'] ?>%;"
                    data-id="<?= $e['id'] ?>"
                    data-sound="<?= $e['sound'] ?>"
                    aria-label="Pet <?= ucfirst($e['id']) ?>">
                <img src="<?= $e['cat'] ?>" alt="<?= ucfirst($e['id']) ?> the cat">
            </button>
        <?php endforeach; ?>
    </main>

    <script src="script.js"></script>
</body>
</html>