<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\PacientsCart */

$this->title = 'Создание карты пациента';
$this->params['breadcrumbs'][] = ['label' => 'Карты пациентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacients-cart-create">

    <?= $this->render('_form', [
        'model' => $model,
        'errors' => $errors
    ]) ?>

</div>
