<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plant}}`.
 */
class m210415_144412_create_plant_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%plant}}', [
            'id' => $this->primaryKey(),

            // название растения:
            'name' => $this->string()->notNull()->unique(),

            // средний срок жизни растения в годах:
            'lifespan' => $this->integer()->unsigned()->notNull()->comment('Medium life span (years)'),

            // климатические предпочтения растения - связь с характеристиками сезонов:
            'temperature_min' => $this->integer()->notNull()->comment('Minimal temperature (Celsius)'),
            'temperature_max' => $this->integer()->notNull()->comment('Maximal temperature (Celsius)'),
            'humidity_min' => $this->integer()->unsigned()->notNull()->comment('Minimal humidity'),
            'humidity_max' => $this->integer()->unsigned()->notNull()->comment('Maximal humidity'),
            'precipitation_min' => $this->integer()->unsigned()->notNull()->comment('Minimal precipitation'),
            'precipitation_max' => $this->integer()->unsigned()->notNull()->comment('Maximal precipitation'),
            'sunshine_min' => $this->integer()->unsigned()->notNull()->comment('Minimal sunshine'),
            'sunshine_max' => $this->integer()->unsigned()->notNull()->comment('Maximal sunshine'),
            'wind_min' => $this->integer()->unsigned()->notNull()->comment('Minimal windiness'),
            'wind_max' => $this->integer()->unsigned()->notNull()->comment('Maximal windiness'),

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
        $this->dropTable('{{%plant}}');
    }
}
