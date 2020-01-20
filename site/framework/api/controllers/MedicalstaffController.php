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

    public function actionView($id)
    {
        return $this->findModelInfo($id);
    }

    protected function findModelInfo($id)
    {
        if (($model = StaffInfo::findOne(['id_staff' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
