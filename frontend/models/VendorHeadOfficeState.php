<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vendor_head_office_state".
 *
 * @property int $id
 * @property int|null $state_code
 * @property string|null $state_name
 * @property string $is_active
 *
 * @property VendorHeadOfficeDistrict[] $vendorHeadOfficeDistricts
 */
class VendorHeadOfficeState extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_head_office_state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_code'], 'integer'],
            [['is_active'], 'string'],
            [['state_name'], 'string', 'max' => 255],
            [['state_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state_code' => 'State Code',
            'state_name' => 'State Name',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Gets query for [[VendorHeadOfficeDistricts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendorHeadOfficeDistricts()
    {
        return $this->hasMany(VendorHeadOfficeDistrict::className(), ['state_code' => 'state_code']);
    }
}
