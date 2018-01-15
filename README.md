AverageColorMatrix
=====

Generates a matrix in desired resolution of average colors of an image.
Can also output result as SVG Markup.

## Demo

[See here](https://htmlpreview.github.io/?https://github.com/dneustadt/average-color-matrix/blob/master/demo/demo.html)

## Usage

Create an Instance of `AverageColorMatrix` passing the absolute path to the image.

Call `get` method of said instance with the x, y resolution. The third
argument expects a boolean (default: `false`). If `true` the output
will be SVG markup.

Returns a nested array of rows and columns with RGB and hex values.
Alternatively returns SVG markup ready to use.

## Example

```php
$matrix = new \AverageColorMatrix\AverageColorMatrix(
    __DIR__ .  DIRECTORY_SEPARATOR . $filename
);
  
$matrix->get(4, 4);
```

Result:

```
array(3) {
  ["y_percent"]=>
  float(25)
  ["x_percent"]=>
  float(25)
  ["tiles"]=>
  array(4) {
    [0]=>
    array(4) {
      [0]=>
      array(4) {
        ["r"]=>
        int(214)
        ["g"]=>
        int(215)
        ["b"]=>
        int(220)
        ["hex"]=>
        string(7) "#d6d7dc"
      }
      [...]
    }
    [...]
  }
}
```

## License

MIT