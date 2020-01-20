<?php

use yii\db\Migration;

/**
 * Class m190706_191545_medical_staff_info
 */
class m190630_123456_medical_staff_info extends Migration
{

    const TABLE_NAME = '{{%staff_info}}';
    const FK_STAFF_INFO_KEY_1 = 'fk_staff_info_key_1';

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
            'id'            => $this->primaryKey()->unsigned(),
            'id_staff'      => $this->integer()->unsigned()->notNull()->comment('Сотрудник'),
            'name'          => $this->string(255)->notNull()->comment('ФИО'),
            'position'      => $this->string(255)->notNull()->comment('Должность'),
            'education'     => $this->string(255)->notNull()->comment('Образование'),
            'certificate'   => $this->string(512)->null()->comment('Сертификат/Аккредитация'),
            'qualification' => $this->string(255)->null()->comment('Квалификация')
        ], $tableOptions);


        $this->addForeignKey(
            self::FK_STAFF_INFO_KEY_1,
            self::TABLE_NAME,
            'id_staff',
            m130524_123456_init::TABLE_NAME,
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(self::FK_STAFF_INFO_KEY_1, self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
