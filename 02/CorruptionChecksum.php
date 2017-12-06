<?php

/**
 *--- Day 2: Corruption Checksum ---
 *
 * As you walk through the door, a glowing humanoid shape yells in your direction. "You there! Your state appears to be idle. Come help us repair the corruption in this spreadsheet - if we take another millisecond, we'll have to display an hourglass cursor!"
 *
 * The spreadsheet consists of rows of apparently-random numbers. To make sure the recovery process is on the right track, they need you to calculate the spreadsheet's checksum. For each row, determine the difference between the largest value and the smallest value; the checksum is the sum of all of these differences.
 *
 * For example, given the following spreadsheet:
 *
 * 5 1 9 5
 * 7 5 3
 * 2 4 6 8
 * The first row's largest and smallest values are 9 and 1, and their difference is 8.
 * The second row's largest and smallest values are 7 and 3, and their difference is 4.
 * The third row's difference is 6.
 * In this example, the spreadsheet's checksum would be 8 + 4 + 6 = 18.
 *
 * What is the checksum for the spreadsheet in your puzzle input?
 */
class CorruptionChecksum
{
    /** @var SplFileObject */
    private $input;

    /**
     * CorruptionChecksum constructor.
     */
    public function __construct()
    {
        $this->input = new SplFileObject('../inputs/input_02.txt');
    }

    public function getCorruptionChecksum(): int
    {
        $corruptionChecksum = 0;

        while (!$this->input->eof()) {
            $rowValues = preg_replace('/[\t]/', ' ', $this->input->fgets());
            $rowValues = explode(' ', $rowValues);

            $corruptionChecksum += $this->getMaxValue($rowValues) - $this->getMinValue($rowValues);
        }

        return $corruptionChecksum;
    }

    /**
     * @param array $input
     * @return int
     */
    private function getMinValue(array $input): int
    {
        $min = PHP_INT_MAX;

        foreach ($input as $item => $value) {
            if ($value < $min) {
                $min = intval($value);
            }
        }

        return $min;
    }

    /**
     * @param array $input
     * @return int
     */
    private function getMaxValue(array $input): int
    {
        $max = PHP_INT_MIN;

        foreach ($input as $item => $value) {
            if ($value > $max) {
                $max = intval($value);
            }
        }

        return $max;
    }
}