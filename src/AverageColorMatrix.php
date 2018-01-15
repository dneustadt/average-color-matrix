<?php
/**
 * Copyright (c) 2018
 *
 * @package   Majima
 * @author    David Neustadt <kontakt@davidneustadt.de>
 * @copyright 2018 David Neustadt
 * @license   MIT
 */

namespace AverageColorMatrix;

class AverageColorMatrix
{
    /** @var string */
    private $path;

    /** @var resource */
    private $image;

    /**
     * AverageColorMatrix constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->image = imagecreatefromstring(file_get_contents($path));
    }

    /**
     * @param int $cols
     * @param int $rows
     * @param bool $svg
     * @return string|array
     */
    public function get($cols, $rows, $svg = false)
    {
        list($width, $height) = getimagesize($this->path);

        $tiles = $this->getImageTiles(
            (floor(($height / $rows) * 100) / 100),
            (floor(($width / $cols) * 100) / 100),
            $rows,
            $cols,
            $svg
        );

        if ($svg) {
            return sprintf(
                '<svg viewBox="0 0 %d %d"><g shape-rendering="crispEdges">%s</g></svg>',
                $width,
                $height,
                $tiles
            );
        } else {
            return [
                'y_percent' => (floor((100 / $rows) * 100) / 100),
                'x_percent' => (floor((100 / $cols) * 100) / 100),
                'tiles'     => $tiles,
            ];
        }
    }

    /**
     * @param int $height
     * @param int $width
     * @param int $rows
     * @param int $cols
     * @param bool $svg
     * @return string|array
     */
    private function getImageTiles(
        $height,
        $width,
        $rows,
        $cols,
        $svg
    )
    {
        $tiles = $svg ? '' : [];

        for ($y = 0; $y < $rows; $y++) {
            for ($x = 0; $x < $cols; $x++) {
                $tmp = imagecreatetruecolor(1, 1);

                imagecopyresampled(
                    $tmp,
                    $this->image,
                    0,
                    0,
                    ($x * $width),
                    ($y * $height),
                    1,
                    1,
                    $width,
                    $height
                );

                $rgb = imagecolorat($tmp, 0, 0);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $hex = sprintf("#%02x%02x%02x", $r, $g, $b);

                if ($svg) {
                    $tiles .= sprintf(
                        '<rect x="%g" y="%g" width="%g" height="%g" style="fill:%s;"></rect>',
                        ($x * $width),
                        ($y * $height),
                        $width,
                        $height,
                        $hex
                    );
                } else {
                    $tiles[$y][$x] = [
                        'r'     => $r,
                        'g'     => $g,
                        'b'     => $b,
                        'hex'   => $hex,
                    ];
                }
            }
        }

        return $tiles;
    }
}