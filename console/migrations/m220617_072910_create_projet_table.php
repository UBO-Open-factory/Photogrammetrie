<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projet}}`.
 */
class m220617_072910_create_projet_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%projet}}', [
            'id' => $this->primaryKey(),
            'projet_id' => $this->integer(3)->notNull(),
            'vignette' => $this->string(),
            'nom' => $this->string(512)->notNull(),
            'date_created' => $this->dateTime(),
            'nombre_de photo' => $this->integer(3),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%projet}}');
    }
}
