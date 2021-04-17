<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weather}}`.
 */
class m210415_110200_create_weather_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weather}}', [
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
                ->append('ON UPDATE CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        $this->createIndex( 'idx-weather-climate_id', 'weather',  'climate_id' );
        $this->createIndex( 'idx-weather-season_id', 'weather',  'season_id' );
        $this->createIndex(
            "idx-unique-weather", 'weather',
            ['climate_id', 'season_id'], true
        );
        $this->addForeignKey(
            'fk-weather-climate_id',
            'weather', 'climate_id',
            'climate', 'id'
        );
        $this->addForeignKey(
            'fk-weather-season_id',
            'weather', 'season_id',
            'season', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-weather-climate_id', 'weather');
        $this->dropForeignKey('fk-weather-season_id', 'weather');
        $this->dropIndex('idx-weather-season_id', 'weather');
        $this->dropIndex('idx-weather-climate_id', 'weather');
        $this->dropIndex('idx-unique-weather', 'weather');
        $this->dropTable('{{%weather}}');
    }
}
