<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_scheme".
 *
 * @property int $id
 * @property string $scheme
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_in
 *
 * @property TransWms[] $transWms
 */
class MstScheme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_scheme';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scheme', 'is_active', 'created_on', 'updated_in'], 'required'],
            [['is_active'], 'string'],
            [['created_on', 'updated_in'], 'safe'],
            [['scheme'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scheme' => 'Scheme',
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_in' => 'Updated In',
        ];
    }

    /**
     * Gets query for [[TransWms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransWms()
    {
        return $this->hasMany(TransWms::className(), ['scheme_id' => 'id']);
    }
}
