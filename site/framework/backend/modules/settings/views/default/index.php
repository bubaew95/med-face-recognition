<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\settings\Module;
use backend\modules\settings\models\Setting;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var pheme\settings\models\SettingSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = "Настройки";
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
        Basic example of a datatable with <code>HTML (DOM)</code> sourced data. The foundation for DataTables is
        progressive enhancement, so it is very adept at reading table information directly from the <code>DOM</code>.
        This example shows how easy it is to add searching, ordering and paging to your HTML table by simply running
        DataTables with basic configuration on it.
    </div>

    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
        <div class="datatable-scroll">
            <div class="setting-index table-responsive">
                <?php Pjax::begin(); ?>
                    <div class="table-responsive">
                        <?=
                        GridView::widget(
                            [
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'summary' =>false,
                                'tableOptions' => [
                                    'class' => 'table datatable-html dataTable no-footer'
                                ],
                                'columns' => [
                                    'id',
                                    //'type',
                                    [
                                        'attribute' => 'section',
                                        'filter' => ArrayHelper::map(
                                            Setting::find()->select('section')->distinct()->where(['<>', 'section', ''])->all(),
                                            'section',
                                            'section'
                                        ),
                                    ],
                                    'key',
                                    //'value:ntext',
                                    [
                                        'class' => '\backend\modules\toggle_column\ToggleColumn',
                                        'attribute' => 'active',
                                        'filter' => [1 => Yii::t('yii', 'Yes'), 0 => Yii::t('yii', 'No')],
                                    ],
                                    \backend\components\widgets\GridViewButtons::viewButtons()
                                    //['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]
                        ); ?>
                    </div>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
