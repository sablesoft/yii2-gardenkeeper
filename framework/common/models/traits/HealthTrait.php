<?php

namespace common\models\traits;

/**
 * Trait HealthTrait
 * @package common\models\traits
 * @property int $health
 */
trait HealthTrait
{
    /**
     * @param int $diff
     * @return $this
     */
    protected function updateHealth(int $diff): self
    {
        $this->health += $diff;
        if ($this->health > 100) {
            $this->health = 100;
        }
        if ($this->health < 0) {
            $this->health = 0;
        }

        return $this;
    }
}