<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%garden}}`.
 */
class m210415_144422_create_garden_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%garden}}', [
            'id' => $this->primaryKey(),
            'land_id' => $this->integer()->notNull()->comment('Land ID'),
            'plant_id' => $this->integer()->notNull()->comment('Plant ID'),

            // возраст данного растения в саду:
            'age' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Garden plant age'),

            // плодовитость данного растения в саду
            // (дополнительный коэффициент к количеству продуктов с растения):
            'fertility' => $this->integer()->unsigned()->notNull()->comment('Garden plant fertility'),

            // здоровье данного растения в саду, проценты
            // (влияет на плодовитость и срок жизни растения):
            'health' => $this->integer()->unsigned()->notNull()
                ->defaultValue(100)->comment('Garden plant health'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->append('ON UPDATE CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        $this->createIndex('idx-garden-land_id', 'garden',  'land_id');
        $this->createIndex('idx-garden-plant_id', 'garden',  'plant_id');
        $this->addForeignKey(
            'fk-garden-land_id',
            'garden', 'land_id',
            'land', 'id'
        );
        $this->addForeignKey(
            'fk-garden-plant_id',
            'garden', 'plant_id',
            'plant', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-garden-land_id', 'garden');
        $this->dropForeignKey('fk-garden-plant_id', 'garden');
        $this->dropIndex('idx-garden-land_id', 'garden');
        $this->dropIndex('idx-garden-plant_id', 'garden');
        $this->dropTable('{{%garden}}');
    }
}
