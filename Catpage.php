<?php
/* This file lives in the project root, but it is loaded by the pages inside
   Catpages/ (Oreopage.php, Mochipage.php, Cookiepage.php). The browser resolves
   links and images from the page being viewed (Catpages/xxx.php), so everything
   outside that folder (style.css, Images/, index.php) is reached with ../
   -> that's what $root is for.

   Each cat page just sets $current and loads this template.

   Positions are the CENTER of each star, in % of the 1920x1080 background.
   x,y   = star resting on a closed envelope
   ox,oy = star on the open flap (this goes back home)
   cl    = left edge of that envelope's inside (for your content)          */
$root = '../';

$cats = [
    'oreo'   => ['name' => 'Oreo',   'page' => 'Catpages/Oreopage.php',   'bg' => 'Images/page-oreo.jpeg',   'img' => 'Images/monii.png',  'note' => 'Images/note1.png',  'speech' => 'oreosspeech.wav',
                 'x' => 17.92, 'y' => 25.09, 'ox' => 17.50, 'oy' => 4.35, 'cl' => '1.6%',
                 'bio' => 'This is Oreo, who is wonderfully kind, gentle, and deeply affectionate. She just genuinely likes to be wherever you are, quietly anchoring the room with her presence like a sweet little furry shadow who thinks the world revolves around gentle headbutts.'],
    'mochi'  => ['name' => 'Mochi',  'page' => 'Catpages/Mochipage.php',  'bg' => 'Images/page-mochi.jpeg',  'img' => 'Images/miimi.png',  'note' => 'Images/note2.png',  'speech' => 'mochispeech.wav',
                 'x' => 50.36, 'y' => 25.46, 'ox' => 50.42, 'oy' => 4.35, 'cl' => '34.4%',
                 'bio' => 'This is Mochi, who is fiercely sassy with a perpetually bitchy reaction to minor inconveniences, yet surprises you from time to time with sudden, meltingly sweet cuddle sessions. She will glare at you for breathing too loudly, but five minutes later demand to be spooned.'],
    'cookie' => ['name' => 'Cookie', 'page' => 'Catpages/Cookiepage.php', 'bg' => 'Images/page-cookie.jpeg', 'img' => 'Images/nessa.png',  'note' => 'Images/note3.png',  'speech' => 'cookiespeech.wav',
                 'x' => 83.18, 'y' => 25.83, 'ox' => 83.54, 'oy' => 4.35, 'cl' => '67.2%',
                 'bio' => 'This is Cookie, who is a professional full-time sleeper. She loves nothing more than logging fourteen hours of deep slumber, interspersed strictly with waking up just long enough to judge the neighborhood drama and eavesdrop on your phone conversations.'],
];

if (!isset($current) || !isset($cats[$current])) {
    http_response_code(404);
    exit('Cat page not found.');
}
$me = $cats[$current];

// The cat sits in the middle of the open envelope (cl = its left edge, it is 31% wide).
// Change $catY to move the cat up/down; $noteX/$noteY (below) place the music note.
$catX  = floatval($me['cl']) + 15.5;
$catY  = 70;
$noteX = $catX - 7.2;
$noteY = $catY - 25;
$sound = $root . 'Sounds/' . $me['speech'];   // the cat's speech sound (different from the home page one)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $me['name'] ?>'s Page</title>
    <link rel="stylesheet" href="<?= $root ?>style.css">
</head>
<body>
    <main class="stage" style="background-image: url('<?= $root . $me['bg'] ?>');">

        <?php foreach ($cats as $id => $c): ?>
            <?php if ($id === $current): ?>
                <!-- Star on the open flap: back to the three cats -->
                <a class="star-btn home" href="<?= $root ?>index.php"
                   style="--x: <?= $c['ox'] ?>%; --y: <?= $c['oy'] ?>%;"
                   aria-label="Back to all cats">
                    <img src="<?= $root ?>Images/star.png" alt="">
                </a>
            <?php else: ?>
                <!-- Star on a closed envelope: go to that cat's page -->
                <a class="star-btn" href="<?= $root . $c['page'] ?>"
                   style="--x: <?= $c['x'] ?>%; --y: <?= $c['y'] ?>%;"
                   aria-label="Open <?= $c['name'] ?>'s page">
                    <img src="<?= $root ?>Images/star.png" alt="">
                </a>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- The inside of the open envelope: text goes here -->
        <section class="envelope-content" style="--cl: <?= $me['cl'] ?>;">
            <h1 class="sr-only"><?= $me['name'] ?></h1>
            <p><?= $me['bio'] ?></p>
        </section>

        <!-- Music note: hidden until the cat is clicked -->
        <img class="note" id="note-<?= $current ?>" src="<?= $root . $me['note'] ?>" alt=""
             style="left: <?= $noteX ?>%; top: <?= $noteY ?>%;">

        <!-- Cat button: bounces and plays its sound, same as the home page -->
        <button class="cat-btn" type="button"
                style="left: <?= $catX ?>%; top: <?= $catY ?>%;"
                data-id="<?= $current ?>"
                data-sound="<?= $sound ?>"
                aria-label="Pet <?= $me['name'] ?>">
            <img src="<?= $root . $me['img'] ?>" alt="<?= $me['name'] ?> the cat">
        </button>

    </main>

    <script src="<?= $root ?>script.js"></script>
</body>
</html>