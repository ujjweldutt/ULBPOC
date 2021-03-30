<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vendor_registration".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $gst_no
 * @property string $pan_no
 * @property string $tin_no
 * @property string $permanent_address
 * @property string $head_office_address1
 * @property string $head_office_address2
 * @property int $vendor_head_office_country_id
 * @property int $vendor_head_office_state_id
 * @property int $vendor_head_office_district_id
 * @property int $head_office_pin_code
 * @property int $head_office_telephone_no
 * @property int $head_office_mobile_no
 * @property string $head_office_company_url
 * @property string $head_office_business_established_year
 * @property string $branch_office_address1
 * @property string $branch_office_address2
 * @property int $vendor_branch_office_country_id
 * @property int $vendor_branch_office_state_id
 * @property int $vendor_branch_office_district_id
 * @property int $branch_office_pin_no
 * @property int $branch_office_telephone_no
 * @property int $branch_office_mobile_no
 * @property string $bank_name
 * @property int $bank_account_no
 * @property int $vendor_bank_account_type_id
 * @property string $ifsc_code
 * @property string $vendor_description
 * @property string $created_at
 * @property string|null $modified_at
 * @property string $is_active
 */
class VendorRegistration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'gst_no', 'pan_no', 'tin_no', 'permanent_address', 'head_office_address1', 'head_office_address2', 'vendor_head_office_country_id', 'vendor_head_office_state_id', 'vendor_head_office_district_id', 'head_office_pin_code', 'head_office_telephone_no', 'head_office_mobile_no', 'head_office_company_url', 'head_office_business_established_year', 'branch_office_address1', 'branch_office_address2', 'vendor_branch_office_country_id', 'vendor_branch_office_state_id', 'vendor_branch_office_district_id', 'branch_office_pin_no', 'branch_office_telephone_no', 'branch_office_mobile_no', 'bank_name', 'bank_account_no', 'vendor_bank_account_type_id', 'ifsc_code', 'vendor_description'], 'required'],
            [['permanent_address', 'vendor_description', 'is_active'], 'string'],
            [['vendor_head_office_country_id', 'vendor_head_office_state_id', 'vendor_head_office_district_id', 'head_office_pin_code', 'head_office_telephone_no', 'head_office_mobile_no', 'vendor_branch_office_country_id', 'vendor_branch_office_state_id', 'vendor_branch_office_district_id', 'branch_office_pin_no', 'branch_office_telephone_no', 'branch_office_mobile_no', 'bank_account_no', 'vendor_bank_account_type_id'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['name', 'email', 'gst_no', 'pan_no', 'tin_no', 'head_office_address1', 'head_office_address2', 'head_office_business_established_year', 'bank_name', 'ifsc_code'], 'string', 'max' => 200],
            [['head_office_company_url', 'branch_office_address1', 'branch_office_address2'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'gst_no' => 'Gst No',
            'pan_no' => 'Pan No',
            'tin_no' => 'Tin No',
            'permanent_address' => 'Permanent Address',
            'head_office_address1' => 'Head Office Address1',
            'head_office_address2' => 'Head Office Address2',
            'vendor_head_office_country_id' => 'Vendor Head Office Country ID',
            'vendor_head_office_state_id' => 'Vendor Head Office State ID',
            'vendor_head_office_district_id' => 'Vendor Head Office District ID',
            'head_office_pin_code' => 'Head Office Pin Code',
            'head_office_telephone_no' => 'Head Office Telephone No',
            'head_office_mobile_no' => 'Head Office Mobile No',
            'head_office_company_url' => 'Head Office Company Url',
            'head_office_business_established_year' => 'Head Office Business Established Year',
            'branch_office_address1' => 'Branch Office Address1',
            'branch_office_address2' => 'Branch Office Address2',
            'vendor_branch_office_country_id' => 'Vendor Branch Office Country ID',
            'vendor_branch_office_state_id' => 'Vendor Branch Office State ID',
            'vendor_branch_office_district_id' => 'Vendor Branch Office District ID',
            'branch_office_pin_no' => 'Branch Office Pin No',
            'branch_office_telephone_no' => 'Branch Office Telephone No',
            'branch_office_mobile_no' => 'Branch Office Mobile No',
            'bank_name' => 'Bank Name',
            'bank_account_no' => 'Bank Account No',
            'vendor_bank_account_type_id' => 'Vendor Bank Account Type ID',
            'ifsc_code' => 'Ifsc Code',
            'vendor_description' => 'Vendor Description',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'is_active' => 'Is Active',
        ];
    }
}
