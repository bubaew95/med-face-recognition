<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\medicalstaff\MedicalStaff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
        <div class="header-elements">
            <div class="list-icons">

            </div>
        </div>
    </div>

    <div class="card-body">
        Поля отмеченные звездочкой <strong style="color: red;">*</strong> обязательны для заполнения
    </div>

    <div class="card-body">
        <div class="medical-staff-form">

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-7">
                    <?= $form->field($modelInfo, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($modelInfo, 'position')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($modelInfo, 'education')->textarea(['maxlength' => true]) ?>
                    <?= $form->field($modelInfo, 'certificate')->textarea(['maxlength' => true]) ?>
                    <?= $form->field($modelInfo, 'qualification')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-md-5">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'repassword')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('<i class="icon-floppy-disk"></i> Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>