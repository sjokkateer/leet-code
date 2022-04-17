<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

use function array_key_exists;
use function count;

class MaxIslandArea
{
    public const WATER = 0;
    public const LAND = 1;

    /**
     * @var array<array{self::WATER|self::LAND}>
     */
    private array $grid;

    private int $largestIsland;
    private int $islandArea;

    /**
     * @var array<array<true>>
     */
    private array $visitedTiles;

    /** @param array<array{self::WATER|self::LAND}> $grid */
    public function maxAreaOfIsland(array $grid): int
    {
        $this->grid = $grid;
        $this->largestIsland = 0;
        $this->visitedTiles = [];

        foreach ($this->grid as $rowIndex => $row) {
            foreach ($row as $colIndex => $v) {
                if ($this->isWater($v) || $this->isVisited($rowIndex, $colIndex)) {
                    continue;
                }

                $this->islandArea = 0;
                $this->visit($rowIndex, $colIndex);

                if ($this->islandArea > $this->largestIsland) {
                    $this->largestIsland = $this->islandArea;
                }
            }
        }

        return $this->largestIsland;
    }

    private function isWater(int $value): bool
    {
        return $value === self::WATER;
    }

    private function isVisited(int $row, int $col): bool
    {
        return array_key_exists($row, $this->visitedTiles)
            && array_key_exists($col, $this->visitedTiles[$row]);
    }

    private function visit(int $row, int $col): void
    {
        if (!$this->withinBounds($row, $col)) {
            return;
        }

        if ($this->isWater($this->grid[$row][$col])) {
            return;
        }

        if ($this->isVisited($row, $col)) {
            return;
        }

        $this->visitedTiles[$row][$col] = true;
        $this->islandArea++;

        $this->visitLeft($row, $col);
        $this->visitRight($row, $col);
        $this->visitUp($row, $col);
        $this->visitDown($row, $col);
    }

    private function withinBounds(int $row, int $col): bool
    {
        if ($row < 0) {
            return false;
        }

        if ($row >= count($this->grid)) {
            return false;
        }

        if ($col < 0) {
            return false;
        }

        if ($col >= count($this->grid[$row])) {
            return false;
        }

        return true;
    }

    private function visitLeft(int $row, int $col): void
    {
        $this->visit($row, $col - 1);
    }

    private function visitRight(int $row, int $col): void
    {
        $this->visit($row, $col + 1);
    }

    private function visitUp(int $row, int $col): void
    {
        $this->visit($row - 1, $col);
    }

    private function visitDown(int $row, int $col): void
    {
        $this->visit($row + 1, $col);
    }
}
