<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rpi}}`.
 */
class m220617_071708_create_rpi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rpi}}', [
            'id' => $this->primaryKey(),
            'rpi_id' => $this->integer(3)->notNull(),
            'adresse_mac' => $this->string(512)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rpi}}');
    }
}
