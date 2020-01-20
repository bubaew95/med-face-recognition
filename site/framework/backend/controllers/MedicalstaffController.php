<?php

namespace backend\controllers;

use common\models\medicalstaff\StaffInfo;
use Yii;
use common\models\medicalstaff\MedicalStaff;
use backend\models\medical\StaffSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MedicalstaffController implements the CRUD actions for MedicalStaff model.
 */
class MedicalstaffController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MedicalStaff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MedicalStaff model.
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
     * Creates a new MedicalStaff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedicalStaff();
        $modelInfo = new StaffInfo();

        if ($model->load(Yii::$app->request->post()) && $modelInfo->load(Yii::$app->request->post())) {
            $model->setPassword($model->password);
            $model->generateAuthKey();
            if($model->save()) {
                $modelInfo->id_staff = $model->id;
                if ($model->link('staffInfo', $modelInfo)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else{
                    Yii::$app->session->setFlash('danger', $modelInfo->errors);
                }
            } else {
                Yii::$app->session->setFlash('danger', $model->errors);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelInfo' => $modelInfo,
        ]);
    }

    /**
     * Updates an existing MedicalStaff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelInfo = $this->findModelInfo($id);
        $model->scenario = MedicalStaff::SCENARIO_UPDATE;
        if ($model->load(Yii::$app->request->post()) && $modelInfo->load(Yii::$app->request->post())) {
            if(!empty($model->password) && !empty($model->repassword)) {
                $model->setPassword($model->password);
                $model->generateAuthKey();
            }
            if($model->save()) {
                if ($modelInfo->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else{
                    Yii::$app->session->setFlash('danger', $modelInfo->errors);
                }
            } else {
                Yii::$app->session->setFlash('danger', $model->errors);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelInfo' => $modelInfo
        ]);
    }

    /**
     * Deletes an existing MedicalStaff model.
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
     * Finds the MedicalStaff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedicalStaff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedicalStaff::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelInfo($id)
    {
        if (($model = StaffInfo::findOne(['id_staff' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
