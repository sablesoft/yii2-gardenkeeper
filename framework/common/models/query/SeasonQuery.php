<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Season]].
 *
 * @see \common\models\Season
 */
class SeasonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Season[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Season|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
