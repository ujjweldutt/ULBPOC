<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Wms;
use frontend\models\WmsSearch;
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
    public function actionCreate() {
        $model = new Wms();
        if (!empty(Yii::$app->request->post())) {
             if(isset($_FILES['Wms']['tmp_name']['site_plan_file']) && !empty($_FILES['Wms']['tmp_name']['site_plan_file'])){
                $path=Yii::$app->basePath."/web/writeData";
                if(!file_exists($path))
                 mkdir($path,0777,true);

                $extention=explode('.', $_FILES['Wms']['name']['site_plan_file']);
                 $fileName=hash_hmac("sha1",$_FILES['Wms']['tmp_name']['site_plan_file'].time(), "FILE_UPLOAD@908").".".end($extention); 
                 $path.="/".$fileName;
                 if(!move_uploaded_file($_FILES['Wms']['tmp_name']['site_plan_file'], $path)){
                      $model->addError('site_plan_file', 'Could not upload file please try again.');
                   return $this->render('create', [
                         'model' => $model,
                    ]); 
                }
                 $model->site_plan_file= APP_URL.'/frontend/web/writeData/'.$fileName;
             }
              if(isset($_FILES['Wms']['tmp_name']['cross_section_file']) && !empty($_FILES['Wms']['tmp_name']['cross_section_file'])){
                $path=Yii::$app->basePath."/web/writeData";
                if(!file_exists($path))
                 mkdir($path,0777,true);

                $extention=explode('.', $_FILES['Wms']['name']['cross_section_file']);
                 $fileName=hash_hmac("sha1",$_FILES['Wms']['tmp_name']['cross_section_file'].time(), "FILE_UPLOAD@908").".".end($extention); 
                 $path.="/".$fileName;
                 if(!move_uploaded_file($_FILES['Wms']['tmp_name']['cross_section_file'], $path)){
                      $model->addError('cross_section_file', 'Could not upload file please try again.');
                   return $this->render('create', [
                         'model' => $model,
                    ]); 
                }
                 $model->cross_section_file= APP_URL.'/frontend/web/writeData/'.$fileName;
             }
              if(isset($_FILES['Wms']['tmp_name']['l_section_file']) && !empty($_FILES['Wms']['tmp_name']['l_section_file'])){
                $path=Yii::$app->basePath."/web/writeData";
                if(!file_exists($path))
                 mkdir($path,0777,true);

                $extention=explode('.', $_FILES['Wms']['name']['l_section_file']);
                 $fileName=hash_hmac("sha1",$_FILES['Wms']['tmp_name']['l_section_file'].time(), "FILE_UPLOAD@908").".".end($extention); 
                 $path.="/".$fileName;
                 if(!move_uploaded_file($_FILES['Wms']['tmp_name']['l_section_file'], $path)){
                      $model->addError('l_section_file', 'Could not upload file please try again.');
                   return $this->render('create', [
                         'model' => $model,
                    ]); 
                }
                 $model->l_section_file= APP_URL.'/frontend/web/writeData/'.$fileName;
             }
             if(isset($_FILES['Wms']['tmp_name']['google_map_file']) && !empty($_FILES['Wms']['tmp_name']['google_map_file'])){
                $path=Yii::$app->basePath."/web/writeData";
                if(!file_exists($path))
                 mkdir($path,0777,true);

                $extention=explode('.', $_FILES['Wms']['name']['google_map_file']);
                 $fileName=hash_hmac("sha1",$_FILES['Wms']['tmp_name']['google_map_file'].time(), "FILE_UPLOAD@908").".".end($extention); 
                 $path.="/".$fileName;
                 if(!move_uploaded_file($_FILES['Wms']['tmp_name']['google_map_file'], $path)){
                      $model->addError('google_map_file', 'Could not upload file please try again.');
                   return $this->render('create', [
                         'model' => $model,
                    ]); 
                }
                 $model->google_map_file= APP_URL.'/frontend/web/writeData/'.$fileName;
             }
             if(isset($_FILES['Wms']['tmp_name']['city_map_file']) && !empty($_FILES['Wms']['tmp_name']['city_map_file'])){
                $path=Yii::$app->basePath."/web/writeData";
                if(!file_exists($path))
                 mkdir($path,0777,true);

                $extention=explode('.', $_FILES['Wms']['name']['city_map_file']);
                 $fileName=hash_hmac("sha1",$_FILES['Wms']['tmp_name']['city_map_file'].time(), "FILE_UPLOAD@908").".".end($extention); 
                 $path.="/".$fileName;
                 if(!move_uploaded_file($_FILES['Wms']['tmp_name']['city_map_file'], $path)){
                      $model->addError('city_map_file', 'Could not upload file please try again.');
                   return $this->render('create', [
                         'model' => $model,
                    ]); 
                }
                 $model->city_map_file= APP_URL.'/frontend/web/writeData/'.$fileName;
             }
          
            if ($model->load(Yii::$app->request->post())) {
                   $model->work_code_number="UK00".date("Y-m-d h:i");
                     $model->save();
                //return $this->redirect(['view', 'id' => $model->id]);
                Yii::$app->session->setFlash("success", "Project Estimate ID created Successfully. Work ID is: " . $model->id);
                return $this->redirect(['index']);
            } else {
                $err = "";
                foreach ($model->geterrors() as $key => $errors) {
                    foreach ($errors as $key => $error) {
                        $err .= "<li>" . $error . "</li>";
                    }
                }
                Yii::$app->session->setFlash("error", $err);
            }
        }

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
}
