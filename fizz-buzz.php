<?php

define('MAX_NUMBER', 100);

/**
 * Classic FizzBuzz algorithm
 * Prints the numbers from 1 to $maxNumber. For multiples of three, prints 'Fizz'; for multiples of five prints 'Buzz';
 * for multiples of both three and five prints 'FizzBuzz'
 * @param int $maxNumber
 */
function fizzBuzz (int $maxNumber): void
{
    for ($i=1; $i <= $maxNumber; $i++) {

        $output = '';

        if ($i % 3 == 0) {
            $output .= 'Fizz';
        }

        if ($i % 5 == 0) {
            $output .= 'Buzz';
        }

        if ($output == '') {
            $output = (string) $i;
        }

        echo $output . PHP_EOL;

    }
}

fizzBuzz(MAX_NUMBER);
