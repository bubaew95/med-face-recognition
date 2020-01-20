<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\pacients\PacientsCartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$params = Yii::$app->params;

$this->title = 'Амбулаторные карты';
$this->params['breadcrumbs'][] = $this->title;
$sex = ['m' => "Муж.", 'w' => "Жен."];
?>

<div class="box">
    <div class="box-header">
        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
        <div class="header-elements">
            <div class="list-icons">
                <?= Html::a('<span class="fa fa-plus"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
    </div>

    <div class="card-body">

    </div>

    <div id="DataTables_Table_0_wrapper" class="box-body table-responsive no-padding">
        <div class="datatable-scroll table-responsive">

            <div class="pacients-cart-index">

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => false,
                    'tableOptions' => [
                        'class' => 'table datatable-html dataTable no-footer',
                    ],
                    'columns' => [
                        [
                            'options'   => ['width' => 20],
                            'class' => 'yii\grid\SerialColumn'
                        ],

                        //'id',
                        [
                            'options'   => ['width' => 105],
                            'attribute' => 'img',
                            'content' => function($model) use ($params) {
                                return Html::img("{$params['pacient_image_path']}{$model->id}/{$model->pacientImages[0]->img}", ['width' => 100]);
                            }
                        ],
                        [
                            'attribute' => 'name',
                        ],
                        [
                            'attribute' => 'sex',
                            'filter' => $sex,
                            'options'   => ['width' => 50],
                            'headerOptions'     => ['class' => 'text-center'],
                            'value' => function ($model) use ($sex) {
                                return $sex[$model->sex];
                            }
                        ],
                        [
                            'options'   => ['width' => 100],
                            'attribute' => 'birthday',
                        ],
                        [
                            'options'   => ['width' => 150],
                            'attribute' => 'phone',
                        ],
                        [
                            'options'   => ['width' => 150],
                            'attribute' => 'snils',
                        ],
                        [
                            'options'   => ['width' => 100],
                            'attribute' => 'polis',
                        ],
                        //'phone_home',
                        //'email:email',
                        //'position',
                        //'ogrn',
                        //'snils',
                        //'ins_organization',
                        //'polis',
                        //'permanent_address',
                        //'registration_address',
                        //'passport',
                        //'disability',
                        //'place_work',
                        //'blood_group',
                        //'hr_factor',
                        //'allergic:ntext',

                        [
                            'class'     => 'yii\grid\ActionColumn',
							'header'    => 'Действия',
							'options'   => ['width' => 200],
							'contentOptions'    => ['class' => 'text-center'],
							'headerOptions'     => ['class' => 'text-center'],
                            'buttons'=>[
                                'view'=>function ($url, $model) {
                                    return Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $url, ['class' => 'btn btn-info btn-sm']);
                                },
                                'update'=>function ($url, $model) {
                                    return Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $url, ['class' => 'btn btn-warning btn-sm']);
                                },
                                'delete'=>function ($url, $model) {
                                    return Html::a( '<span class="glyphicon glyphicon-trash"></span>', $url, ['class' => 'btn btn-danger btn-sm']);
                                }
                            ],
                            'template'=>'{view} {update} {delete} '
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>

        </div>
    </div>
</div>

