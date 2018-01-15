<?php
    require_once __DIR__ . '/../src/AverageColorMatrix.php';

    $filename = 'demo.jpg';

    $matrix = new \AverageColorMatrix\AverageColorMatrix(
        __DIR__ .  DIRECTORY_SEPARATOR . $filename
    );

    $resolutions = [
        [
            'title' => '4 x 4',
            'matrix' => $matrix->get(4, 4),
        ],
        [
            'title' => '16 x 8',
            'matrix' => $matrix->get(16, 8),
        ],
    ];

    $svg = $matrix->get(32, 16, true);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Average Color Matrix</title>
        <style>
            * {
                font-family: sans-serif;
            }
            .container {
                position: relative;
                width: 800px;
                height: 325px;
            }
            .container .tile {
                float: left;
            }
            .container img {
                position: absolute;
                top: 0;
                left: 0;
                opacity: 0;
                transition: all 0.3s ease;
                width: 800px;
                height: 325px;
            }
            .container:hover img {
                display: block;
                opacity: 1;
            }
            .container svg {
                width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body>
        <h1>Average Color Matrix</h1>
        <p>
            Hover over the container to see the source image.
        </p>
        <?php foreach ($resolutions as $resolution): ?>
            <h2><?= $resolution['title'] ?></h2>
            <div class="container">
                <?php foreach ($resolution['matrix']['tiles'] as $row): ?>
                    <?php foreach ($row as $col): ?>
                        <div class="tile" style="
                            width:<?= $resolution['matrix']['x_percent'] ?>%;
                            height:<?= $resolution['matrix']['y_percent'] ?>%;
                            background:<?= $col['hex'] ?>
                        "></div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <img src="<?= $filename ?>">
            </div>
        <?php endforeach; ?>
        <h2>32 x 16 &amp; SVG</h2>
        <div class="container">
            <?= $svg ?>
            <img src="<?= $filename ?>">
        </div>
    </body>
</html>
