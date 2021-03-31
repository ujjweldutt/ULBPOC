<?php

namespace frontend\controllers;

use Yii;
use frontend\models\WmsWorkItems;
use frontend\models\Wms;
use frontend\models\MstItems;
use frontend\models\WmsWorkItemsSearch;
use frontend\models\Additems;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WmsWorkItemsController implements the CRUD actions for WmsWorkItems model.
 */
class WmsWorkItemsController extends Controller
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
     * Lists all WmsWorkItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WmsWorkItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WmsWorkItems model.
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
     * Creates a new WmsWorkItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        $request = Yii::$app->request;

        $id = $request->get('id');
        $wmsmodel = [];
        if(!empty($id)){
            $wmsmodel = Wms::find()->where(['id'=>$id])->one();
        }
        $model = new WmsWorkItems();
        if (!empty(Yii::$app->request->post())) {
            $loop = Yii::$app->request->post('estimate')['item']['itemid'];
            if(!empty($loop)){
                $flag = false;
                $bulkInsertArray = array();
                for($i=0; $i<count($loop); $i++) {
                    $bulkInsertArray[]=[
                        'wms_id'=> Yii::$app->request->post('estimate')['item']['wms_id'][$i],
                        'item_id'=>Yii::$app->request->post('estimate')['item']['itemid'][$i],
                        'description'=>Yii::$app->request->post('estimate')['item']['descriptionIT'][$i],
                        'remarks'=> Yii::$app->request->post('estimate')['item']['remarksIT'][$i],
                        'number1'=>Yii::$app->request->post('estimate')['item']['number1IT'][$i],
                        'length'=>Yii::$app->request->post('estimate')['item']['lengthIT'][$i],
                        'breadth'=>Yii::$app->request->post('estimate')['item']['breadthIT'][$i],
                        'height'=>Yii::$app->request->post('estimate')['item']['heightIT'][$i],
                        'unit'=>Yii::$app->request->post('estimate')['item']['unitIT'][$i],
                        'quantity'=> 50,
                        'rate_type_id'=>1,
                        'total_rate'=>50,
                        'total_amount'=>50
                    ];

                    if(count($bulkInsertArray)>0){
                        $columnNameArray=['wms_id','item_id','description','remarks','number1','length','breadth','height','unit','quantity','rate_type_id','total_rate','total_amount'];
                        $insertCount = Yii::$app->db->createCommand()
                                       ->batchInsert(
                                             'trans_wms_work_items', $columnNameArray, $bulkInsertArray
                                         )
                                       ->execute();
                        if($insertCount>0){
                            Yii::$app->session->setFlash("success","Work Item ID created Successfully.");

                            //Yii::$app->db->createCommand($TuncatTable)->execute());
                            
                             $TuncatTable = "DELETE FROM additems where wms_id=".Yii::$app->request->post('estimate')['item']['wms_id'][0];

                             Yii::$app->db->createCommand($TuncatTable)->execute();
                             
                            return $this->redirect(['wms/estimate-details',
                             'id' => Yii::$app->request->post('estimate')['item']['wms_id'][0]]);
                        }else{
                            Yii::$app->session->setFlash("errors","Something went wrong.");
                        }
                    }
                    
                    
                }
                

            }
        }

       

        // if (!empty(Yii::$app->request->post())) {
        //   if($model->load(Yii::$app->request->post())){
        //         $model->status= "1";
        //         $model->rate_type_id = 1;
        //         if($model->save() !=false){
        //             Yii::$app->session->setFlash("success","Work Item ID created Successfully. Work Item ID is: ".$model->id );
        //         }else{
        //             echo "Data not saved";
        //         }
        //     }else{
        //      $err="";
        //      foreach ($model->geterrors() as $key => $errors) {
        //          foreach ($errors as $key => $error) {
        //              $err.="<li>".$error."</li>";
        //          }
        //      }
        //      Yii::$app->session->setFlash("error",$err);
        //     }
        // }
        $searchModel = new WmsWorkItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        $dataWmsWork = Additems::find()->where(["wms_id"=>$id])->all(); 
        return $this->render('create', [
            'model' => $model, 
            'wmsmodel'=>$wmsmodel,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataWmsWork' => $dataWmsWork,
            ]);
    }
   

    /**
     * Updates an existing WmsWorkItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        

        $model = $this->findModel($id);
        $wmsmodel = new Wms();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

       

        // if(!empty($id)){
        //     $wmsmodel = Wms::find()->where(['id'=>$id])->one();
        // }
        $searchModel = new WmsWorkItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

 
        return $this->render('update', [
            'model' => $model,
            'wmsmodel' => $wmsmodel,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           
 
        ]);
    }

    /**
     * Deletes an existing WmsWorkItems model.
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
     * Finds the WmsWorkItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WmsWorkItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WmsWorkItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionGetItems(){
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $itemid = $request->get('item_id');
            $items = MstItems::find()->where(['id'=>$itemid])->asArray()->one();
            if(!empty($items)){
                return json_encode($items);
            }else{
                return false;
            }
           
        }
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
                    return $this->redirect(['wms-work-items/create', 'id' => $wms_id]);
                    
                }
               
               
            }
            if(isset($_POST) && isset($_POST['wmsitem_delete'])  ){
               
                $id=$_POST['wms_item_id'];
                $dataWmsWork = WmsWorkItems::find()->where(["id"=>$id])->one();
                $wms_id=$dataWmsWork->wms_id;
                $dataWmsWork->delete();
                return $this->redirect(['wms-work-items/create', 'id' => $wms_id]);
 
            }
 
            return $this->redirect(['wms-work-items/create', 'id' => $wms_id]);
        }
        
        
 
        return $this->redirect(['wms-work-items/create', 'id' => $wms_id]);
        
    }

    
}
