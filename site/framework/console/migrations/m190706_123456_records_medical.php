<?php

use yii\db\Migration;

/**
 * Class m190706_195920_records_medical
 */
class m190706_123456_records_medical extends Migration
{

    const FK_RECORDS_MEDICAL_KEY_1 = 'fk_records_medical_key_1';
    const TABLE_NAME = '{{%records_medical}}';

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
            'date_inspection'           => $this->dateTime()->notNull()->comment('Дата осмотра'),
            'inspection'                => $this->string(50)->null()->comment('Осмотр'),
            'doctor'                    => $this->string(255)->notNull()->comment('Врач (специальность)'),
            'patient_complaints'        => $this->string(512)->notNull()->comment('Жалобы пациента'),
            'history_disease'           => $this->string(1024)->null()->comment('Анамнез заболевания, жизни'),
            'objective_data'            => $this->string(1024)->null()->comment('Объективные данные'),
            'diagnosis_underly'         => $this->string(200)->notNull()->comment('Диагноз основного заболевания'),
            'complication'              => $this->string(1024)->null()->comment('Осложнения'),
            'concomitant_disease'       => $this->string(1024)->null()->comment('Сопутствующие заболевания'),
            'external_cause'            => $this->string(512)->null()->comment('Внешняя причина при травмах (отравлениях)'),
            'health_group'              => $this->string(50)->null()->comment('Группа здоровья'),
            'dispensary_observation'    => $this->string(150)->null()->comment('Диспансерное наблюдение'),

            'appointment'               => $this->string(1024)->null()->comment('Назначения (исследования, консультации)'),
            'drug'                      => $this->string(1024)->null()->comment('Лекарственные препараты, физиотерапия'),
            'certificate_incapacity'    => $this->string(255)->null()->comment('Листок нетрудоспособности, справка'),
            'preferential_recipes'      => $this->string(255)->null()->comment('Льготные рецепты'),
            'consent'                   => $this->smallInteger(1)->null()->comment('Информированное добровольное согласие на медицинское вмешательство, отказ от медицинского вмешательства')
        ], $tableOptions);


        $inspections = [
            'на приеме',
            'на дому',
            'в фельдшерско-акушерском пункте',
            'прочее'
        ];


        $this->addForeignKey(
            self::FK_RECORDS_MEDICAL_KEY_1,
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
        $this->dropForeignKey(self::FK_RECORDS_MEDICAL_KEY_1, self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}
