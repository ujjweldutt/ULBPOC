<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_ward".
 *
 * @property int $id
 * @property string $ward_number
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransWms[] $transWms
 */
class MstWard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_ward';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ward_number', 'is_active', 'created_on', 'updated_on'], 'required'],
            [['is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['ward_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ward_number' => 'Ward Number',
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
        return $this->hasMany(TransWms::className(), ['ward_id' => 'id']);
    }
}
