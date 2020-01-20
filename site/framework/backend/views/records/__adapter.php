<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summary' => false,
    'tableOptions' => [
        'class' => 'table datatable-html dataTable no-footer',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'id_pacient',
        'date_inspection',
        'inspection',
        'doctor',
        //'patient_complaints',
        //'history_disease',
        //'objective_data',
        //'diagnosis_underly',
        //'complication',
        //'concomitant_disease',
        //'external_cause',
        //'health_group',
        //'dispensary_observation',
        //'appointment',
        //'drug',
        //'certificate_incapacity',
        //'preferential_recipes',
        //'consent',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>