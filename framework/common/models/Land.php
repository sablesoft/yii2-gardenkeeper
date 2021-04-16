<?php

namespace common\models;

use Yii;
use common\models\interfaces\ColumnsInterface;
use common\models\traits\DropDownTrait;

/**
 * This is the model class for table "land".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id Owner ID
 * @property int $climate_id Climate ID
 * @property int $width Land width
 * @property int $length Land length
 * @property int|null $rating
 * @property string $created_at Creation time
 * @property string $updated_at Last update time
 *
 * @property-read string|null $userLabel
 * @property-read string|null $climateLabel
 * @property Garden[] $gardens
 * @property Gather[] $gathers
 * @property Climate $climate
 * @property User $user
 */
class Land extends \yii\db\ActiveRecord implements ColumnsInterface
{
    use DropDownTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'land';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['user_id', 'climate_id'], 'required'],
            [['user_id', 'climate_id', 'width', 'length', 'rating'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['climate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Climate::className(), 'targetAttribute' => ['climate_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'user_id' => Yii::t('app', 'User'),
            'userLabel' => Yii::t('app', 'User'),
            'climate_id' => Yii::t('app', 'Climate'),
            'climateLabel' => Yii::t('app', 'Climate'),
            'width' => Yii::t('app', 'Width'),
            'length' => Yii::t('app', 'Length'),
            'rating' => Yii::t('app', 'Rating'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return [
//            'id',
            'name',
            'userLabel',
            'climateLabel',
//            'width',
//            'length',
            'rating',
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }

    /**
     * Gets query for [[Gardens]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GardenQuery
     */
    public function getGardens()
    {
        return $this->hasMany(Garden::className(), ['land_id' => 'id']);
    }

    /**
     * Gets query for [[Gathers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GatherQuery
     */
    public function getGathers()
    {
        return $this->hasMany(Gather::className(), ['land_id' => 'id']);
    }

    /**
     * Gets query for [[Climate]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClimateQuery
     */
    public function getClimate()
    {
        return $this->hasOne(Climate::className(), ['id' => 'climate_id']);
    }

    /**
     * @return string|null
     */
    public function getClimateLabel() : ?string
    {
        return $this->climate ? $this->climate->name : null;
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return string|null
     */
    public function getUserLabel(): ?string
    {
        return $this->user ? $this->user->username : null;
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\LandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LandQuery(get_called_class());
    }
}
