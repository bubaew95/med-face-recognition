<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\MedicalSupervision */
$get = Yii::$app->request->get();

$this->title = 'Добавить наблюдение';
$this->params['breadcrumbs'][] = ['label' => ' Медицинское наблюдение в динамике', 'url' => ['index', 'pacient' => $get['pacient']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-supervision-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
