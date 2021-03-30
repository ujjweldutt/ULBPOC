<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_role_mapping".
 *
 * @property int $id
 * @property int $role_id
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property MstRole $role
 */
class MstRoleMapping extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_role_mapping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'is_active', 'created_on', 'updated_on'], 'required'],
            [['role_id'], 'integer'],
            [['is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstRole::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(MstRole::className(), ['id' => 'role_id']);
    }
}
