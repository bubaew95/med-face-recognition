<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\MedicalSupervision */
$get = Yii::$app->request->get();

$this->title = 'Изменить наблюдение № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => ' Медицинское наблюдение в динамике', 'url' => ['index', 'pacient' => $get['pacient']]];
$this->params['breadcrumbs'][] = ['label' => "наблюдение №{$model->id}", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medical-supervision-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
