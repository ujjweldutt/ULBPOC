<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trans_wms_approval_level".
 *
 * @property int $id
 * @property int $role_id
 * @property int $wms_id
 * @property string $remarks
 * @property string $status
 * @property string $created_on
 * @property string $updated_on
 *
 * @property MstRole $role
 * @property TransWms $wms
 */
class WmsApprovalLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_wms_approval_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'wms_id', 'remarks', 'status', 'created_on', 'updated_on'], 'required'],
            [['role_id', 'wms_id'], 'integer'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['remarks'], 'string', 'max' => 255],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstRole::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['wms_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransWms::className(), 'targetAttribute' => ['wms_id' => 'id']],
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
            'wms_id' => 'Wms ID',
            'remarks' => 'Remarks',
            'status' => 'Status',
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

    /**
     * Gets query for [[Wms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWms()
    {
        return $this->hasOne(TransWms::className(), ['id' => 'wms_id']);
    }
}
