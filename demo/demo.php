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
            }
            .container:hover img {
                display: block;
                opacity: 1;
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
            <div class="container" style="width:800px;height:325px">
                <?php foreach ($resolution['matrix']['tiles'] as $row): ?>
                    <?php foreach ($row as $col): ?>
                        <div class="tile" style="
                            width:<?= $resolution['matrix']['x_percent'] ?>%;
                            height:<?= $resolution['matrix']['y_percent'] ?>%;
                            background:<?= $col['hex'] ?>
                        "></div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <img src="<?= $filename ?>" style="width:800px;height:325px">
            </div>
        <?php endforeach; ?>
    </body>
</html>
