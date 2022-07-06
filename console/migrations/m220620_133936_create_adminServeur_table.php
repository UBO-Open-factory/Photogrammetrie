<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%adminServeur}}`.
 */
class m220620_133936_create_adminServeur_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%adminServeur}}', [
            'id' => $this->primaryKey(),
            'nom_projet' => $this->string(512)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%adminServeur}}');
    }
}
