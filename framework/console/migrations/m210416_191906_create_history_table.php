<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m210416_191906_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),

            'year' => $this->integer()->unsigned()->notNull()->comment('Year of history'),
            'season_id' => $this->integer()->notNull()->comment('Year season ID'),

            // todo - дополнительные поля для исторических данных
            // todo - или дополнительная таблица для исторических данных по каждому участку

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->append('ON UPDATE CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        $this->createIndex('idx-history-year', 'history',  'year');
        $this->createIndex('idx-history-season_id', 'history',  'season_id');
        $this->createIndex(
            "idx-unique-year-season", 'history',
            ['year', 'season_id'], true
        );
        $this->addForeignKey(
            'fk-history-season_id',
            'history', 'season_id',
            'season', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-history-season_id', 'history');
        $this->dropIndex('idx-unique-year-season', 'history');
        $this->dropIndex('idx-history-season_id', 'history');
        $this->dropIndex('idx-history-year', 'history');
        $this->dropTable('{{%history}}');
    }
}
