<?php

/**
 * Test: Palindrome
 * A palindromic number reads the same both ways. The largest palindrome made from the product of two
 * 2-digit numbers is 9009 = 91 × 99.
 * Write a program in any language to find the largest palindrome made from the product of two 3-digit numbers.
 */

/**
 * Return the highest (integer) palindrome possible by multiplying two numbers with $numberOfDigits
 * @param int $numberOfDigits
 * @return int
 */
function higherPalindrome(int $numberOfDigits): int
{
    // let's start with both number as high as possible
    $n1 = (int) str_pad('', $numberOfDigits, "9", STR_PAD_LEFT); // e.g. $numberOfDigits = 3; $n1 = 999

    // current higher palindrome found
    $highestPalindrome = 0;

    // auxiliar variable to allow breaking when no further effort is necessary
    $maxN2Palindrome = 0;

    // $n1 from the maximum number until zero or it hits the highest $n2 that formed a palindrome before (necessarily with a higher $n1, so there's no reason to keep going)
    for ($n1; $n1 > 0 && $n1 > $maxN2Palindrome ; $n1--) {

        // let's try multiplying this number with every n2 equal or below it
        for ($n2=$n1; $n2 > 0 && $n2 > $maxN2Palindrome; $n2--) {

            // find the product...
            $product = (string) ($n1 * $n2);
            // and it's reverse
            $reverseProduct = strrev($product);

            // it's a palindrome, let's see if we had a bigger one before
            if ($product == $reverseProduct) {

                // n2
                if ($n2 > $maxN2Palindrome) {
                    $maxN2Palindrome = $n2;
                }

                if ((int) $product > $highestPalindrome) {

                    $highestPalindrome = (int) $product;

                }

            }

        }

    }

    return $highestPalindrome;
}

for ($i=1; $i < 5; $i++) {
    echo "The highest palindrome from the product of two {$i}-digit numbers is: " . higherPalindrome($i) . PHP_EOL;
}