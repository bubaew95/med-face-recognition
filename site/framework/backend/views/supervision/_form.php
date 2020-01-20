<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\MedicalSupervision */
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
        <div class="medical-supervision-form">

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?= $form->field($model, 'date')->textInput() ?>

                    <?= $form->field($model, 'complaint')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'observation_dynamics')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'appointment')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <?= $form->field($model, 'drug')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'certificate_incapacity')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'preferential_recipes')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'doctor')->textarea(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="form-group float-right">
                <?= Html::submitButton('<i class="icon-floppy-disk"></i> Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <div class="clearfix"></div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>