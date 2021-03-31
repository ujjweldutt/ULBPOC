<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trans_wms_work_items".
 *
 * @property int $id
 * @property int $wms_id
 * @property int $item_id
 * @property string|null $description
 * @property string|null $remarks
 * @property float|null $number1
 * @property float|null $number2
 * @property float|null $number3
 * @property float $length
 * @property float $breadth
 * @property float $height
 * @property string $unit
 * @property int $quantity
 * @property int $rate_type_id
 * @property float $total_rate
 * @property float $total_amount
 * @property string $status
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransWms $wms
 * @property MstRateType $rateType
 * @property MstItems $item
 */
class WmsWorkItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_wms_work_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wms_id', 'item_id', 'length', 'breadth', 'height', 'unit', 'quantity', 'rate_type_id'], 'required'],
            [['wms_id', 'item_id', 'quantity', 'rate_type_id'], 'integer'],
            [['number1','length', 'breadth', 'height', 'total_rate', 'total_amount'], 'number'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['description', 'remarks'], 'string'],
            [['unit'], 'string', 'max' => 100],
            [['wms_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransWms::className(), 'targetAttribute' => ['wms_id' => 'id']],
            [['rate_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstRateType::className(), 'targetAttribute' => ['rate_type_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstItems::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wms_id' => 'Wms ID',
            'item_id' => 'Item Type',
            'description' => 'Description',
            'remarks' => 'Remarks',
            'number1' => 'Number',
            'length' => 'Length',
            'breadth' => 'Breadth',
            'height' => 'Height',
            'unit' => 'Unit',
            'quantity' => 'Quantity',
            'rate_type_id' => 'Rate Type ID',
            'total_rate' => 'Total Rate',
            'total_amount' => 'Total Amount',
            'status' => 'Status',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
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
