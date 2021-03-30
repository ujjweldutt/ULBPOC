<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_role".
 *
 * @property int $id
 * @property string $role
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property MstRoleMapping[] $mstRoleMappings
 * @property TransWmsApprovalLevel[] $transWmsApprovalLevels
 */
class MstRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'is_active', 'created_on', 'updated_on'], 'required'],
            [['is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['role'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[MstRoleMappings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMstRoleMappings()
    {
        return $this->hasMany(MstRoleMapping::className(), ['role_id' => 'id']);
    }

    /**
     * Gets query for [[TransWmsApprovalLevels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransWmsApprovalLevels()
    {
        return $this->hasMany(TransWmsApprovalLevel::className(), ['role_id' => 'id']);
    }
}
