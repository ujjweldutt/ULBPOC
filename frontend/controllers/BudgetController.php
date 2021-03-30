<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Budget;
use frontend\models\BudgetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BudgetController implements the CRUD actions for Budget model.
 */
class BudgetController extends Controller
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
     * Lists all Budget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BudgetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Budget model.
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
     * Creates a new Budget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Budget();

        if (!empty(Yii::$app->request->post())) {
            
            
            if(isset($_FILES['Budget']['tmp_name']['uploaded_file']) && !empty($_FILES['Budget']['tmp_name']['uploaded_file'])){
                $path=Yii::$app->basePath."/web/writeData";
                if(!file_exists($path))
                 mkdir($path,0777,true);

                $extention=explode('.', $_FILES['Budget']['name']['uploaded_file']);
                 $fileName=hash_hmac("sha1",$_FILES['Budget']['tmp_name']['uploaded_file'].time(), "FILE_UPLOAD@908").".".end($extention); 
                 $path.="/".$fileName;
                 if(!move_uploaded_file($_FILES['Budget']['tmp_name']['uploaded_file'], $path)){
                      $model->addError('uploaded_file', 'Could not upload file please try again.');
                   return $this->render('create', [
                         'model' => $model,
                    ]); 
                }
                 $model->uploaded_file= APP_URL.'/frontend/web/writeData/'.$fileName;
             }
            if($model->load(Yii::$app->request->post()) && $model->save()){
                Yii::$app->session->setFlash("success","Budget ID created Successfully. Budget ID is: ".$model->id );
                return $this->redirect(['create']);
            }
            else{
             $err="";
             foreach ($model->geterrors() as $key => $errors) {
                 foreach ($errors as $key => $error) {
                     $err.="<li>".$error."</li>";
                 }
             }
             Yii::$app->session->setFlash("error",$err);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Budget model.
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
     * Deletes an existing Budget model.
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
     * Finds the Budget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Budget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Budget::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
