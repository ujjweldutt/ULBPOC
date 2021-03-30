<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\VendorRegistration;

/**
 * VendorRegistrationSearch represents the model behind the search form of `frontend\models\VendorRegistration`.
 */
class VendorRegistrationSearch extends VendorRegistration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vendor_head_office_country_id', 'vendor_head_office_state_id', 'vendor_head_office_district_id', 'head_office_pin_code', 'head_office_telephone_no', 'head_office_mobile_no', 'vendor_branch_office_country_id', 'vendor_branch_office_state_id', 'vendor_branch_office_district_id', 'branch_office_pin_no', 'branch_office_telephone_no', 'branch_office_mobile_no', 'bank_account_no', 'vendor_bank_account_type_id'], 'integer'],
            [['name', 'email', 'gst_no', 'pan_no', 'tin_no', 'permanent_address', 'head_office_address1', 'head_office_address2', 'head_office_company_url', 'head_office_business_established_year', 'branch_office_address1', 'branch_office_address2', 'bank_name', 'ifsc_code', 'vendor_description', 'created_at', 'modified_at', 'is_active'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = VendorRegistration::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'vendor_head_office_country_id' => $this->vendor_head_office_country_id,
            'vendor_head_office_state_id' => $this->vendor_head_office_state_id,
            'vendor_head_office_district_id' => $this->vendor_head_office_district_id,
            'head_office_pin_code' => $this->head_office_pin_code,
            'head_office_telephone_no' => $this->head_office_telephone_no,
            'head_office_mobile_no' => $this->head_office_mobile_no,
            'vendor_branch_office_country_id' => $this->vendor_branch_office_country_id,
            'vendor_branch_office_state_id' => $this->vendor_branch_office_state_id,
            'vendor_branch_office_district_id' => $this->vendor_branch_office_district_id,
            'branch_office_pin_no' => $this->branch_office_pin_no,
            'branch_office_telephone_no' => $this->branch_office_telephone_no,
            'branch_office_mobile_no' => $this->branch_office_mobile_no,
            'bank_account_no' => $this->bank_account_no,
            'vendor_bank_account_type_id' => $this->vendor_bank_account_type_id,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'gst_no', $this->gst_no])
            ->andFilterWhere(['like', 'pan_no', $this->pan_no])
            ->andFilterWhere(['like', 'tin_no', $this->tin_no])
            ->andFilterWhere(['like', 'permanent_address', $this->permanent_address])
            ->andFilterWhere(['like', 'head_office_address1', $this->head_office_address1])
            ->andFilterWhere(['like', 'head_office_address2', $this->head_office_address2])
            ->andFilterWhere(['like', 'head_office_company_url', $this->head_office_company_url])
            ->andFilterWhere(['like', 'head_office_business_established_year', $this->head_office_business_established_year])
            ->andFilterWhere(['like', 'branch_office_address1', $this->branch_office_address1])
            ->andFilterWhere(['like', 'branch_office_address2', $this->branch_office_address2])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'ifsc_code', $this->ifsc_code])
            ->andFilterWhere(['like', 'vendor_description', $this->vendor_description])
            ->andFilterWhere(['like', 'is_active', $this->is_active]);

        return $dataProvider;
    }
}
