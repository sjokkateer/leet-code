<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

class IslandFinding extends AbstractIslandFinding
{
    private int $numberOfIslands;

    /** {@inheritDoc} */
    public function processGrid(array $grid): int
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
}
