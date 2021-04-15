<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%climate_season}}`.
 */
class m210415_110200_create_climate_season_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%climate_season}}', [
            'id' => $this->primaryKey(),
            'climate_id' => $this->integer()->notNull()->comment('Climate ID'),
            'season_id' => $this->integer()->notNull()->comment('Season ID'),

            // характеристики данного сезона для данной климатической зоны - влияет на растения:
            // средняя температура:
            'temperature' => $this->integer()->notNull()->comment('Medium temperature (Celsius)'),
            // средняя влажность:
            'humidity' => $this->integer()->unsigned()->notNull()->comment('Medium humidity'),
            // средние осадки:
            'precipitation' => $this->integer()->unsigned()->notNull()->comment('Medium precipitation'),
            // средняя солнечность:
            'sunshine' => $this->integer()->unsigned()->notNull()->comment('Medium sunshine'),
            // средняя ветренность:
            'wind' => $this->integer()->unsigned()->notNull()->comment('Medium windiness'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        $this->createIndex( 'idx-climate_season-climate_id', 'climate_season',  'climate_id' );
        $this->createIndex( 'idx-climate_season-season_id', 'climate_season',  'season_id' );
        $this->addForeignKey(
            'fk-climate_season-climate_id',
            'climate_season', 'climate_id',
            'climate', 'id'
        );
        $this->addForeignKey(
            'fk-climate_season-season_id',
            'climate_season', 'season_id',
            'season', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-climate_season-climate_id', 'climate_season');
        $this->dropForeignKey('fk-climate_season-season_id', 'climate_season');
        $this->dropIndex('idx-climate_season-climate_id', 'climate_season');
        $this->dropIndex('idx-climate_season-season_id', 'climate_season');
        $this->dropTable('{{%climate_season}}');
    }
}
