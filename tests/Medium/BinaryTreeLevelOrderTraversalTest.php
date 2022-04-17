<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

use PHPUnit\Framework\TestCase;

final class BinaryTreeLevelOrderTraversalTest extends TestCase
{
    /**
     * @dataProvider valuesProvider
     *
     * @param array<int|null> $values
     * @param array<array<int>> $expectedResult
     */
    public function testLevelOrderGivenExampleInputs(array $values, array $expectedResult): void
    {
        $solution = new BinaryTreeLevelOrderTraversal();
        $root = BinaryTreeLevelOrderTraversal::arrayToTree($values);

        $actualResult = $solution->levelOrder($root);

        static::assertEquals($expectedResult, $actualResult);
    }

    /** @return array<string, array{0: array<int|null>, 1: array<array<int>>}> */
    public function valuesProvider(): array
    {
        return [
            'example 1' => [
                [3, 9, 20, null, null, 15, 7],
                [[3], [9, 20], [15, 7]],
            ],
            'example 2' => [
                [1],
                [[1]],
            ],
            'example 3' => [
                [],
                [],
            ],
            'example 4' => [
                [1, 2],
                [[1], [2]],
            ],
            'example 5' => [
                [1, 2, null, 3, null, 4, null, 5],
                [[1], [2], [3], [4], [5]],
            ],
        ];
    }
}
