<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vendor_branch_office_country".
 *
 * @property int $id
 * @property string $country_name
 * @property string $is_active
 */
class VendorBranchOfficeCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_branch_office_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_name'], 'required'],
            [['is_active'], 'string'],
            [['country_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_name' => 'Country Name',
            'is_active' => 'Is Active',
        ];
    }
}
