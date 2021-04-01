<?php
 /**
  * this class contains all the common funciton used to in this applicaiton
  *@author Hemant Thakur
  */
namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\helpers\Html;
use yii\db\Query;
use common\models\District;
use common\models\SmsLogs;
use common\models\NewsLogs;
class Utility extends Component {
	/**
	* this function is used check is DC login
	*@author Hemant Thakur
	*@return boolean
	*/
	public function isAdmin(){
		$session = Yii::$app->getSession();
		if($session->get('role_id')==1)
			return true;
		return false;
	}
	public function isJuniorEngineer(){
		$session = Yii::$app->getSession();
		if($session->get('role_id')==2)
			return true;
		return false;
	}
	public function isExecutiveEngineer(){
		$session = Yii::$app->getSession();
		if($session->get('role_id')==3)
			return true;
		return false;
	}
	public function isSuperintendingEngineer(){
		$session = Yii::$app->getSession();
		if($session->get('role_id')==4)
			return true;
		return false;
	}
	public function isFinanceAuthority(){
		$session = Yii::$app->getSession();
		if($session->get('role_id')==5)
			return true;
		return false;
	}

	public function isBudgetAuthority(){
		$session = Yii::$app->getSession();
		if($session->get('role_id')==6)
			return true;
		return false;
	}
	public function isTechnicalAuthority(){
		$session = Yii::$app->getSession();
		if($session->get('role_id')==7)
			return true;
		return false;
	}

	/**
	* this function is used to get the role id of logged in user
	*@author Hemant Thakur
	*@return int
	*/
	public function getRoleIdofLoggedInUser(){
		$session = Yii::$app->getSession();
		return $session->get('role_id');
	}
	/**
	* this function is get the logged in user district name
	*@author Hemant Thakur
	*@return object
	*/
	public function getDisttNameOfLoggedInUser(){
		return @District::findOne(Yii::$app->user->identity->district_id)->district_name;

	}
	/**
	 * Function to sanatize a sting
	 * @param string $parameter
	 * @param boolean $strip_tags
	 * @return string
	 *@author Hemant Thakur
	 */
	function sanatizeParams($parameter, $strip_tags = true) {
		if (is_array($parameter)) {
		    $results = array();
		    foreach ($parameter as $key => $value) {
		    	/**
		    	* check for nested array 
		    	*added by hemant
		    	*/
		    	if(is_array($value)){
		    		$returnValue[$key]=$this->sanatizeParams($value);
		    		$results=array_merge($results,$returnValue);
		    		continue;
		    	}
		    	// edit finished
		        $value = trim($value);
		        if ($strip_tags) {
		            $value = strip_tags($value);
		        }
		        $value = $this->mysql_escape_string($value);
		        $results[$key] = $value;
		    }
		    return $results;
		} else {
		    $parameter = trim($parameter);
		    if ($strip_tags) {
		        $parameter = strip_tags($parameter);
		    }
		    $parameter = $this->mysql_escape_string($parameter);
		    return $parameter;
		}
				
	}
	/**
	* this function is used to sanatize the string
	*@author Hemant thakur
	*/
	public function sanatizeString($string){
		$string=strip_tags(trim($string));
		
		return $string;
	}
	/**
	 * Function to escape the string
	 * @param string $string
	 *@author Hemant Thakur
	 * @return string
	 */
	function mysql_escape_string($string) {
		$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		$string = mysqli_real_escape_string($link, $string);
		mysqli_close($link);
		return $string;
	}
	/**
	* function is used to get the menu items of the users
	*@author Hemant thakur
	*/
	function getMenuItems(){
		$menuItems="";
		if (!Yii::$app->user->isGuest) {
		   if($this->isDCLogin() || $this->isChiefSecretaryLogin() || $this->isSecretaryLogin() || $this->isAdmin()){
		   	 $menuItems.='<ul class="nav navbar-nav">
		   	     <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('notifications/create').'">New</a></li>
		   	     <li class="dropdown">
		   	         <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Reports <i class="fa fa-angle-down"></i></a>
		   	         <ul class="dropdown-menu">
		   	             <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/notifications/electronicmediapreport').'">Electronic Media</a></li>
		   	             <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/notifications/printmediareport').'">Print Media</a></li>
		   	             <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/notifications/socialmediareport').'">Social Media</a></li>
		   	         </ul>
		   	     </ li>
		   	     <li class="dropdown">
		   	         <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Action <i class="fa fa-angle-down"></i></a>
		   	         <ul class="dropdown-menu">
		   	             <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/notifications/report?type='.base64_encode("P")).'">Pending News</a></li>
		   	             <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/notifications/report?type='.base64_encode("A")).'">Fake News</a></li>
		   	            <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/notifications/report?type='.base64_encode("R")).'">Not Fake News</a></li>
		   	         </ul>
		   	     </li>
		   	     <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/users').'">User Management</a></li>
		  	    <li>'
	                 . Html::beginForm(['/site/logout'], 'post')
	                 . Html::submitButton(
	                     'Logout',
	                     ['class' => 'btn btn-link logout']
	                 	)
	                 . Html::endForm()
	                 . '</li>
		   	  </ul>';
		   }
		}
		else{
			 $menuItems.='<ul class="nav navbar-nav">
			     <li class="active"><a href="'.Yii::$app->homeUrl.'">Home</a></li>
			     <li class=""><a href="'.Yii::$app->urlManager->createAbsoluteUrl("site/listnews?type=".base64_encode('A')).'">All Fake News</a></li>
			     <li class=""><a href="'.Yii::$app->urlManager->createAbsoluteUrl("site/listnews?type=".base64_encode('R')).'">Not Fake News</a></li>
			     <li><a href="'.Yii::$app->urlManager->createAbsoluteUrl('notifications/create').'">Report Fake News</a></li>
			     <li class=""><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/site/about').'">About us</a></li>
			     <li class=""><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/site/dashboard').'">Dashboard</a></li>
			     <li class=""><a href="'.Yii::$app->urlManager->createAbsoluteUrl('/site/login').'">Officer Login</a></li>
			 </ul>';
		}
		return $menuItems;
	}
	/**
	* this function is used to call the api using curl
	*@author Hemant thakur
	*/
	function httpRequest($url, $params=NULL,$method='GET',$headers=null,$sslVerification=true) {
		// echo $params;die;
		$url = $this->sanatizeString($url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0');
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(!$sslVerification){
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		}
		if(!is_null($headers))
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$output = curl_exec($ch);
		if ($output === false) {
			$error = array();
			$error['ERROR_MSG'] = curl_error($ch);
			$error['ERROR_CODE'] = curl_errno($ch);
			$error['url'] = $url;
			$return = array();
			$return['STATUS_ID'] = '222';
			$return['STATUS_MSG'] = 'CURL_ERROR';
			$return['RESPONSE'] = $error;

			$error_message = "cURL ERROR: \t " . curl_errno($ch) . " - " . curl_error($ch);
			return json_encode($return);
		} 
		else {
			return $output;
		}
	}
	/**
	* this function is used to generate the random 5 digit otp
	*@author Hemant Thakur
	*@return int
	*/
	function generateOTP(){
		return rand(11111,99999);
	}
	/**
	* this function is used to send otp sms to mobile number
	*@author Hemant thakur
	*@param int mobile
	*@return json
	*/
	function sendOTP($mobile){
		$otp=rand();
		$session = Yii::$app->getSession();
		$otp = $session->get('mobileOTP');
		if(empty($otp) || $mobile!=$session->get('mobile')){
			$otp=$this->generateOTP();
			$session->set('mobileOTP',$otp);
			$session->set('mobile',$mobile);
		}
		$msg=$otp ." is your One Time Password to report fake news to Govt. of Himachal Pradesh";
		return $this->sendMobileMsg($msg,$mobile);
	}
	/**
	* this function is used to send Mobile SMS 
	*@author Hemant Thakur
 	*/
	function sendMobileMsg($message,$mobileno,$smsservicetype='singlemsg',$isBulkSMS=false){
		$key=hash('sha512', SMS_GATEWAY_USER_ID.SMS_GATEWAY_SENDER_ID.$message.SMS_DEPT_SECURE_KEY);
		$param= "username=".SMS_GATEWAY_USER_ID."&password=".sha1(SMS_GATEWAY_PASSWD)."&senderid=".SMS_GATEWAY_SENDER_ID."&content=".urlencode($message)."&smsservicetype=".$smsservicetype."&mobileno=".$mobileno."&key=".$key;
		$response=$this->httpRequest(SMS_GATEWAY_URL, $param,'POST',["content-type: application/x-www-form-urlencoded"],false);
		$this->generateSMSLog($mobileno,$message,$response);
		return $response;
	}
	/**
	* this function is used to save the sms log
	*@author Hemant Thakur
	*@param string mobile_numbers, string msg, string response
	*@return boolean
	*/

	function generateSMSLog($mobile,$msg,$response){
		$model=new SmsLogs;
		$model->sms_mobile_numbers=$mobile;
		$model->sms_content=$msg;
		$model->sms_status=$response;
		$model->sms_date_time=date("Y-m-d H:i:s");
		if($model->save())
			return true;
		return false;
	}
	/**
	* this function is used to generate the logs
	*@author Hemant Thakur
	*@param array()
	*@return boolean 
	*/
	public function generateLog($params){
		$model=new NewsLogs;
		$model->attributes=$params;
		$model->created_date=date("Y-m-d H:i:s");
		$model->remote_address=$_SERVER['REMOTE_ADDR'];
		$model->user_agent=$_SERVER['HTTP_USER_AGENT'];
		if(!Yii::$app->user->isGuest){
			$model->created_by=Yii::$app->user->identity->user_id;
			$model->created_by_role_id=Yii::$app->utility->getRoleIdofLoggedInUser();
		}
		else{
			$model->created_by=3;
			$model->created_by_role_id=3;
		}
       
		if($model->save())
		   return true;
		return false;

	}
	/**
	* this function is used to get the logs
	*@author Hemant Thakur
	*@param int notificationId
	*@return boolean
	*/
	public function getNewsLog($notificationId){
		return NewsLogs::find()->where(["notification_id"=>$notificationId])->orderBy(["log_id"=>SORT_DESC])->all();
	}
	/**
	* this function is used to get the FNMU mobile numbers
	*@author Hemant Thakur
	*@return []
	*/
	function getUserMobileNumbers($roleId){
		$sql="
		     SELECT usr.mobile_number FROM mst_user usr
		     INNER JOIN mst_user_role_mapping role
		     ON role.user_id=usr.user_id
		     WHERE role.role_id=:roleId AND usr.is_active='Y' AND usr.is_deleted='N' AND role.is_active='Y' AND role.is_deleted='N'

		";
		$connection = Yii::$app->db; 
		$command = $connection->createCommand($sql);
		$command->bindValue(":roleId", $roleId);
		return $command->queryAll();
	}

}