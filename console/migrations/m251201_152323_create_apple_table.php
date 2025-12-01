<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m251201_152323_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(32)->notNull(),
            'size' => $this->tinyInteger()->notNull(),
            'percent' => $this->tinyInteger()->notNull(),
            'status' => $this->string(32)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'fall_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
