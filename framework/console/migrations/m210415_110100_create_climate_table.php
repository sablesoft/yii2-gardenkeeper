<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%climate}}`.
 */
class m210415_110100_create_climate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%climate}}', [
            'id' => $this->primaryKey(),

            // название климатической зоны:
            'name' => $this->string(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        // тестовая климатическая зона:
        $this->insert('climate', ['name' => 'Moscow Region']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%climate}}');
    }
}
