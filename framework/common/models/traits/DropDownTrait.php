<?php

namespace common\models\traits;

use yii\helpers\ArrayHelper;

/**
 * Trait DropDownTrait
 * @package common\models\traits
 */
trait DropDownTrait
{
    /**
     * @param array $config
     * @return array
     */
    public static function getDropDownList($config = []) : array
    {
        // prepare items:
        $query = static::find();
        $where = !empty( $config['where'] )? $config['where'] : false;
        if( is_array( $where ) )
            $query = $query->where( $where );
        $models = $query->all();
        $from = !empty( $config['from'] )? $config['from'] : 'id';
        $to = !empty( $config['to'] )? $config['to'] : 'name';
        $items = ArrayHelper::map( $models, $from, $to );
        // prepare params:
        $params = [];
        if( !empty( $config['selected'] ) ) {
            $selected = static::find()->where(['is_default' => 1])->one();
            if( $selected->id )
                $params = [
                    'options' => [
                        $selected->id => [ 'Selected' => true ]
                    ]
                ];
        }
        if( isset( $config['prompt'] ) )
            $params['prompt'] = $config['prompt'];

        return [ $items, $params ];
    }
}