<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

use PHPUnit\Framework\TestCase;

final class IslandFindingTest extends TestCase
{
    /**
     * @dataProvider gridProvider
     *
     * @param array<array{IslandFinding::WATER|IslandFinding::LAND}> $grid
     */
    public function testExamplesOwnCasesAndProvidedTestCase(array $grid, int $expectedNumberOfIslands): void
    {
        $islandFinder = new IslandFinding();

        $actualNumberOfIslands = $islandFinder->processGrid($grid);

        static::assertEquals($expectedNumberOfIslands, $actualNumberOfIslands);
    }

    /** @return array<string, array{0: array<array{IslandFinding::WATER|IslandFinding::LAND}>, 1: int}> */
    // phpcs:ignore SlevomatCodingStandard.Functions.FunctionLength.FunctionLength -- Provides test cases, splitting might make it harder to read
    public function gridProvider(): array
    {
        return [
            'example 1' => [
                [
                    [1, 1, 1, 1, 0],
                    [1, 1, 0, 1, 0],
                    [1, 1, 0, 0, 0],
                    [0, 0, 0, 0, 0],
                ],
                1,
            ],
            'example 2' => [
                [
                    [1, 1, 0, 0, 0],
                    [1, 1, 0, 0, 0],
                    [0, 0, 1, 0, 0],
                    [0, 0, 0, 1, 1],
                ],
                3,
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
