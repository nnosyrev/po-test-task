<?php

use yii\db\Migration;

class m251202_110927_alter_apples_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%apple}}', 'size', $this->decimal(3, 2)->notNull());
        $this->dropColumn('{{%apple}}', 'percent');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%apple}}', 'percent', $this->tinyInteger()->notNull());
        $this->alterColumn('{{%apple}}', 'size', $this->tinyInteger()->notNull());
    }
}
