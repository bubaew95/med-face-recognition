<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\pacients\PacientsCart;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\pacients\RecordsMedicalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$get = Yii::$app->request->get();
$namePacient = PacientsCart::find()->select('name')->where(['id' => $get['pacient']])->asArray()->one();

$this->title = 'Медицинское наблюдение в динамике';
$this->params['breadcrumbs'][] = ['label' => $namePacient['name'] , 'url' => ['pacients/view', 'id' => $get['pacient']]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
        <div class="header-elements">
            <div class="list-icons">
                <?= Html::a('<span class="icon-plus2"></span> Добавить запись', ['create', 'pacient' => $get['pacient']], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
    </div>
</div>
<?php if($model) : ?>
    <?php foreach ($model as $item) : ?>
        <div class="card">
            <div class="card-body">
                <div class="datatable-scroll table-responsive">
                    <div class="records-medical-index">


                        <div class="item">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td colspan="2"><strong>Дата: </strong><?= $item->date?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Жалобы:</strong> <?= $item->complaint?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Данные наблюдения в динамике:</strong> <?= $item->observation_dynamics?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Назначения (исследования, консультации)</strong></td>
                                        <td><strong>Лекарственные препараты, физиотерапия</strong></td>
                                    </tr>
                                    <tr>
                                        <td><?= $item->appointment?></td>
                                        <td><?= $item->drug?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Листок нетрудоспособности, справка</strong></td>
                                        <td><strong>Льготные рецепты</strong></td>
                                    </tr>
                                    <tr>
                                        <td><?= $item->certificate_incapacity?></td>
                                        <td><?= $item->preferential_recipes?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><strong>Врач:</strong> <?= $item->doctor?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header header-elements-inline">
                <h6 class="card-title"> </h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <?= Html::a('<span class="icon-database-edit2"></span> Изменить', ['update', 'id' => $item->id, 'pacient' => $item->id_pacient], ['class' => 'btn btn-info btn-sm']) ?>
                        <?= Html::a(
                            '<span class="icon-trash"></span> Удалить',
                            ['delete', 'id' => $item->id],
                            [
                                'title' => Yii::t('yii', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'class' => 'btn btn-danger btn-sm'
                            ]
                        ) ?>
                    </div>
                </div>
            </div>

        </div>
    <?php endforeach ?>
<?php endif  ?>

