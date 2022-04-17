<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

use function array_key_exists;
use function count;

class IslandFinding
{
    public const WATER = '0';
    public const LAND = '1';

    /**
     * @var array<array{self::WATER|self::LAND}>
     */
    private array $grid;

    private int $numberOfIslands;

    /**
     * @var array<array<true>>
     */
    private array $visitedTiles;

    /** @param array<array{self::WATER|self::LAND}> $grid */
    public function numIslands(array $grid): int
    {
        $this->grid = $grid;
        $this->numberOfIslands = 0;
        $this->visitedTiles = [];

        foreach ($this->grid as $rowIndex => $row) {
            foreach ($row as $colIndex => $v) {
                if ($this->isWater($v) || $this->isVisited($rowIndex, $colIndex)) {
                    continue;
                }

                // We now ensured that we have a non water tile that is not yet
                // visited. This would equal a new island thus we can increase
                // the counter and start to visit the adjacent areas.
                $this->numberOfIslands++;
                $this->visit($rowIndex, $colIndex);
            }
        }

        return $this->numberOfIslands;
    }

    private function isWater(string $value): bool
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
