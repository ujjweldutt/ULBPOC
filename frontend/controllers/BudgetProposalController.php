<?php

namespace frontend\controllers;

use Yii;
use frontend\models\BudgetProposal;
use frontend\models\BudgetProposalSearch;
use frontend\models\Budget;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BudgetProposalController implements the CRUD actions for BudgetProposal model.
 */
class BudgetProposalController extends Controller
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
     * Lists all BudgetProposal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BudgetProposalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BudgetProposal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $budgetmodel = new Budget();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'budgetmodel' => $budgetmodel,
        ]);
    }

    /**
     * Creates a new BudgetProposal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   

    public function actionCreate()
    {
        $model = new BudgetProposal();
        $budgetmodel = new Budget();

        if (!empty(Yii::$app->request->post())) {
            $data=[];
            foreach(Yii::$app->request->post('ulb_id') as $ulb){
                $amount_demanded=$_POST['amount_demanded'][$ulb];
                $data[]=array(
                    "amount_demanded"=>$amount_demanded,
                    "ulb_id"=>$ulb,
                    "budget_id"=>$_POST['BudgetProposal']['budget_id'],
                    "allocation_type"=>$_POST['BudgetProposal']['allocation_type'],
                    "status"=>'Y',
            
                );
              
            }

           
            if( Yii::$app->db->createCommand()->batchInsert('trans_budget_proposal', ['amount_demanded','ulb_id','budget_id','allocation_type','status'],$data)->execute())
                { 

                    
                    Yii::$app->session->setFlash("success","Proposal  created Successfully.");
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
            'budgetmodel'=>$budgetmodel
        ]);
    }

    /**
     * Updates an existing BudgetProposal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $model = $this->findModel($id);
            $budgetmodel = $this->findBudgetModel($model->budget_id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $budgetmodel->scheme_id = Yii::$app->request->post('Budget')['scheme_id'];
                $budgetmodel->financial_year_id = Yii::$app->request->post('Budget')['financial_year_id'];
                $budgetmodel->component_id = Yii::$app->request->post('Budget')['component_id'];
                if ($budgetmodel->save(false)) { 
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

        }catch (Exception $e) {
            $transaction->rollBack();
        }
        
       return $this->render('update', ['model' => $model, 'budgetmodel' => $budgetmodel,]);
    }

    public function actionProposal()
    {  
        $searchModel = new BudgetProposalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('proposal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $budgetmodel = $this->findBudgetModel($model->budget_id);
       if(isset($_POST['proposlaapprove']) || isset($_POST['proposlreject']))
       {   
            if(isset($_POST['proposlaapprove']))
            {
                $status=1;
            }else{
                $status=2;
            }

         

            $model->status=$status;
            $model->approved_by=1;
           if($model->save())
           {
            Yii::$app->session->setFlash("success","Proposal Approved /Rejected Successfully." );
            
                
            if(isset($_FILES['BudgetProposal']['tmp_name']['uploaded_file']) && !empty($_FILES['BudgetProposal']['tmp_name']['uploaded_file'])){
                $path=Yii::$app->basePath."/web/writeData";
                if(!file_exists($path))
                 mkdir($path,0777,true);

                $extention=explode('.', $_FILES['BudgetProposal']['name']['uploaded_file']);
                 $fileName=hash_hmac("sha1",$_FILES['BudgetProposal']['tmp_name']['uploaded_file'].time(), "FILE_UPLOAD@908").".".end($extention); 
                 $path.="/".$fileName;
                 if(!move_uploaded_file($_FILES['BudgetProposal']['tmp_name']['uploaded_file'], $path)){
                      $model->addError('uploaded_file', 'Could not upload file please try again.');
                   return $this->render('create', [
                         'model' => $model,
                    ]); 
                }
                 $model->uploaded_file= APP_URL.'/frontend/web/writeData/'.$fileName;
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

        return $this->render('approve', ['model' => $model, 'budgetmodel' => $budgetmodel]);

        
    }

    /**
     * Deletes an existing BudgetProposal model.
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
     * Finds the BudgetProposal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BudgetProposal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BudgetProposal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findBudgetModel($id)
    {
        if (($model = Budget::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBudget($component_id,$scheme_id,$financial_year_id)
    {
        if($component_id >0 && $scheme_id >0 && $financial_year_id>0 )
        {
            $budget=Budget::find()->where([
                'scheme_id'=>$scheme_id,
                'financial_year_id'=>$financial_year_id,
                'component_id'=>$component_id
                
                ]
            )->andWhere(["is_active"=>'Y'])->one();

            if(!empty($budget))
            {   

                $data="";
                $data.='<div class="row">';

                $data.='<div class="col-md-12">';
                $data.='<table class="table">';
                $data.='<body>';
                $data.='<tr>';
                    $data.='<th>Total Grant (Rs)</th>';
                    $data.='<th>Proposal in Process (Rs)</th>';
                    $data.='<th>Proposal Approved (Rs)</th>';
                    $data.='<th>Balance (Rs)</th>';
                $data.='</tr>';
                $data.='<tr>';
                $data.='<td><input name="BudgetProposal[budget_id]" type="hidden" value="'.$budget->id.'" />
                <input type="text" class="form-control" value="'.$budget->amount.'" readonly /> </td>';
                $data.='<td><input type="text" class="form-control" /></td>';
                $data.='<td><input type="text" class="form-control" /></td>';
                $data.='<td><input type="text" class="form-control" /></td>';
                 $data.='</tr>';
                $data.='</body>';
                $data.='</table>';
                $data.='</div>';
                $data.='</div>';
                

            }else{
                $data="Record not found.";
            }



        }else{
            $data="Something went wrong.";
        }
        return $data;
    }

    
}
