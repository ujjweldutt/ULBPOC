<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_announcement".
 *
 * @property int $id
 * @property string $announcement_type
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 */
class MstAnnouncement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_announcement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['announcement_type', 'is_active'], 'required'],
            [['is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['announcement_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'announcement_type' => 'Announcement Type',
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }
}
