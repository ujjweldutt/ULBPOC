<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_rate_type".
 *
 * @property int $id
 * @property string $rate_type
 * @property int $rate
 * @property int $premium_rate
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransWmsWorkItems[] $transWmsWorkItems
 */
class MstRateType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_rate_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate_type', 'rate', 'premium_rate', 'is_active', 'created_on', 'updated_on'], 'required'],
            [['rate', 'premium_rate'], 'integer'],
            [['is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['rate_type'], 'string', 'max' => 155],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rate_type' => 'Rate Type',
            'rate' => 'Rate',
            'premium_rate' => 'Premium Rate',
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[TransWmsWorkItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransWmsWorkItems()
    {
        return $this->hasMany(TransWmsWorkItems::className(), ['rate_type_id' => 'id']);
    }
}
