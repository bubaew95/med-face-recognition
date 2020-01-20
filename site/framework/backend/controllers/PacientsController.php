<?php

namespace backend\controllers;

use common\models\pacientimages\PacientImages;
use Yii;
use common\models\pacients\PacientsCart;
use backend\models\pacients\PacientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PacientsController implements the CRUD actions for PacientsCart model.
 */
class PacientsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PacientsCart models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PacientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionImages($pacient, $delete_id = null)
    {
        $images = PacientImages::find()->where(['id_pacient' => $pacient]);

        if(Yii::$app->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $params = Yii::$app->params;
            $item = $images->andWhere(['id' => $delete_id])->one(); 
            $imgPath = "{$params['pacient_image_path']}{$item->id_pacient}/{$item->img}";
            if(file_exists($imgPath)) {
                unlink($imgPath);
            }
            if($item->delete()) {
                return ['success'];
            }
            return ['error'];
        }

        return $this->render('images', [
            'images' => $images->all()
        ]);
    }

    /**
     * Displays a single PacientsCart model.
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
     * Creates a new PacientsCart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PacientsCart();
        $errors = [];
        if ($model->load(Yii::$app->request->post())) { 
            if($model->save()) {
                $model->images = UploadedFile::getInstances($model, 'images');
                $error = false;
                if($model->images) {
                    if(!$model->upload($model->id)) {
                        $error = true;
                        $errors = $model->errors;
                        //Yii::$app->session->setFlash('danger', print_r($model->errors));
                    }
                }
                return !$error ? $this->redirect(['view', 'id' => $model->id]) : null; 
            } else {
                $errors = $model->errors;
                //Yii::$app->session->setFlash('danger', print_r($model->errors));
            }
        }

        return $this->render('create', [
            'model' => $model,
            'errors' => $errors
        ]);
    }

    /**
     * Updates an existing PacientsCart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$model->scenario = PacientsCart::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->images = UploadedFile::getInstances($model, 'images');
            $error = false;
            if($model->images) {
                if(!$model->upload($model->id)) {
                    $error = true;
                    Yii::$app->session->setFlash('danger', $model->errors);
                }
            }
            return !$error ? $this->redirect(['view', 'id' => $model->id]) : null;
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PacientsCart model.
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
     * Finds the PacientsCart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PacientsCart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PacientsCart::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
