<?php

use yii\db\Migration;

/**
 * Class m190630_191058_user_info
 */
class m190631_123456_pacients extends Migration
{

    const TABLE_NAME = '{{%pacients_cart}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id'                    => $this->primaryKey()->unsigned(),
            'name'                  => $this->string(255)->notNull()->comment('ФИО'),
            'sex'                   => $this->string(1)->notNull()->comment('Пол'),
            'birthday'              => $this->date()->notNull()->comment('Дата рождения'),
            'phone'                 => $this->string(255)->null()->comment('Телефон'),
            'phone_home'            => $this->string(255)->null()->comment('Домашний телефон'),
            'email'                 => $this->string(255)->null()->comment('E-mail'),
            'position'              => $this->string(255)->null()->comment('Должность'),

            'ogrn'                  => $this->bigInteger(12)->null()->comment('Код ОГРН'),
            'snils'                 => $this->string(255)->notNull()->comment('СНИЛС'),
            'ins_organization'      => $this->string(255)->null()->comment('Страховая медицинская организация'),
            'polis'                 => $this->string(50)->notNull()->comment('Номер страхового полиса ОМС'),

            'permanent_address'     => $this->string(255)->notNull()->comment('Адрес постоянного места жительства'),
            'registration_address'  => $this->string(255)->null()->comment('Адрес регистрации по месту пребывания'),
            'passport'              => $this->string(255)->notNull()->comment('Документ, удостоверяюший право на льготное обеспечение (наименование,№,дата,кем выдан)'),
            'disability'            => $this->string(255)->notNull()->comment('Инвалидность'),
            'place_work'            => $this->string(255)->null()->comment('Место работы'),

            'blood_group'           => $this->string(50)->null()->comment('Группа кровий'),
            'hr_factor'             => $this->string(50)->null()->comment('HR фактор'),
            'allergic'              => $this->text()->null()->comment('Аллергические реакции'),
            'created_at'            => $this->integer()->unsigned()->notNull()->comment('Дата заполнения медицинской карты'),
            'updated_at'            => $this->integer()->unsigned()->notNull()->comment('Дата изменения медицинской карты'),

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

}
