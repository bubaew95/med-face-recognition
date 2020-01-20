<?php

use yii\db\Migration;

class m130524_123456_init extends Migration
{

    const TABLE_NAME = '{{%medical_staff}}';

    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
           'id'             => $this->primaryKey()->unsigned(),
           'email'          => $this->string()->notNull()->unique(),
           'auth_key'       => $this->string(32)->notNull(),
           'password_hash'  => $this->string()->notNull(),
           'password_reset_token' => $this->string()->unique(),
           'status'         => $this->smallInteger()->notNull()->defaultValue(10),
           'created_at'     => $this->integer()->unsigned()->notNull(),
           'updated_at'     => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
