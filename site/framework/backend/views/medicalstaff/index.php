<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\medical\StaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Медперсонал';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
        <div class="header-elements">
            <div class="list-icons">
                <?= Html::a('<span class="icon-plus2"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
    </div>

    <div class="card-body">

    </div>

    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
        <div class="datatable-scroll table-responsive">
            <div class="medical-staff-index">
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
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        [
                           'attribute' => 'ФИО',
                            'content' => function($data) {
                                return $data->staffInfo->name;
                            }
                        ],
                        [
                            'attribute' => 'Должность',
                            'content' => function($data) {
                                return $data->staffInfo->position;
                            }
                        ],
                        'email:email',
                        //'auth_key',
                        //'password_hash',
                        //'password_reset_token',
                        //'status',
                        //'created_at',
                        //'updated_at',

                        [
                            'class' => 'yii\grid\ActionColumn',
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