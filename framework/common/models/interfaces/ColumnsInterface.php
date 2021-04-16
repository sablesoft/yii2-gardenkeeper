<?php


namespace common\models\interfaces;

/**
 * Interface ColumnsInterface
 * @package common\models\interfaces
 *
 * @property-read array $columns
 */
interface ColumnsInterface
{
    /**
     * @return array
     */
    public function getColumns(): array;
}