<?php

namespace frontend\controllers;

use Yii;
use frontend\models\WmsWorkItems;
use frontend\models\Wms;
use frontend\models\MstItems;
use frontend\models\WmsWorkItemsSearch;
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
          if($model->load(Yii::$app->request->post())){
                $model->status= "1";
                $model->rate_type_id = 1;
                if($model->save() !=false){
                    Yii::$app->session->setFlash("success","Work Item ID created Successfully. Work Item ID is: ".$model->id );
                }else{
                    echo "Data not saved";
                }
            }else{
             $err="";
             foreach ($model->geterrors() as $key => $errors) {
                 foreach ($errors as $key => $error) {
                     $err.="<li>".$error."</li>";
                 }
             }
             Yii::$app->session->setFlash("error",$err);
            }
        }
        $searchModel = new WmsWorkItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       
        return $this->render('create', [
            'model' => $model, 
            'wmsmodel'=>$wmsmodel,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    
}
