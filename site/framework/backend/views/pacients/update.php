<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\PacientsCart */

$this->title = ' Редактирование карты пацинета: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Карты пациентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pacients-cart-update">

    <?= $this->render('_form', [
        'model' => $model,
        'errors' => $errors
    ]) ?>

</div>
