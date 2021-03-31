<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "work_type".
 *
 * @property int $id
 * @property string $work_name
 * @property string $status
 * @property string $created_on
 * @property string $updated_on
 *
 * @property SubTypeWork[] $subTypeWorks
 */
class WorkType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_name', 'status', 'created_on', 'updated_on'], 'required'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['work_name'], 'string', 'max' => 155],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_name' => 'Work Name',
            'status' => 'Status',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[SubTypeWorks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubTypeWorks()
    {
        return $this->hasMany(SubTypeWork::className(), ['work_type_id' => 'id']);
    }
}
