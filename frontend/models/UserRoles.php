<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_user_roles".
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property int $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property MstUser $user
 * @property MstRoles $role
 */
class UserRoles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_user_roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id', 'is_active', 'created_on', 'updated_on'], 'required'],
            [['user_id', 'role_id', 'is_active'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstUser::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstRoles::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'role_id' => 'Role ID',
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(MstUser::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(MstRoles::className(), ['id' => 'role_id']);
    }
}
