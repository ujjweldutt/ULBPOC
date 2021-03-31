<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sub_type_work".
 *
 * @property int $id
 * @property int $work_type_id
 * @property string $sub_type_work
 * @property string $status
 * @property string $created_on
 * @property string $updated_on
 *
 * @property WorkType $workType
 */
class SubTypeWork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_type_work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_type_id', 'sub_type_work', 'status', 'created_on', 'updated_on'], 'required'],
            [['work_type_id'], 'integer'],
            [['sub_type_work', 'status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['work_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkType::className(), 'targetAttribute' => ['work_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_type_id' => 'Work Type ID',
            'sub_type_work' => 'Sub Type Work',
            'status' => 'Status',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[WorkType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkType::className(), ['id' => 'work_type_id']);
    }
}
