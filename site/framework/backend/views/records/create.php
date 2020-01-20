<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\RecordsMedical */
$get = Yii::$app->request->get();
$this->title = 'Добавить запись посещения врача';
$this->params['breadcrumbs'][] = ['label' => 'Записи врачей', 'url' => ['index', 'pacient' => $get['pacient']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="records-medical-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
