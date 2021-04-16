<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%season}}`.
 */
class m210415_110000_create_season_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%season}}', [
            'id' => $this->primaryKey(),
            // название сезона:
            'name' => $this->string()->notNull()->unique(),
            // порядок сезонов:
            'order' => $this->integer()->unsigned()->notNull()->unique()->comment('Season order'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->append('ON UPDATE CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%season}}');
    }
}
