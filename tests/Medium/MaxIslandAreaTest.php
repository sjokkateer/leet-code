<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

use PHPUnit\Framework\TestCase;

final class MaxIslandAreaTest extends TestCase
{
    /**
     * @dataProvider gridProvider
     *
     * @param array<array{MaxIslandArea::WATER|MaxIslandArea::LAND}> $grid
     */
    public function testExamplesOwnCasesAndProvidedTestCase(array $grid, int $expectedNumberOfIslands): void
    {
        $islandFinder = new MaxIslandArea();

        $actualNumberOfIslands = $islandFinder->maxAreaOfIsland($grid);

        static::assertEquals($expectedNumberOfIslands, $actualNumberOfIslands);
    }

    /** @return array<string, array{0: array<array{MaxIslandArea::WATER|MaxIslandArea::LAND}>, 1: int}> */
    // phpcs:ignore SlevomatCodingStandard.Functions.FunctionLength.FunctionLength -- Provides test cases, splitting might make it harder to read
    public function gridProvider(): array
    {
        return [
            'example 1' => [
                [
                    [0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
                    [0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 1, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0, 0],
                    [0, 1, 0, 0, 1, 1, 0, 0, 1, 1, 1, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0],
                ],
                6,
            ],
            'example 2' => [
                [[0, 0, 0, 0, 0, 0, 0, 0]],
                0,
            ],
            'some input 1' => [
                [
                    [1, 1, 1, 1, 0],
                    [1, 1, 0, 1, 0],
                    [1, 1, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                ],
                9,
            ],
            'some input 2' => [
                [
                    [1, 1, 0, 0, 0],
                    [1, 1, 0, 0, 0],
                    [0, 0, 1, 0, 0],
                    [0, 0, 0, 1, 1],
                ],
                4,
            ],
            'single land' => [
                [
                    [1],
                ],
                1,
            ],
            'single water' => [
                [
                    [0],
                ],
                0,
            ],
        ];
    }
}
