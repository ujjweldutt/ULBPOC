<?php



namespace frontend\controllers;



use Yii;

use yii\web\Controller;

use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;

use yii\rest\ActiveController;

use yii\filters\AccessControl;

use yii\web\Response;

use yii\base\ErrorException; 

use frontend\models\Budget;




define("APIUSERNAME", 'ulb@#1234');

define("APIPASSWORD", 'JovpQy2Cez6545sKDRvhX3p');



class ApiController extends \yii\web\Controller

{



    /**



     * Key which has to be in HTTP USERNAME and PASSWORD headers 



    */



    Const APPLICATION_ID = 'ULB2021@908';


    private $commonUtility;



    private $serviceProviderTag;



    private $departmentPublicKey;



    private $dbUtility;

 

    private $format = 'json';







    private function _isPOSTRequest(){



        if($_SERVER['REQUEST_METHOD']!='POST')



            $this->_sendResponse(405,"Method Not Allowed",$_SERVER['REQUEST_METHOD'] . "not allowed");



        return true;



    }







  

    public function beforeAction($action)



    {



    //    if($this->_checkAuth()==200)

       Yii::$app->request->enableCsrfValidation = false; 



       	return parent::beforeAction($action);



    //    $this->_sendResponse(401, 'Error: Authentication Failed.',"Error Code: 4011",["auth_user"=>@$_SERVER['PHP_AUTH_USER'],"auth_password"=>@$_SERVER['PHP_AUTH_PW']]);



    }



    /**



     * @return array action filters



     */


   


    private function _getStatusCodeMessage($status)



    {



        $codes = Array(



			200 => 'OK',



            204 => 'Data not Found',



			400 => 'Bad Request',



			401 => 'Unauthorized',



			402 => 'Payment Required',



			403 => 'Forbidden',



			404 => 'Data Not Found',



			500 => 'Internal Server Error',



			501 => 'Not Implemented',



            502 => 'Transaction Failed'



        );



        return (isset($codes[$status])) ? $codes[$status] : '';



    }



    private function _sendResponse($status = 200, $body = '', $msg='', $postArray=[], $unsetValue=true, $unsetKey=null, $content_type = 'application/json')
  {



      // set the status



      try{



          $post="";



          if(!empty($postArray))



              $post=$postArray;



          $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);



          header($status_header);



          header('Content-type: ' . $content_type);



          $responseArray=["STATUS"=>$status,"MSG"=>$msg,"RESPONSE"=>$body];



          echo json_encode($responseArray);



          if($unsetValue)



              unset($responseArray[$unsetKey]);



          //$this->generateAPILogs($post,$responseArray);



          exit;



          if($unsetValue)



              unset($responseArray[$unsetKey]);



      }



      catch(Expection $ex){



          $this->dbUtility->transaction->rollBack();



      }



      



  }



    public function filters()



    {



            return array();



    }







   
    private function isValidAPIHash($calHashString,$sentHash,$post){



        $cal_hash=hash_hmac('sha1',$calHashString, $this->departmentPublicKey);



        // echo $cal_hash;die;



      /*  if($cal_hash!=$sentHash)



            $this->_sendResponse(401, 'Error: Tempered data.',"Error Code: 4012",$post);*/



        return true;







    } 



    private function hasAllRequiredParams($reqParamList,$resParams){



        $paramArray="";



        foreach ($reqParamList as $key => $params)



            if(!isset($resParams[$params]) || empty($resParams[$params]))



                $paramArray.= $key."-";



        if(!empty($paramArray)){



            $paramArray=rtrim($paramArray,"-");



            $this->_sendResponse(400, 'Error: Missing Parameters.', "Error Code: 400-". $paramArray, $resParams);



        }



        return true;



    }



   function isPostRequest(){



     $request = Yii::$app->request;



     if(!$request->isPost){



       header('Content-Type: application/json');



       echo json_encode(["STATUS"=>405,"RESPONSE"=>"Method not allowed"]); 



       exit;



     }



     return true;



  }



    




    private function doAPIValidationCheck($post, $reqParams){



        $this->_isPOSTRequest();



        $this->hasAllRequiredParams($reqParams,$post);



        $apiHashArray=$post;

 



    }

    

     public function actionCreateBudget(){
           
        $reqParams=["scheme_id","component_id","financial_year_id","remarks","amount"];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new Budget();
        $model->scheme_id = $post['scheme_id'] ;
        $model->component_id = $post['component_id'] ;
        $model->financial_year_id = $post['financial_year_id'] ;
        $model->amount = $post['amount'] ;
        $model->remarks = $post['remarks'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }


    
    public function actionCreateBudgetProposal(){
        $reqParams=["budget_id","ulb_id","amount_demanded","allocation_type"];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new BudgetProposal();
        $model->budget_id = $post['budget_id'] ;
        $model->ulb_id = $post['ulb_id'] ;
        $model->amount_demanded = $post['amount_demanded'] ;
        $model->allocation_type = $post['allocation_type'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }


    
    public function actionCreateWms(){
 
        $reqParams=["work_code_number","ulb_id","ward_id","scheme_id","component_id",
        "financial_year_id","work_name","work_type","work_sub_type","work_scope",
        "announcement_type","announcement_no","announcement_date","site_plan_file",
        "cross_section_file","l_section_file","city_map_file"];


        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new Wms();
        $model->work_code_number = $post['work_code_number'] ;
        $model->ulb_id = $post['ulb_id'] ;
        $model->scheme_id = $post['scheme_id'] ;
        $model->component_id = $post['component_id'] ;
        $model->financial_year_id = $post['financial_year_id'] ;
        $model->work_name = $post['work_name'] ;
        $model->work_type = $post['work_type'] ;
        $model->work_sub_type = $post['work_sub_type'] ;
        $model->work_scope = $post['work_scope'] ;
        $model->announcement_type = $post['announcement_type'] ;
        $model->announcement_no = $post['announcement_no'] ;
        $model->announcement_date = $post['announcement_date'] ;
        $model->site_plan_file = $post['site_plan_file'] ;
        $model->cross_section_file = $post['cross_section_file'] ;
        $model->l_section_file = $post['l_section_file'] ;
        $model->city_map_file = $post['city_map_file'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }


    
    public function actionCreateComponent(){
        $reqParams=["component"];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new MstComponent();
        $model->component = $post['component'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }

    public function actionCreateFinancial(){
        $reqParams=["start_year"];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new MstFinancialYear();
        $model->component = $post['start_year'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }

    public function actionCreateItems(){
        $reqParams=['item_name', 'item_code'];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new MstItems();
        $model->item_name = $post['item_name'] ;
        $model->item_code = $post['item_code'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }


    public function actionCreateRateType(){
        $reqParams=['rate_type', 'rate', 'premium_rate'];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new MstRateType();
        $model->rate_type = $post['rate_type'] ;
        $model->rate = $post['rate'] ;
        $model->premium_rate = $post['premium_rate'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }


    public function actionCreateRoleType(){
        $reqParams=['role'];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new MstRole();
        $model->role = $post['role'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }


    public function actionCreateUlb(){
        $reqParams=['name'];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new MstUlb();
        $model->role = $post['name'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }

    public function actionCreateScheme(){
        $reqParams=['scheme'];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new MstScheme();
        $model->scheme = $post['scheme'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }


    public function actionCreateWard(){
        $reqParams=['ward_number'];

        $post  = $_POST; 

        $this->doAPIValidationCheck($post,$reqParams); 
 
        $model = new MstWard();
        $model->ward_number = $post['ward_number'] ;
        $model ->save();
        if( $model ->save()){
        $this->_sendResponse(200, "Success", ["data"=>$model]); 
        } else {
        $this->_sendResponse(401, "Success", ["data"=>$model ->errors]);     
        }  
        Yii::$app->end();

    }

  


}











