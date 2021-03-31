<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Wms;
use frontend\models\WmsSearch;
use frontend\models\WmsWorkItems;
use frontend\models\MstRateType;
use frontend\models\MstAnnouncement;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WmsController implements the CRUD actions for Wms model.
 */
class WmsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Wms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WmsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wms model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Wms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wms();
        $bytes =  rand(1000,9999);
        $partOne =  substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);    
        $partTwo =  substr(str_shuffle("0123456789"), 0, 4);  
        $alphaNumer =  $partOne.$partTwo;
        $alphanumeric = 'UK-'.$bytes.'-'.$alphaNumer;
        $model->work_code_number = $alphanumeric;

        
        $ward = Yii::$app->request->post('Wms'); 
        if(!empty($ward)){
            $wardText = implode(",", $ward['ward']);
            $model->ward = $wardText;
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['wms-work-items/create', 'id' => $model->id]);
        }

        //$dataWmsWork = WmsWorkItems::find()->where(["wms_id"=>$id])->all();
        return $this->render('create', [
            'model' => $model,
            //'dataWmsWork' => $dataWmsWork
        ]);
    }

    /**
     * Updates an existing Wms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);   
    }

    /**
     * Deletes an existing Wms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Wms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wms::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
    public function actionEstimate()
    {
        $dataProvider = Wms::find()->all();
        return $this->render('estimate_list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEstimateDetails($id)
    {
        $dataProvider = Wms::find()->where(["id"=>$id])->one();
        $dataWmsWork = WmsWorkItems::find()->where(["wms_id"=>$id])->all();
        $ratetypedata = MstRateType::find()->where(["is_active"=>'Y'])->all();
        $flag=0;
        if(isset($_POST['save']))
        {
           
                foreach(Yii::$app->request->post('workitemid') as $workitemid){
                    $dataWmsWork = WmsWorkItems::find()->where(["id"=>$workitemid])->one();
                    $dataWmsWork->total_amount=$_POST['totalrate'][$workitemid];
                    $dataWmsWork->save();
                    $flag=1;
                }
 
                if($flag>0){
                    Yii::$app->session->setFlash("success","Total Amount Updated Successfully.");
                    return $this->redirect(['wms/estimate-details', 'id' => $id]);
                }
 
        }
      
        return $this->render('estimate', [
            'model' => $dataProvider,
            'dataWmsWork' => $dataWmsWork,
            'ratetypedata' => $ratetypedata,
        ]);
    }


    public function actionGetItems(){
        $item_type_id=$_GET['item_type_id'];
        $query = (new \yii\db\Query())
        ->select(['s.name','s.id'])->from(['s' => 'mst_items_groups'])
        ->where([
        's.item_id'=>$item_type_id]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $table="";
        $table.='<table class="table table-bordered" >';
        $table.='<thead>';
        $table.='<tr >
                    <th>S.No</th> 
                    <th>Name</th> 
                </tr>
            </thead>';
        if(isset($data)): $i=1; foreach ($data as $key => $val):
        $table.='<tbody>';
        $table.='<td>' .$i.'</td> ';
        $table.='<td> <a onclick="getitemlist('.$val['id'].')" class="itemgrouplink cursor-pointer"  >'.$val['name'].'</a></td> ';
        $table.='</tbody>';
        $i++; endforeach; endif; 
        $table.='</table>'; 
        
        return $table;
    }
 
    
    public function actionGetItemslist(){
        $itemid=$_GET['itemid'];
        $query = (new \yii\db\Query())
        ->select(['s.name','s.discription','s.unit','s.id'])->from(['s' => 'mst_items_type'])
        ->where([
        's.item_group_id'=>$itemid]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $table="";
        $table.='<table class="table table-bordered" >';
        $table.='<thead>';
        $table.='<tr >
                    <th>S.No</th> 
                    <th>Name</th> 
                </tr>
            </thead>';
        if(isset($data)): $i=1; foreach ($data as $key => $v):
        $table.='<tbody>';
        $table.='<td>' .$i.'</td> ';
        $table.='<td> <a onclick="getitem('.$v['id'].')" class="getitem cursor-pointer" data-unit='.$v['unit'].'  data-des='.$v['discription'].' data-item='.$v['name'].' >'.$v['name'].'</a></td> ';
        $table.='</tbody>';
        $i++; endforeach; endif; 
        $table.='</table>'; 
        
        return $table;
    }

    function actionAddItems(){
        $request = Yii::$app->request;
        // $createTable = 'CREATE TEMPORARY TABLE IF NOT EXISTS addItems(`wms_id` INT, `item_id` INT ,`description` text,`remarks` varchar(200),`number1` decimal(10,2), `length` decimal(10,2),`breadth` decimal(10,2),`height` decimal(10,2),`unit` varchar(100),`quantity` int(11),`rate_type_id` int(11),`total_rate` decimal(18,2) default null,`total_amount` decimal(18,2) default null);';
        // Yii::$app->db->createCommand($createTable)->execute();
        $sqlList = '';
        $wmsid = $request->post('wms_id');
        $item_id = $request->post('item_id');
        $description = $request->post('description');
        $remarks =  $request->post('remarks');
        $number1 =  $request->post('number1');
        $length = $request->post('length');
        $breadth = $request->post('breadth');
        $height = $request->post('height');
        $unit = $request->post('unit');
        $quantity = $request->post('quantity');
        $rate_type_id = $request->post('rate_type_id');
        $total_rate =  $request->post('total_rate');
        $total_amount = $request->post('total_amount');
        $sqlList .= "INSERT INTO addItems(
              `wms_id`,
              `item_id`,
              `description`,
              `remarks`,
              `number1`,
              `length`,
              `breadth`,
              `height`,
              `unit`,
              `quantity`,
              `rate_type_id`,
              `total_rate`,
              `total_amount`
            ) VALUES ($wmsid,$item_id,'$description','$remarks',$number1,$length,$breadth,$height,'$unit',$quantity,$rate_type_id,$total_rate,$total_amount)";
        
        if(!empty($sqlList)) {

          
            Yii::$app->db->createCommand($sqlList)->execute();
            $query = (new \yii\db\Query())
            ->select(['a.*','m.item_name as item_name'])
            ->innerjoin(['m'=>'mst_items'],'m.id=a.item_id')
            ->from(['a' => 'addItems'])
             ->where([
             'a.wms_id'=>$request->post('wms_id')]);
            $command = $query->createCommand();
            $data = $command->queryAll();
            
            $html = '';
            if(isset($data) && !empty($data)){
                foreach($data as $items){
                    $html = '<tr>';
                    $html.='<td>'.$items['item_name'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][itemid][]" value="'.$items['item_id'].'" />';
                    $html.='<input type="hidden" name="estimate[item][wms_id][]" value="'.$items['wms_id'].'" />';
                    $html.='<td>'.$items['description'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][descriptionIT][]"  value="'.$items['description'].'"/>';
                    $html.='<td>'.$items['remarks'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][remarksIT][]" value="'.$items['remarks'].'"/>';
                    $html.='<td>'.$items['number1'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][number1IT][]" value="'.$items['number1'].'"/>';
                    $html.='<td>'.$items['length'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][lengthIT][]" value="'.$items['length'].'"/>';
                    $html.='<td>'.$items['breadth'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][breadthIT][]" value="'.$items['breadth'].'" />';
                    $html.='<td>'.$items['height'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][heightIT][]" value="'.$items['height'].'"/>';
                    $html.='<td>'.$items['unit'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][unitIT][]" value="'.$items['unit'].'" />';
                    $html.='<td>'.$items['quantity'].'</td>';
                    $html.='<input type="hidden" name="estimate[item][quantityIT][]" value="'.$items['quantity'].'" />';
                    $html.='<td><a class="btn btn-warning modelblock1"  data-id="'.$items['wms_id'].'" href="#"  id="SModal'.$items['wms_id'].'" data-toggle="modal" data-target="#SModal">Edit</a>&nbsp;
                    <a class="btn btn-danger modelblockdelete"  data-id="'.$items['wms_id'].'" href="#"   data-toggle="modal" data-target="#DModal">Delete</a>';
                    $html.="</tr>";
                 }

            }

            return $html;
            die;
           
             
        }

        // $createTable = 'DROP TEMPORARY TABLE IF EXISTS cache_user_ids;DROP TEMPORARY TABLE IF EXISTS cache_product_ids;';
        // Yii::$app->db->createCommand($createTable)->execute();


    }

    function actionDeductItems(){
        
    }


    public function actionGetRatetypelist(){
        $itemid=$_GET['itemid'];
        $query = (new \yii\db\Query())
        ->select(['s.rate_type','s.rate','s.id'])->from(['s' => 'mst_rate_type'])
        ->where([
        's.item_type_id'=>$itemid]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $table="";
       
        if(isset($data)): $i=1; foreach ($data as $key => $v):
        $table.='<option value="'.$v['id'].'">'.$v['rate_type'].'</option>';
        $i++; endforeach; endif; 
        
        return $table;
    }

    public function actionEditEstimateDetails($id)
    {
        $dataWmsWork = WmsWorkItems::find()->where(["id"=>$id])->one();
        return   json_encode(['id'=>$dataWmsWork->id,
                      'item_name'=>$dataWmsWork->item->item_name,
                      'item_no'=>$dataWmsWork->item->item_no,
                      'description'=>$dataWmsWork->description,
                      'remarks'=>$dataWmsWork->remarks,
                      'number1'=>$dataWmsWork->number1,
                      'length'=>$dataWmsWork->length,
                      'breadth'=>$dataWmsWork->breadth,
                      'height'=>$dataWmsWork->height,
                      'unit'=>$dataWmsWork->unit,
                      'quantity'=>$dataWmsWork->quantity,
                      'status'=>200
                     ]);
    }

    public function actionUpdateEstimateDetails()
    {
        if(isset($_POST))
        {
            if(isset($_POST) && isset($_POST['wmsitem_update'])  ){
                $id=$_POST['wms_item_id'];
                $dataWmsWork = WmsWorkItems::find()->where(["id"=>$id])->one();
                $wms_id=$dataWmsWork->wms_id;
              
                $dataWmsWork->description = $_POST['description'];
                $dataWmsWork->remarks = $_POST['remarks'];
                $dataWmsWork->number1 = $_POST['number1'];
                $dataWmsWork->length = $_POST['length'];
                $dataWmsWork->breadth = $_POST['breadth'];
                $dataWmsWork->height = $_POST['height'];
                $dataWmsWork->unit = $_POST['unit'];
                $dataWmsWork->quantity = $_POST['quantity'];
                if( $dataWmsWork->save())
                {
                    return $this->redirect(['wms/estimate-details', 'id' => $wms_id]);
                    
                }
               
               
            }
            if(isset($_POST) && isset($_POST['wmsitem_delete'])  ){
               
                $id=$_POST['wms_item_id'];
                $dataWmsWork = WmsWorkItems::find()->where(["id"=>$id])->one();
                $wms_id=$dataWmsWork->wms_id;
                $dataWmsWork->delete();
                return $this->redirect(['wms/estimate-details', 'id' => $wms_id]);
 
            }
 
            return $this->redirect(['wms/estimate-details', 'id' => $wms_id]);
        }
        
        
 
        return $this->redirect(['wms/estimate']);
        
    }

    


    

    


}
