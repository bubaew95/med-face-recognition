<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\medicalstaff\MedicalStaff */

$this->title = 'Редактирование: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Мед персонал', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medical-staff-update">
s
    <?= $this->render('_form', [
        'model' => $model,
        'modelInfo' => $modelInfo
    ]) ?>

</div>
