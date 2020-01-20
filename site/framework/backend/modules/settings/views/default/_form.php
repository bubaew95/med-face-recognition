<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pheme\settings\Module;
use \pheme\settings\models\Setting;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/**
 * @var yii\web\View $this
 * @var pheme\settings\models\Setting $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
    </div>
    <div class="card-body">
        Basic example of a datatable with <code>HTML (DOM)</code> sourced data. The foundation for DataTables is
        progressive enhancement, so it is very adept at reading table information directly from the <code>DOM</code>.
        This example shows how easy it is to add searching, ordering and paging to your HTML table by simply running
        DataTables with basic configuration on it.
    </div>

    <div class="card-body">
        <div class="category-form">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'section')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>


            <?= $form->field($model, 'value')->textarea(); ?>

            <?= $form->field($model, 'active')->checkbox(['value' => 1]) ?>

            <?= $form->field($model, 'type')->dropDownList(
                $model->getTypes()
            )->hint('Change at your own risk') ?>

            <div class="form-group">
                <?=
                Html::submitButton(
                    $model->isNewRecord ? 'Create' : 'Update',
                    [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
                    ]
                ) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>