<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\pacients\RecordsMedicalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="records-medical-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_pacient') ?>

    <?= $form->field($model, 'date_inspection') ?>

    <?= $form->field($model, 'inspection') ?>

    <?= $form->field($model, 'doctor') ?>

    <?php // echo $form->field($model, 'patient_complaints') ?>

    <?php // echo $form->field($model, 'history_disease') ?>

    <?php // echo $form->field($model, 'objective_data') ?>

    <?php // echo $form->field($model, 'diagnosis_underly') ?>

    <?php // echo $form->field($model, 'complication') ?>

    <?php // echo $form->field($model, 'concomitant_disease') ?>

    <?php // echo $form->field($model, 'external_cause') ?>

    <?php // echo $form->field($model, 'health_group') ?>

    <?php // echo $form->field($model, 'dispensary_observation') ?>

    <?php // echo $form->field($model, 'appointment') ?>

    <?php // echo $form->field($model, 'drug') ?>

    <?php // echo $form->field($model, 'certificate_incapacity') ?>

    <?php // echo $form->field($model, 'preferential_recipes') ?>

    <?php // echo $form->field($model, 'consent') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
