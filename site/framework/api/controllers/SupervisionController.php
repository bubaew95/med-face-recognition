<?php

namespace api\controllers;

use common\models\medicalstaff\StaffInfo;
use Yii;
use common\models\pacients\MedicalSupervision;
use backend\models\pacients\SupervisionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SupervisionController implements the CRUD actions for MedicalSupervision model.
 */
class SupervisionController extends Controller
{
    public function actionView($id) {
        return $this->findModel($id);
    }

    /**
     * Finds the MedicalSupervision model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedicalSupervision the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedicalSupervision::find()->where(['id_pacient' => $id])->all()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
