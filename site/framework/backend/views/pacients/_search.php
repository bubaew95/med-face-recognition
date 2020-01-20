<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\pacients\PacientsCartSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pacients-cart-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'birthday') ?>

    <?= $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'phone_home') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'ogrn') ?>

    <?php // echo $form->field($model, 'snils') ?>

    <?php // echo $form->field($model, 'ins_organization') ?>

    <?php // echo $form->field($model, 'polis') ?>

    <?php // echo $form->field($model, 'permanent_address') ?>

    <?php // echo $form->field($model, 'registration_address') ?>

    <?php // echo $form->field($model, 'passport') ?>

    <?php // echo $form->field($model, 'disability') ?>

    <?php // echo $form->field($model, 'place_work') ?>

    <?php // echo $form->field($model, 'blood_group') ?>

    <?php // echo $form->field($model, 'hr_factor') ?>

    <?php // echo $form->field($model, 'allergic') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
