<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_component".
 *
 * @property int $id
 * @property string $component
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransWms[] $transWms
 */
class MstComponent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['component', 'is_active', 'created_on', 'updated_on'], 'required'],
            [['is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['component'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'component' => 'Component',
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
        return $this->hasMany(TransWms::className(), ['component_id' => 'id']);
    }
}
