<?php

/**
 * Class TicTacToe
 * This was a live coding challenge to
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
$ttt->print();

echo "";
$ttt->move(1, 2, 'X');

echo $ttt->isBoardFull() ? 'yes' : 'no';

while (true) {

    $ttt->randomAiMove();
    echo $ttt->print();

}

/*$ttt->move(1, 2, 'X');

echo $ttt->print();

$ttt->randomAiMove();

echo $ttt->print();*/



