<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\pacients\RecordsMedical */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Records Medicals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="records-medical-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_pacient',
            'date_inspection',
            'inspection',
            'doctor',
            'patient_complaints',
            'history_disease',
            'objective_data',
            'diagnosis_underly',
            'complication',
            'concomitant_disease',
            'external_cause',
            'health_group',
            'dispensary_observation',
            'appointment',
            'drug',
            'certificate_incapacity',
            'preferential_recipes',
            'consent',
        ],
    ]) ?>

</div>
