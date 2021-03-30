<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trans_budget".
 *
 * @property int $id
 * @property int $user_id
 * @property int $scheme_id
 * @property int $component_id
 * @property int $financial_year_id
 * @property float $amount
 * @property string|null $remarks
 * @property string|null $uploaded_file
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransBudgetProposal[] $transBudgetProposals
 */
class Budget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_budget';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scheme_id', 'component_id', 'financial_year_id', 'amount'], 'required'],
            [['user_id', 'scheme_id', 'component_id', 'financial_year_id'], 'integer'],
            [['amount'], 'number'],
            [['uploaded_file', 'is_active'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['remarks'], 'string', 'max' => 500],
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
            'scheme_id' => 'Scheme ID',
            'component_id' => 'Component ID',
            'financial_year_id' => 'Financial Year ID',
            'amount' => 'Amount',
            'remarks' => 'Remarks',
            'uploaded_file' => 'Uploaded File',
            'is_active' => 'Is Active',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[TransBudgetProposals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransBudgetProposals()
    {
        return $this->hasMany(TransBudgetProposal::className(), ['budget_id' => 'id']);
    }
    public function getFinancial()
    {
        return $this->hasOne(MstFinancialYear::className(), ['id' => 'financial_year_id']);
    }
    public function getScheme()
    {
        return $this->hasOne(MstScheme::className(), ['id' => 'scheme_id']);
    }
    public function getComponent()
    {
        return $this->hasOne(MstComponent::className(), ['id' => 'component_id']);
    }
}
