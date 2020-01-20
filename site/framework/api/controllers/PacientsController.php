<?php

namespace api\controllers;

use common\models\pacientimages\PacientImages;
use Yii;
use common\models\pacients\PacientsCart;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PacientsController implements the CRUD actions for PacientsCart model.
 */
class PacientsController extends Controller
{

    public function actionView($id) {
        return $this->findModel($id);
    }

    protected function findModel($id)
    {
        if (($model = PacientsCart::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
