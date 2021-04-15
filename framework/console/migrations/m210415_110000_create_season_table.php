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
            'name' => $this->string(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        $this->insert('season', ['name' => 'Spring']);
        $this->insert('season', ['name' => 'Summer']);
        $this->insert('season', ['name' => 'Autumn']);
        $this->insert('season', ['name' => 'Winter']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%season}}');
    }
}
