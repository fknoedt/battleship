<?php

/**
 * Class TicTacToe sketch
 * This code was implemented during an interview with the screen shared
 * It was required to implement a simple tic-tac-toe board and basic prints, moves and check methods
 */
class TicTacToe
{
    protected $board;

    const AI_TOKEN = 'O';

    /**
     * TicTacToe constructor.
     */
    public function __construct()
    {
        $this->board = [
            1 => [
                1 => '-',
                2 => '-',
                3 => '-',
            ],
            2 => [
                1 => '-',
                2 => '-',
                3 => '-',
            ],
            3 => [
                1 => '-',
                2 => '-',
                3 => '-',
            ],
        ];
    }

    /**
     * Print the current board
     * @return string
     */
    public function print(): string
    {
        $output = '';

        foreach ($this->board as $line => $columns) {

            $output .= implode('|', $columns) . PHP_EOL;

        }

        return $output;
    }

    /**
     * @param $row
     * @param $column
     * @param $token
     */
    public function move($row, $column, $token): void
    {
        if (! in_array($token, ['O', 'X'])) {
            throw new InvalidArgumentException("Invalid Token: {$token}");
        }

        $this->board[$row][$column] = $token;
    }

    /**
     * Return true or false whether the board is full or not
     */
    public function isBoardFull(): bool
    {
        foreach ($this->board as $row => $columns) {

            foreach ($columns as $token) {

                if ($token == '-') {
                    return false;
                }

            }

        }

        return true;
    }

    public function randomAiMove(): void
    {
        $moveMade = false;

        foreach ($this->board as $row => $columns) {

            foreach ($columns as $column => $token) {

                if ($token == '-') {
                    $this->board[$row][$column] = self::AI_TOKEN;
                    $moveMade = true;
                    break 2;
                }

            }

        }

        if (! $moveMade) {
            throw new RuntimeException("Could not make any move");
        }

    }
}

$ttt = new TicTacToe();

echo "1) print an empty board: " . PHP_EOL;
echo $ttt->print();

echo PHP_EOL . PHP_EOL;

echo "2) random manual move: " . PHP_EOL;
$ttt->move(1, 2, 'X');

echo $ttt->print();

echo PHP_EOL . PHP_EOL;

echo "3) Is the board full? ";
echo $ttt->isBoardFull() ? 'yes' : 'no';

echo PHP_EOL . PHP_EOL;

echo "4) Random machine move: " . PHP_EOL;
$ttt->randomAiMove();

echo $ttt->print();
