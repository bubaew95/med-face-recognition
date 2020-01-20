<?php

namespace common\models\pacients;

use common\models\pacientimages\PacientImages;
use Yii;
use yii\db\ActiveRecord;
use common\components\Constants;
use yii\imagine\Image;

/**
 * This is the model class for table "med_pacients_cart".
 *
 * @property int $id
 * @property string $name ФИО
 * @property string $sex Пол
 * @property string $birthday Дата рождения
 * @property string $phone Телефон
 * @property string $phone_home Домашний телефон
 * @property string $email E-mail
 * @property string $position Должность
 * @property int $ogrn Код ОГРН
 * @property string $snils СНИЛС
 * @property string $ins_organization Страховая медицинская организация
 * @property string $polis Номер страхового полиса ОМС
 * @property string $permanent_address Адрес постоянного места жительства
 * @property string $registration_address Адрес регистрации по месту пребывания
 * @property string $passport Документ, удостоверяюший право на льготное обеспечение (наименование,№,дата,кем выдан)
 * @property string $disability Инвалидность
 * @property string $place_work Место работы
 * @property string $blood_group Группа кровий
 * @property string $hr_factor HR фактор
 * @property string $allergic Аллергические реакции
 * @property int $created_at Дата заполнения медицинской карты
 * @property int $updated_at Дата изменения медицинской карты
 *
 * @property MedicalSupervision[] $medicalSupervisions
 * @property PacientImages[] $pacientImages
 * @property RecordsMedical[] $recordsMedicals
 */
class PacientsCart extends \yii\db\ActiveRecord
{

    public $images;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pacients_cart}}';
    }

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_UPDATE = 'update';

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => [
                'name', 'sex', 'birthday', 'snils', 'polis', 'permanent_address', 'passport', 'disability',
                'phone', 'phone_home', 'email', 'position', 'snils', 'ins_organization', 'permanent_address', 'registration_address', 'passport', 'disability', 'place_work',
                'updated_at', 'ogrn', 'allergic', 'blood_group', 'hr_factor'
            ],
            self::SCENARIO_UPDATE => ['name', 'sex', 'birthday', 'snils', 'polis', 'permanent_address', 'passport', 'disability'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'sex', 'birthday', 'snils', 'polis', 'permanent_address', 'passport', 'disability'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['name', 'sex', 'birthday', 'snils', 'polis', 'permanent_address', 'passport', 'disability'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['birthday'], 'safe'],
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,jpeg', 'maxFiles' => 10],
            [['ogrn', 'created_at', 'updated_at'], 'integer'],
            [['allergic'], 'string'],
            [['name', 'phone', 'phone_home', 'email', 'position', 'snils', 'ins_organization', 'permanent_address', 'registration_address', 'passport', 'disability', 'place_work'], 'string', 'max' => 255],
            [['sex'], 'string', 'max' => 1],
            [['polis', 'blood_group', 'hr_factor'], 'string', 'max' => 50],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function upload($id_user)
    {
        if ($this->validate()) {
            $basePath = "{$_SERVER['DOCUMENT_ROOT']}/uploads/{$id_user}";
            if(!is_dir("{$basePath}")) {
                mkdir("{$basePath}", 0777, true);
            }
            foreach ($this->images as $key => $file) {
                $nameImage = "{$id_user}_".time().".{$file->extension}";
                $newImagePath = "{$basePath}/{$nameImage}";

                $pacientImages              = new PacientImages();
                $pacientImages->img         = $nameImage; 

                if($file->saveAs($newImagePath)) {

                    Image::resize($newImagePath, 600, 600)
	                    ->save($newImagePath, ['quality' => 80]);


                    $pacientImages->embedings   = Constants::getVectorFace($newImagePath); //Ссылка на ФАЙЛ с распознованием
                    $this->link('pacientImages',$pacientImages );
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'sex' => 'Пол',
            'birthday' => 'Дата рождения',
            'phone' => 'Телефон',
            'phone_home' => 'Домашний телефон',
            'email' => 'E-mail',
            'position' => 'Должность',
            'ogrn' => 'Код ОГРН',
            'snils' => 'СНИЛС',
            'ins_organization' => 'Страховая медицинская организация',
            'polis' => 'Номер страхового полиса ОМС',
            'permanent_address' => 'Адрес постоянного места жительства',
            'registration_address' => 'Адрес регистрации по месту пребывания',
            'passport' => 'Документ, удостоверяюший право на льготное обеспечение (наименование,№,дата,кем выдан)',
            'disability' => 'Инвалидность',
            'place_work' => 'Место работы',
            'blood_group' => 'Группа кровий',
            'hr_factor' => 'HR фактор',
            'allergic' => 'Аллергические реакции',
            'created_at' => 'Дата заполнения медицинской карты',
            'updated_at' => 'Дата изменения медицинской карты',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalSupervisions()
    {
        return $this->hasMany(MedicalSupervision::className(), ['id_pacient' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacientImages()
    {
        return $this->hasMany(PacientImages::className(), ['id_pacient' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecordsMedicals()
    {
        return $this->hasMany(RecordsMedical::className(), ['id_pacient' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PacientsCartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PacientsCartQuery(get_called_class());
    }
}
