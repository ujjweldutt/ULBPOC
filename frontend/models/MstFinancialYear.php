<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mst_financial_year".
 *
 * @property int $id
 * @property string $start_year
 * @property string $end_year
 * @property string $created_on
 * @property string $updated_on
 *
 * @property TransWms[] $transWms
 */
class MstFinancialYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mst_financial_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_year', 'end_year', 'created_on', 'updated_on'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['start_year', 'end_year'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_year' => 'Start Year',
            'end_year' => 'End Year',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[TransWms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransWms()
    {
        return $this->hasMany(TransWms::className(), ['financial_year_id' => 'id']);
    }
}
