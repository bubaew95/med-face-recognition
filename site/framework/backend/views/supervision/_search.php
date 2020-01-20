<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\pacients\SupervisionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medical-supervision-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_pacient') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'complaint') ?>

    <?= $form->field($model, 'observation_dynamics') ?>

    <?php // echo $form->field($model, 'appointment') ?>

    <?php // echo $form->field($model, 'drug') ?>

    <?php // echo $form->field($model, 'certificate_incapacity') ?>

    <?php // echo $form->field($model, 'preferential_recipes') ?>

    <?php // echo $form->field($model, 'doctor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
