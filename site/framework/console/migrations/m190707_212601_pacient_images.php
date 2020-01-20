<?php

use yii\db\Migration;

/**
 * Class m190707_212601_pacient_images
 */
class m190707_212601_pacient_images extends Migration
{

    const FK_PACIENT_IMAGES_KEY_1 = 'fk_pacient_images_key_1';
    const TABLE_NAME = '{{%pacient_images}}';

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
            'id_pacient'    => $this->integer()->unsigned()->notNull()->comment('Пациент'),
            'img'           => $this->string(255)->notNull()->comment('Изображение'),
            'embedings'     => $this->string(255)->notNull()->comment('Вектор лица'),
        ]);

        $this->addForeignKey(
            self::FK_PACIENT_IMAGES_KEY_1,
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
        $this->dropForeignKey(self::FK_PACIENT_IMAGES_KEY_1, self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
