<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_items".
 *
 * @property int $id
 * @property string $item_name
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransWmsWorkItems[] $transWmsWorkItems
 */
class MstItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'is_active', 'created_on', 'updated_on'], 'required'],
            [['is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['item_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_name' => 'Item Name',
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[TransWmsWorkItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransWmsWorkItems()
    {
        return $this->hasMany(TransWmsWorkItems::className(), ['item_id' => 'id']);
    }
}
