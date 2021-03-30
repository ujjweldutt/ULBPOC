<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vendor_head_office_district".
 *
 * @property int $id
 * @property int|null $district_code
 * @property string|null $district_name
 * @property int|null $state_code
 * @property string $is_active
 *
 * @property VendorHeadOfficeState $stateCode
 */
class VendorHeadOfficeDistrict extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_head_office_district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['district_code', 'state_code'], 'integer'],
            [['is_active'], 'string'],
            [['district_name'], 'string', 'max' => 255],
            [['district_code'], 'unique'],
            [['state_code'], 'exist', 'skipOnError' => true, 'targetClass' => VendorHeadOfficeState::className(), 'targetAttribute' => ['state_code' => 'state_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_code' => 'District Code',
            'district_name' => 'District Name',
            'state_code' => 'State Code',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Gets query for [[StateCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStateCode()
    {
        return $this->hasOne(VendorHeadOfficeState::className(), ['state_code' => 'state_code']);
    }
}
