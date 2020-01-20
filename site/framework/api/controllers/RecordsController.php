<?php

namespace api\controllers;

use Yii;
use common\models\pacients\RecordsMedical;
use backend\models\pacients\RecordsMedicalSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecordsController implements the CRUD actions for RecordsMedical model.
 */
class RecordsController extends Controller
{
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * Finds the RecordsMedical model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RecordsMedical the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RecordsMedical::find()->where(['id_pacient' => $id])->all()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
