<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\medicalstaff\MedicalStaff */

$this->title = 'Добавление нового сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Мед персонал', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-staff-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelInfo' => $modelInfo,
    ]) ?>

</div>
