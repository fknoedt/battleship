<?php

define('ALPHABET_LIST', ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z']);

/**
 * @param $N
 * @param $S
 * @param $T
 * @return string
 */
function solution($N, $S, $T) {

    // [cell => shipNumber]
    $shipsMap = [];

    // [shipNumber => numberOfHits
    $shipsHit = [];

    // [shipNumber => area]
    $shipsArea = [];

    $ships = explode(',', $S);

    // map all the ships
    foreach ($ships as $shipNumber => $ship) {

        // ships will be numbered starting from 1
        $shipNumber++;

        // start the ship area counter
        $shipsArea[$shipNumber] = 0;

        // let's break everything down...
        $cells = explode(' ', $ship);

        // e.g. "1B", "2C
        list($topLeftCell, $bottomRightCell) = $cells;

        // the regex was not working :facepalm:
        if (strlen($topLeftCell) == 3) {

            $firstRow = $topLeftCell[0] . $topLeftCell[1];
            $firstColumn = $topLeftCell[2];

        } else { // single digit row

            $firstRow = $topLeftCell[0];
            $firstColumn = $topLeftCell[1];

        }

        if (strlen($bottomRightCell) == 3) {

            $lastRow = $bottomRightCell[0] . $bottomRightCell[1];
            $lastColumn = $bottomRightCell[2];

        } else { // single digit row

            $lastRow = $bottomRightCell[0];
            $lastColumn = $bottomRightCell[1];

        }

        $subAlphabet = subAlphabet($firstColumn, $lastColumn, $N);

        // for each of the ship's columns (x-axis)
        foreach ($subAlphabet as $x) {

            // for each of the ship's rows (y-axis)
            for ($y=$firstRow; $y <= $lastRow && $y <= $N; $y++) {

                // current cell being iterated on
                $currentCell = $y . $x;

                // increment ship area
                $shipsArea[$shipNumber]++;

                // map: area => ship
                $shipsMap[$currentCell] = $shipNumber;

            }

        }

    }

    foreach (explode(' ', $T) as $hit) {

        $shipNumber = $shipsMap[$hit] ?? null;

        // the shot hit a ship
        if ($shipNumber) {
            if (! isset($shipsHit[$shipNumber])) {
                $shipsHit[$shipNumber] = 1;
            } else {
                $shipsHit[$shipNumber]++;
            }
        }

    }

    $totalShipsDamaged = 0;
    $totalShipsSunk = 0;

    foreach ($shipsHit as $shipNumber => $hits) {

        if ($hits == $shipsArea[$shipNumber]) {
            $totalShipsSunk++;
        }
        else {
            $totalShipsDamaged++;
        }
    }

    return "{$totalShipsSunk},{$totalShipsDamaged}";

}

/**
 * return a subset of the alfabet starting on $firtsChar and ending on $lastChar
 * @param string $firstChar
 * @param string $lastChar
 * @param int $maxLength
 * @return array
 */
function subAlphabet(string $firstChar, string $lastChar, int $maxLength): array
{
    // control if the characters being iterated are in the required subset
    $state = 0;
    // subset to be returned
    $subAlphabet = [];
    // chars added
    $length = 0;

    // from A to Z
    foreach (ALPHABET_LIST as $char) {

        if ($state == 0) {

            // chars will start to be added
            if ($char == $firstChar) {
                $state = 1;
            }
            // didn't get to the first char yet
            else {
                continue;
            }

        }

        $subAlphabet[] = $char;
        $length++;

        // break in the last character required or max length reached
        if ($char == $lastChar || $length == $maxLength) {
            break;
        }

    }

    return $subAlphabet;
}


echo solution(4, "1B 2C,2D 4D", "2B 2D 3D 4D 4A");
echo PHP_EOL;
echo solution(12, '1A 2A,12A 12A', '12A');
