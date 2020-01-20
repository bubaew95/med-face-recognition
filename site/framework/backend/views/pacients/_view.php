<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\PacientsCart */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pacients Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card">
    <div class="card-header header-elements-inline">
        <div class="pull-left">
            <?= Html::a('<i class="icon-folder-plus2"></i> Записи врачей', ['records/index', 'pacient' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?>
            <?= Html::a('<i class="icon-folder-heart"></i> Медицинское наблюдение', ['supervision/index', 'pacient' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
        </div>
        <div class="header-elements">
            <div class="list-icons">
                <div class="float-right">
                    <?= Html::a('<i class="icon-pencil5"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('<i class="icon-trash"></i>', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">

    </div>

    <div class="card-body">

        <div class="pacients-cart-view">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'sex',
                    'birthday',
                    'phone',
                    'phone_home',
                    'email:email',
                    'position',
                    'ogrn',
                    'snils',
                    'ins_organization',
                    'polis',
                    'permanent_address',
                    'registration_address',
                    'passport',
                    'disability',
                    'place_work',
                    'blood_group',
                    'hr_factor',
                    'allergic:ntext',
                ],
            ]) ?>

        </div>
    </div>
</div>
<!-- -->