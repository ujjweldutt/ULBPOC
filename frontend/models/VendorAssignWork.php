<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vendor_assign_work".
 *
 * @property int $id
 * @property int $vendor_registration_id
 * @property string $reference_no
 * @property int $agency_period_months
 * @property string $agency_tendor_no
 * @property int $estimated_amount
 * @property string $work_start_date
 * @property string $work_completion_date
 * @property int $liability_period_days
 * @property string $brief_work_details
 * @property string $note_other_conditions
 * @property int $security_deposit
 * @property int $earnest_money_deposit
 * @property string $created_at
 * @property string $is_active
 */
class VendorAssignWork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_assign_work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_registration_id', 'reference_no', 'agency_period_months', 'agency_tendor_no', 'estimated_amount', 'work_start_date', 'work_completion_date', 'liability_period_days', 'brief_work_details', 'note_other_conditions', 'security_deposit', 'earnest_money_deposit'], 'required'],
            [['vendor_registration_id', 'agency_period_months', 'estimated_amount', 'liability_period_days', 'security_deposit', 'earnest_money_deposit'], 'integer'],
            [['work_start_date', 'work_completion_date', 'created_at'], 'safe'],
            [['is_active'], 'string'],
            [['reference_no', 'agency_tendor_no', 'brief_work_details', 'note_other_conditions'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vendor_registration_id' => 'Vendor Registration ID',
            'reference_no' => 'Reference No',
            'agency_period_months' => 'Agency Period Months',
            'agency_tendor_no' => 'Agency Tendor No',
            'estimated_amount' => 'Estimated Amount',
            'work_start_date' => 'Work Start Date',
            'work_completion_date' => 'Work Completion Date',
            'liability_period_days' => 'Liability Period Days',
            'brief_work_details' => 'Brief Work Details',
            'note_other_conditions' => 'Note Other Conditions',
            'security_deposit' => 'Security Deposit',
            'earnest_money_deposit' => 'Earnest Money Deposit',
            'created_at' => 'Created At',
            'is_active' => 'Is Active',
        ];
    }
}
