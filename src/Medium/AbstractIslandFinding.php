<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

use function array_key_exists;
use function count;

abstract class AbstractIslandFinding
{
    public const WATER = 0;
    public const LAND = 1;

    /**
     * @var array<array{self::WATER|self::LAND}>
     */
    protected array $grid;

    /**
     * @var array<array<true>>
     */
    protected array $visitedTiles;

    /** @param array<array{self::WATER|self::LAND}> $grid */
    abstract public function processGrid(array $grid): int;

    protected function isWater(int $value): bool
    {
        return $value === self::WATER;
    }

    protected function isVisited(int $row, int $col): bool
    {
        return array_key_exists($row, $this->visitedTiles)
            && array_key_exists($col, $this->visitedTiles[$row]);
    }

    protected function visit(int $row, int $col): void
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

        $this->update($row, $col);

        $this->visitLeft($row, $col);
        $this->visitRight($row, $col);
        $this->visitUp($row, $col);
        $this->visitDown($row, $col);
    }

    /**
     * This method is called during visiting a particular tile
     * and is reached/executed whenever a tile is a land tile
     * that has not yet been visited that is within the boundaries
     * of the grid.
     */
    protected function update(int $row, int $col): void
    {
        $this->visitedTiles[$row][$col] = true;
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
