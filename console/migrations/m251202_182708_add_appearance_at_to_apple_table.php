<?php

use yii\db\Migration;

class m251202_182708_add_appearance_at_to_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%apple}}', 'appearance_at', $this->integer()->notNull()->defaultValue(0)->after('updated_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%apple}}', 'appearance_at');
    }
}
