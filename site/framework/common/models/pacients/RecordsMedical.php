<?php

namespace common\models\pacients;

use common\models\pacients\query\RecordsMedicalQuery;
use Yii;

/**
 * This is the model class for table "{{%records_medical}}".
 *
 * @property int $id
 * @property int $id_pacient Пациент
 * @property string $date_inspection Дата осмотра
 * @property string $inspection Осмотр
 * @property string $doctor Врач (специальность)
 * @property string $patient_complaints Жалобы пациента
 * @property string $history_disease Анамнез заболевания, жизни
 * @property string $objective_data Объективные данные
 * @property string $diagnosis_underly Диагноз основного заболевания
 * @property string $complication Осложнения
 * @property string $concomitant_disease Сопутствующие заболевания
 * @property string $external_cause Внешняя причина при травмах (отравлениях)
 * @property string $health_group Группа здоровья
 * @property string $dispensary_observation Диспансерное наблюдение
 * @property string $appointment Назначения (исследования, консультации)
 * @property string $drug Лекарственные препараты, физиотерапия
 * @property string $certificate_incapacity Листок нетрудоспособности, справка
 * @property string $preferential_recipes Льготные рецепты
 * @property int $consent Информированное добровольное согласие на медицинское вмешательство, отказ от медицинского вмешательства
 *
 * @property PacientsCart $pacient
 */
class RecordsMedical extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%records_medical}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pacient', 'date_inspection', 'doctor', 'patient_complaints', 'diagnosis_underly'], 'required'],
            [['id_pacient', 'consent'], 'integer'],
            [['date_inspection'], 'safe'],
            [['inspection', 'health_group'], 'string', 'max' => 50],
            [['doctor', 'certificate_incapacity', 'preferential_recipes'], 'string', 'max' => 255],
            [['patient_complaints', 'external_cause'], 'string', 'max' => 512],
            [['history_disease', 'objective_data', 'complication', 'concomitant_disease', 'appointment', 'drug'], 'string', 'max' => 1024],
            [['diagnosis_underly'], 'string', 'max' => 200],
            [['dispensary_observation'], 'string', 'max' => 150],
            [['id_pacient'], 'exist', 'skipOnError' => true, 'targetClass' => PacientsCart::className(), 'targetAttribute' => ['id_pacient' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pacient' => 'Пациент',
            'date_inspection' => 'Дата осмотра',
            'inspection' => 'Осмотр',
            'doctor' => 'Врач (специальность)',
            'patient_complaints' => 'Жалобы пациента',
            'history_disease' => 'Анамнез заболевания, жизни',
            'objective_data' => 'Объективные данные',
            'diagnosis_underly' => 'Диагноз основного заболевания',
            'complication' => 'Осложнения',
            'concomitant_disease' => 'Сопутствующие заболевания',
            'external_cause' => 'Внешняя причина при травмах (отравлениях)',
            'health_group' => 'Группа здоровья',
            'dispensary_observation' => 'Диспансерное наблюдение',
            'appointment' => 'Назначения (исследования, консультации)',
            'drug' => 'Лекарственные препараты, физиотерапия',
            'certificate_incapacity' => 'Листок нетрудоспособности, справка',
            'preferential_recipes' => 'Льготные рецепты',
            'consent' => 'Информированное добровольное согласие на медицинское вмешательство, отказ от медицинского вмешательства',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacient()
    {
        return $this->hasOne(PacientsCart::className(), ['id' => 'id_pacient']);
    }

    /**
     * {@inheritdoc}
     * @return RecordsMedicalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecordsMedicalQuery(get_called_class());
    }
}
