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

            'lands' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total lands count'),
            'plants' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total growing plants count'),
            'plants_lost' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total plants lost'),
            'products' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total growing products count'),
            'products_value' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total products value'),
            'products_lost' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total products lost'),
            'harvested' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total harvested products count'),
            'harvested_value' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total harvested products value'),
            'harvested_lost' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total harvested products lost'),
            'used' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total used products count'),
            'used_value' => $this->integer()->unsigned()->notNull()->defaultValue(0)
                ->comment('Total used products value'),

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
