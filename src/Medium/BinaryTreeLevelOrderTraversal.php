<?php

declare(strict_types=1);

namespace Sjokkateer\LeetCode\Medium;

use Sjokkateer\LeetCode\TreeNode;

use function array_shift;

/**
 * #102. Binary Tree Level Order Traversal
 * https://leetcode.com/problems/binary-tree-level-order-traversal/
 */
class BinaryTreeLevelOrderTraversal
{
    /** @return array<array<int>> */
    public function levelOrder(?TreeNode $root): array
    {
        if ($root === null) {
            return [];
        }

        $queue = [$root];
        $nextLevel = [];
        $result = [];
        $temp = [];

        while ($queue !== []) {
            $current = array_shift($queue);
            $temp[] = $current->val;

            if ($current->left !== null) {
                $nextLevel[] = $current->left;
            }

            if ($current->right !== null) {
                $nextLevel[] = $current->right;
            }

            if ($queue === []) {
                $result[] = $temp;
                $temp = [];

                $queue = $nextLevel;
                $nextLevel = [];
            }
        }

        return $result;
    }

    /** @param array<int|null> $values */
    // phpcs:ignore SlevomatCodingStandard.Functions.FunctionLength.FunctionLength
    public static function arrayToTree(array $values): ?TreeNode
    {
        $value = array_shift($values);

        if ($value === null) {
            return null;
        }

        $root = new TreeNode($value);

        $queue = [$root];
        $nextLevel = [];

        while ($queue !== []) {
            $current = array_shift($queue);

            $value = array_shift($values);
            if ($value !== null) {
                $left = new TreeNode($value);
                $current->left = $left;
                $nextLevel[] = $left;
            }

            $value = array_shift($values);
            if ($value !== null) {
                $right = new TreeNode($value);
                $current->right = $right;
                $nextLevel[] = $right;
            }

            if ($queue === []) {
                $queue = $nextLevel;
                $nextLevel = [];
            }
        }

        return $root;
    }
}
