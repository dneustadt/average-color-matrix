AverageColorMatrix
=====

Generates a matrix in desired resolution of average colors of an image.

## Demo

[See here](https://htmlpreview.github.io/?https://github.com/dneustadt/average-color-matrix/blob/master/demo/demo.html)

## Usage

Create an Instance of `AverageColorMatrix` passing the absolute path to the image.

Call `get` method of said instance with the x, y resolution.

Returns a nested array of rows and columns with RGB and hex values.

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
  array(2) {
    [0]=>
    array(2) {
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
    [1]=>
    array(2) {
      [0]=>
      array(4) {
        ["r"]=>
        int(189)
        ["g"]=>
        int(179)
        ["b"]=>
        int(190)
        ["hex"]=>
        string(7) "#bdb3be"
      }
      [...]
    }
  }
}
```

## License

MIT