<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\RecordsMedical */
$get = Yii::$app->request->get();

$this->title = "Редактирование записи врача: {$model->doctor}";
$this->params['breadcrumbs'][] = ['label' => ' Записи врачей', 'url' => ['index', 'pacient' => $get['pacient']]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="records-medical-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
