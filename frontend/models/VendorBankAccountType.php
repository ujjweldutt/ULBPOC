<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vendor_bank_account_type".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $modified_at
 * @property string|null $is_active
 */
class VendorBankAccountType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_bank_account_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'modified_at'], 'required'],
            [['created_at', 'modified_at'], 'safe'],
            [['is_active'], 'string'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'is_active' => 'Is Active',
        ];
    }
}
