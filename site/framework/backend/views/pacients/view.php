<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\PacientsCart */


$params = Yii::$app->params;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Карты пациентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card blog-horizontal">
    <div class="card-header header-elements-inline">
        <div class="pull-left">
            <?= Html::a('<i class="icon-folder-plus2"></i> Записи врачей', ['records/index', 'pacient' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?>
            <?= Html::a('<i class="icon-folder-heart"></i> Медицинское наблюдение', ['supervision/index', 'pacient' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
            <?= Html::a('<i class="icon-image2"></i> Изображения', ['pacients/images', 'pacient' => $model->id], ['class' => 'btn btn-default btn-sm']) ?>
        </div>
        <div class="header-elements">
            <div class="list-icons">
                <div class="float-right">
                    <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
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

            <div class="card-body">
                <?php if($model->pacientImages[0]->img) : ?>
                    <div class="card-img-actions mr-3">
                        <img class="card-img img-fluid" src="<?= "{$params['pacient_image_path']}{$model->id}/{$model->pacientImages[0]->img}"?>">
                        <div class="card-img-actions-overlay card-img">
                            <a href="<?= "{$params['pacient_image_path']}{$model->id}/{$model->pacientImages[0]->img}"?>" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                <i class="icon-link"></i>
                            </a>
                        </div>
                    </div>
                <?php endif ?>

                <h5 class="mb-2 font-weight-semibold">
                    <?php
                        $date = gmdate("Y-m-d", $model->created_at);
                        $expTime = explode('-', $date);
                    ?>
                    1. Дата заполнения медицинской карты:
                    число <span class="text-underline"><?= $expTime[2]?></span>
                    месяц  <span class="text-underline"><?= $expTime[1]?></span>
                    год  <span class="text-underline"><?= $expTime[0]?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    2. Фамилия, имя, отчество <span class="text-underline"><?= $model->name?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    3. Пол:
                    <?php
                        $sex = ['m' => 'муж. - 1', 'w' => 'жен. - 2'];
                        foreach ($sex as $key => $item) {
                            if($model->sex == $key) {
                                echo '<span class="text-underline">'.$item.'</span>';
                            } else {
                                echo "&nbsp{$item}";
                            }
                        }
                    ?>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    <?php $expBirthday = explode('-', $model->birthday); ?>
                    4. Дата рождения:
                    число <span class="text-underline"><?=$expBirthday[2]?></span>
                    месяц <span class="text-underline"><?=$expBirthday[1]?></span>
                    год <span class="text-underline"><?=$expBirthday[0]?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    5. Место регистрации: субъект Российской Федерации <span class="text-underline"><?= $model->permanent_address?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    6. Адрес регистрации по месту пребывания: субъект Российской Федерации <span class="text-underline"><?= $model->registration_address?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    7. Полис ОМС: <span class="text-underline"><?= $model->polis?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    8. СНИЛС: <span class="text-underline"><?= $model->snils?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    9. Наименование страховой медицинской организации <span class="text-underline"><?= $model->ins_organization?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    10. Документ (наименование,№,дата,кем выдан):
                    <span class="text-underline"><?= $model->passport?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    11. Заболевания, по поводу которых осуществляется диспансерное наблюдение:
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    12. Инвалидность (первичная, повторная, группа, дата) <span class="text-underline"><?= $model->disability?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    13. Место работы, должность <span class="text-underline"><?= $model->place_work?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    14. Группа крови <span class="text-underline"><?= $model->blood_group?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    15. HR фактор <span class="text-underline"><?= $model->hr_factor?></span>
                </h5>

                <h5 class="mb-2 font-weight-semibold">
                    16. Аллергические реакции <span class="text-underline"><?= $model->allergic?></span>
                </h5>

            </div>

        </div>
    </div>
</div>