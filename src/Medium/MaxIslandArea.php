<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

/**
 * #695. Max Area of Island
 * https://leetcode.com/problems/max-area-of-island/
 */
class MaxIslandArea extends AbstractIslandFinding
{
    private int $largestIsland;
    private int $islandArea;

    /** {@inheritDoc} */
    public function processGrid(array $grid): int
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

                if ($this->newIslandIsLarger()) {
                    $this->largestIsland = $this->islandArea;
                }
            }
        }

        return $this->largestIsland;
    }

    private function newIslandIsLarger(): bool
    {
        return $this->islandArea > $this->largestIsland;
    }

    protected function update(int $row, int $col): void
    {
        parent::update($row, $col);
        $this->islandArea++;
    }
}
