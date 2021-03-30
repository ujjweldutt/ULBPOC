<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Wms;
use frontend\models\WmsSearch;
use frontend\models\WmsWorkItems;
use frontend\models\MstRateType;
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
        $bytes = random_bytes(20);
        $alphanumeric = bin2hex($bytes);
        $model->work_code_number = $alphanumeric;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            return $this->redirect(['view', 'id' => $model->id]);
        }
        //echo "<pre>"; print_r($model->errors); die;
        

        return $this->render('create', [
            'model' => $model,
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
                  
                }


        }
      
        return $this->render('estimate', [
            'model' => $dataProvider,
            'dataWmsWork' => $dataWmsWork,
            'ratetypedata' => $ratetypedata,
        ]);
    }

    


}
