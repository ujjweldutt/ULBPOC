<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_ulb".
 *
 * @property int $id
 * @property string $name
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransWms[] $transWms
 */
class MstUlb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_ulb';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'is_active', 'created_on', 'updated_on'], 'required'],
            [['is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[TransWms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransWms()
    {
        return $this->hasMany(TransWms::className(), ['ulb_id' => 'id']);
    }
}
