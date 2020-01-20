<?php

use yii\db\Migration;

/**
 * Class m190706_203149_medical_supervision
 */
class m190707_123456_medical_supervision extends Migration
{
    const FK_MEDICAL_SUPERVISION_KEY_1 = 'fk_medical_supervision_key_1';
    const TABLE_NAME = '{{%medical_supervision}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("SET foreign_key_checks = 0;");

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id'                        => $this->primaryKey()->unsigned(),
            'id_pacient'                => $this->integer()->unsigned()->notNull()->comment('Пациент'),
            'date'           => $this->dateTime()->notNull()->comment('Дата'),
            'complaint'                => $this->string(1024)->notNull()->comment('Жалобы'),
            'observation_dynamics' => $this->string(1024)->notNull()->comment('Данные наблюдения в динамике'),

            'appointment'               => $this->string(1024)->null()->comment('Назначения (исследования, консультации)'),
            'drug'                      => $this->string(1024)->null()->comment('Лекарственные препараты, физиотерапия'),
            'certificate_incapacity'    => $this->string(255)->null()->comment('Листок нетрудоспособности, справка'),
            'preferential_recipes'      => $this->string(255)->null()->comment('Льготные рецепты'),
            'doctor'                    => $this->string(255)->notNull()->comment('Доктор'),
        ], $tableOptions);

        $this->addForeignKey(
            self::FK_MEDICAL_SUPERVISION_KEY_1,
            self::TABLE_NAME,
            'id_pacient',
            m190631_123456_pacients::TABLE_NAME,
            'id'
        );

        $this->execute("SET foreign_key_checks = 1;");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(self::FK_MEDICAL_SUPERVISION_KEY_1, self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
