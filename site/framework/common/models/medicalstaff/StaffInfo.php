<?php

namespace common\models\medicalstaff;

use common\models\medicalstaff\query\StaffInfoQuery;
use Yii;

/**
 * This is the model class for table "{{%staff_info}}".
 *
 * @property int $id
 * @property int $id_staff Сотрудник
 * @property string $name ФИО
 * @property string $position Должность
 * @property string $education Образование
 * @property string $certificate Сертификат/Аккредитация
 * @property string $qualification Квалификация
 *
 * @property MedicalStaff $staff
 */
class StaffInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%staff_info}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_staff', 'name', 'position', 'education'], 'required'],
            [['id_staff'], 'integer'],
            [['name', 'position', 'education', 'qualification'], 'string', 'max' => 255],
            [['certificate'], 'string', 'max' => 512],
            [['id_staff'], 'exist', 'skipOnError' => true, 'targetClass' => MedicalStaff::className(), 'targetAttribute' => ['id_staff' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_staff' => 'Сотрудник',
            'name' => 'ФИО',
            'position' => 'Должность',
            'education' => 'Образование',
            'certificate' => 'Сертификат/Аккредитация',
            'qualification' => 'Квалификация',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(MedicalStaff::className(), ['id' => 'id_staff']);
    }

    /**
     * {@inheritdoc}
     * @return StaffInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffInfoQuery(get_called_class());
    }
}
