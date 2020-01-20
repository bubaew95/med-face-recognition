<?php

namespace common\models\pacientimages;

use common\models\pacients\PacientsCart;
use Yii;

/**
 * This is the model class for table "med_pacient_images".
 *
 * @property int $id
 * @property int $id_pacient Пациент
 * @property string $img Изображение
 * @property string $embedings Вектор лица
 *
 * @property PacientsCart $pacient
 */
class PacientImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pacient_images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pacient', 'img', 'embedings'], 'required'],
            [['id_pacient'], 'integer'],
            [['img'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, JPG, jpeg', 'maxFiles' => 10],
            [['img', 'embedings'], 'string', 'max' => 255],
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
            'img' => 'Изображение',
            'embedings' => 'Вектор лица',
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
     * @return PacientImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PacientImagesQuery(get_called_class());
    }
}
