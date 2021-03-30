<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trans_wms".
 *
 * @property int $id
 * @property string $work_code_number
 * @property int $user_id
 * @property int $ulb_id
 * @property int $ward_id
 * @property int $scheme_id
 * @property int $component_id
 * @property int $financial_year_id
 * @property string $work_name
 * @property string $work_type
 * @property string $work_sub_type
 * @property string $work_scope
 * @property string $announcement_type
 * @property string $announcement_no
 * @property string $announcement_date
 * @property string $site_plan_file
 * @property string $cross_section_file
 * @property string $l_section_file
 * @property string $google_map_file
 * @property string $city_map_file
 * @property string $is_active
 * @property string $is_revised
 * @property string $remarks
 * @property string $created_on
 * @property string $updated_on
 *
 * @property MstUlb $ulb
 * @property MstScheme $scheme
 * @property MstComponent $component
 * @property MstFinancialYear $financialYear
 * @property MstWard $ward
 * @property TransWmsApprovalLevel[] $transWmsApprovalLevels
 * @property TransWmsWorkItems[] $transWmsWorkItems
 */
class Wms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_wms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_code_number',  'ulb_id', 'ward_id', 'scheme_id', 'component_id', 'financial_year_id', 'work_name', 'work_type', 'work_sub_type', 'work_scope', 'announcement_type', 'announcement_no', 'announcement_date'], 'required'],
            [['user_id', 'ulb_id', 'ward_id', 'scheme_id', 'component_id', 'financial_year_id'], 'integer'],
            [['announcement_date', 'created_on', 'updated_on'], 'safe'],
            [['is_active', 'is_revised'], 'string'],
            [['work_code_number', 'work_name', 'work_type', 'work_sub_type', 'work_scope', 'announcement_type', 'announcement_no', 'site_plan_file', 'cross_section_file', 'l_section_file', 'google_map_file', 'city_map_file', 'remarks'], 'string', 'max' => 255],
            [['ulb_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstUlb::className(), 'targetAttribute' => ['ulb_id' => 'id']],
            [['scheme_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstScheme::className(), 'targetAttribute' => ['scheme_id' => 'id']],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['financial_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstFinancialYear::className(), 'targetAttribute' => ['financial_year_id' => 'id']],
            [['ward_id'], 'exist', 'skipOnError' => true, 'targetClass' => MstWard::className(), 'targetAttribute' => ['ward_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_code_number' => 'Work Code',
            'user_id' => 'User ID',
            'ulb_id' => 'MC Name',
            'ward_id' => 'Ward No',
            'scheme_id' => 'Scheme',
            'component_id' => 'Component Scheme',
            'financial_year_id' => 'Financial Year',
            'work_name' => 'Name of Work',
            'work_type' => 'Type of Work',
            'work_sub_type' => 'Sub Type of Work',
            'work_scope' => 'Scope of Work',
            'announcement_type' => 'Type of Announcement',
            'announcement_no' => 'Announcement No',
            'announcement_date' => 'Announcement Date',
            'site_plan_file' => 'Site Plan',
            'cross_section_file' => 'Cross Section',
            'l_section_file' => 'L Section',
            'google_map_file' => 'Google Map',
            'city_map_file' => 'City Map',
            'is_active' => 'Is Active',
            'is_revised' => 'Is Revised',
            'remarks' => 'Remarks',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[Ulb]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUlb()
    {
        return $this->hasOne(MstUlb::className(), ['id' => 'ulb_id']);
    }

    /**
     * Gets query for [[Scheme]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScheme()
    {
        return $this->hasOne(MstScheme::className(), ['id' => 'scheme_id']);
    }

    /**
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(MstComponent::className(), ['id' => 'component_id']);
    }

    /**
     * Gets query for [[FinancialYear]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialYear()
    {
        return $this->hasOne(MstFinancialYear::className(), ['id' => 'financial_year_id']);
    }

    /**
     * Gets query for [[Ward]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWard()
    {
        return $this->hasOne(MstWard::className(), ['id' => 'ward_id']);
    }

    /**
     * Gets query for [[TransWmsApprovalLevels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransWmsApprovalLevels()
    {
        return $this->hasMany(TransWmsApprovalLevel::className(), ['wms_id' => 'id']);
    }

    /**
     * Gets query for [[TransWmsWorkItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransWmsWorkItems()
    {
        return $this->hasMany(TransWmsWorkItems::className(), ['wms_id' => 'id']);
    }
}
