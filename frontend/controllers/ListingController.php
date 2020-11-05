<?php

namespace frontend\controllers;

use Yii;

use frontend\models\Listing;
use frontend\models\Listingimage;
use frontend\models\ListingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Location;
use yii\web\UploadedFile;

/**
 * ListingController implements the CRUD actions for Listing model.
 */
class ListingController extends Controller
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
     * Lists all Listing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ListingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Listing model.
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
     * Creates a new Listing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Listing();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        
            return $this->redirect(['addlocation', 'addimage', 'listingId' => $model->listingId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionAddlocation($listingId)
    {
        $model = new Location();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['addimage', 'listingId' => $model->listingId]);
        }
        
        return $this->render('addlocation', [
            'model' => $model,
            'listingId'=>$listingId
        ]);
    }
    
    public function actionAddimage($listingId)
    {
        $model = new Listingimage();
        
        if ($model->load(Yii::$app->request->post())) 
        {
           //generates images with unique names
        $imageName = bin2hex(openssl_random_pseudo_bytes(10));
        $model->image = UploadedFile::getInstance($model, 'image');
       
        //saves file in the root directory
         $model->image->saveAs('uploads/'.$imageName.'.'.$model->image->extension);

            //save in the db
         $model->image ='uploads/'.$imageName.'.'.$model->image->extension;

         
         return $this->redirect(['index']);
        }

 
        return $this->render('addimage', [
            'model' => $model,
            'listingId' => $listingId,
        ]);

    }
     
    
    /**
     * Updates an existing Listing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->listingId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Listing model.
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
     * Finds the Listing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Listing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Listing::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
