<?php

namespace common\models\pacients;

use common\models\pacients\query\MedicalSupervisionQuery;
use Yii;

/**
 * This is the model class for table "{{%medical_supervision}}".
 *
 * @property int $id
 * @property int $id_pacient Пациент
 * @property string $date Дата
 * @property string $complaint Жалобы
 * @property string $observation_dynamics Данные наблюдения в динамике
 * @property string $appointment Назначения (исследования, консультации)
 * @property string $drug Лекарственные препараты, физиотерапия
 * @property string $certificate_incapacity Листок нетрудоспособности, справка
 * @property string $preferential_recipes Льготные рецепты
 * @property string $doctor Доктор
 *
 * @property PacientsCart $pacient
 */
class MedicalSupervision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%medical_supervision}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pacient', 'date', 'complaint', 'observation_dynamics', 'doctor'], 'required'],
            [['id_pacient'], 'integer'],
            [['date'], 'safe'],
            [['complaint', 'certificate_incapacity', 'preferential_recipes', 'doctor'], 'string', 'max' => 255],
            [['observation_dynamics', 'appointment', 'drug'], 'string', 'max' => 1024],
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
            'date' => 'Дата',
            'complaint' => 'Жалобы',
            'observation_dynamics' => 'Данные наблюдения в динамике',
            'appointment' => 'Назначения (исследования, консультации)',
            'drug' => 'Лекарственные препараты, физиотерапия',
            'certificate_incapacity' => 'Листок нетрудоспособности, справка',
            'preferential_recipes' => 'Льготные рецепты',
            'doctor' => 'Доктор',
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
     * @return MedicalSupervisionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MedicalSupervisionQuery(get_called_class());
    }
}
