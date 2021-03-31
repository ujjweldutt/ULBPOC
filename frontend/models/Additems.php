<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "additems".
 *
 * @property int|null $wms_id
 * @property int|null $item_id
 * @property string|null $description
 * @property string|null $remarks
 * @property float|null $number1
 * @property float|null $length
 * @property float|null $breadth
 * @property float|null $height
 * @property string|null $unit
 * @property int|null $quantity
 * @property int|null $rate_type_id
 * @property float|null $total_rate
 * @property float|null $total_amount
 */
class Additems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'additems';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wms_id', 'item_id', 'quantity', 'rate_type_id'], 'integer'],
            [['description'], 'string'],
            [['number1', 'length', 'breadth', 'height', 'total_rate', 'total_amount'], 'number'],
            [['remarks'], 'string', 'max' => 200],
            [['unit'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wms_id' => 'Wms ID',
            'item_id' => 'Item ID',
            'description' => 'Description',
            'remarks' => 'Remarks',
            'number1' => 'Number1',
            'length' => 'Length',
            'breadth' => 'Breadth',
            'height' => 'Height',
            'unit' => 'Unit',
            'quantity' => 'Quantity',
            'rate_type_id' => 'Rate Type ID',
            'total_rate' => 'Total Rate',
            'total_amount' => 'Total Amount',
        ];
    }


     /**
     * Gets query for [[Wms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWms()
    {
        return $this->hasOne(TransWms::className(), ['id' => 'wms_id']);
    }

    /**
     * Gets query for [[RateType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRateType()
    {
        return $this->hasOne(MstRateType::className(), ['id' => 'rate_type_id']);
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(MstItems::className(), ['id' => 'item_id']);
    }


    public function getRate()
    {
        return $this->hasOne(MstRateType::className(), ['id' => 'rate_type_id']);
    }
}
