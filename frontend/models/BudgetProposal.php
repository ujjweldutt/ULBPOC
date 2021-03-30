<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trans_budget_proposal".
 *
 * @property int $id
 * @property int $user_id
 * @property int $budget_id
 * @property int $ulb_id
 * @property float $amount_demanded
 * @property string $allocation_type
 * @property string $status
 * @property int $approved_by
 * @property string $uploaded_file
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransBudget $budget
 */
class BudgetProposal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_budget_proposal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['budget_id', 'ulb_id', 'amount_demanded', 'allocation_type'], 'required'],
            [['user_id', 'budget_id', 'ulb_id', 'approved_by'], 'integer'],
            [['amount_demanded'], 'number'],
            [['status'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['allocation_type'], 'string', 'max' => 100],
            [['uploaded_file'], 'string', 'max' => 400],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'budget_id' => 'Budget',
            'ulb_id' => 'Select MCs',
            'amount_demanded' => 'Proposal in Process (Rs)',
            'allocation_type' => 'Allocation Type',
            'status' => 'Status',
            'approved_by' => 'Approved By',
            'uploaded_file' => 'Uploaded File',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[Budget]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::className(), ['id' => 'budget_id']);
    }

    
    public function getUlb()
    {
        return $this->hasOne(MstUlb::className(), ['id' => 'ulb_id']);
    }

    
    
}
