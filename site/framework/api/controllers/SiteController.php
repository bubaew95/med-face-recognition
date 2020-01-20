<?php
namespace api\controllers;

use frontend\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        return [
            'code' => 100,
            'msg' => 'Error page'
        ];
    }
}
