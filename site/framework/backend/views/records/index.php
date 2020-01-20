<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\pacients\PacientsCart;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\pacients\RecordsMedicalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$get = Yii::$app->request->get();
$namePacient = PacientsCart::find()->select('name')->where(['id' => $get['pacient']])->asArray()->one();

$this->title = 'Записи врачей';
$this->params['breadcrumbs'][] = ['label' => $namePacient['name'] , 'url' => ['pacients/view', 'id' => $get['pacient']]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
        <div class="header-elements">
            <div class="list-icons">
                <?= Html::a(
                        '<span class="icon-plus2"></span> Добавить запись',
                    ['create', 'pacient' => $get['pacient']],
                    ['class' => 'btn btn-success btn-sm']
                ) ?>
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
                        <div class="list-icons buttons-record">
                            <?= Html::a('<span class="icon-database-edit2"></span>', ['update', 'id' => $item->id, 'pacient' => $get['pacient']], ['class' => 'btn btn-info btn-sm']) ?>
                            <?= Html::a(
                                    '<span class="icon-trash"></span>',
                                    ['delete', 'id' => $item->id],
                                    [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'data-method' => 'post',
                                        'class' => 'btn btn-danger btn-sm'
                                    ]
                            ) ?>
                        </div>

                        <div class="item">
                            <h5 class="mb-2 font-weight-semibold">
                                Дата осмотра <span class="text-underline"><?= $item->date_inspection?></span> на приеме, на дому, в фельдшерско-акушерском пункте, прочее.
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Врач (специальность) <span class="text-underline"><?= $item->doctor?></span>
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Жалобы пациента <span class="text-underline"><?= $item->patient_complaints?></span>
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Анамнез заболевания, жизни <span class="text-underline"><?= $item->diagnosis_underly?></span>
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Объективные данные <span class="text-underline"><?= $item->objective_data?></span>
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Сопутствующие заболевания <span class="text-underline"><?= $item->concomitant_disease?></span>
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Осложнения <span class="text-underline"><?= $item->complication?></span>
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Внешняя причина при травмах (отравлениях) <span class="text-underline"><?= $item->external_cause?></span>
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Группа здоровья	 <span class="text-underline"><?= $item->health_group?></span>
                            </h5>

                            <h5 class="mb-2 font-weight-semibold">
                                Диспансерное наблюдение	 <span class="text-underline"><?= $item->dispensary_observation?></span>
                            </h5>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Назначения (исследования, консультации)</th>
                                    <th scope="col">Лекарственные препараты, физиотерапия</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $item->appointment?></td>
                                        <td><?= $item->drug?></td>
                                    </tr>
                                    <tr>
                                        <td>Листок нетрудоспособности, справка</td>
                                        <td>Льготные рецепты</td>
                                    </tr>
                                    <tr>
                                        <td><?= $item->certificate_incapacity?></td>
                                        <td><?= $item->preferential_recipes?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            Информированное добровольное согласие на медицинское вмешательство, отказ от медицинского вмешательства
                                            <img src="/admin/images/<?= $item->consent ? 'ok' : 'no'?>.png" alt="" width="16">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif  ?>

