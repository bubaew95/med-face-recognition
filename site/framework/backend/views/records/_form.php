<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\RecordsMedical */
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
        <div class="records-medical-form">

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-12">
                    <?= $form->field($model, 'date_inspection')->textInput() ?>

                    <?= $form->field($model, 'inspection')->dropDownList([
                        'на приеме',
                        'на дому',
                        'в фельдшерско-акушерском пункте',
                        'прочее'
                    ])
                    ?>

                    <?= $form->field($model, 'doctor')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'patient_complaints')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'history_disease')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'objective_data')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'diagnosis_underly')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'complication')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'concomitant_disease')->textarea(['maxlength' => true]) ?>

                </div>
                <div class="col-md-6 col-sm-12">

                    <?= $form->field($model, 'external_cause')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'health_group')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'dispensary_observation')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'appointment')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'drug')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'certificate_incapacity')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'preferential_recipes')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'consent')->dropDownList([
                        0 => 'Не согласен',
                        1 => 'Согласен',
                    ]) ?>
                </div>
            </div>





            <div class="form-group">
                <?= Html::submitButton('<i class="icon-floppy-disk"></i> Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
