<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vendor_branch_office_district".
 *
 * @property int $id
 * @property int|null $district_code
 * @property string|null $district_name
 * @property int|null $state_code
 * @property string $is_active
 */
class VendorBranchOfficeDistrict extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_branch_office_district';
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
}
