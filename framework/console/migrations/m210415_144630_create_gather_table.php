<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gather}}`.
 */
class m210415_144630_create_gather_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gather}}', [
            'id' => $this->primaryKey(),

            // ключи по участкам и типам продуктов - для удобства:
            'land_id' => $this->integer()->notNull()->comment('Land ID'),
            'product_id' => $this->integer()->notNull()->comment('Product ID'),

            // ключ растения на участке:
            'garden_id' => $this->integer()->notNull()->comment('Garden ID'),

            // собран ли продукт
            // (упавшие сами продукты считаются собранными):
            'is_harvested' => $this->boolean()->notNull()->defaultValue(false)->comment('Is product harvested'),

            // спелость продукта, проценты:
            'ripeness' => $this->integer()->unsigned()->notNull()->comment('Plant product ripeness'),

            // здоровье данного продукта, проценты:
            'health' => $this->integer()->unsigned()->notNull()->defaultValue(100)->comment('Plant product health'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        $this->createIndex('idx-gather-land_id', 'gather',  'land_id');
        $this->createIndex('idx-gather-product_id', 'gather',  'product_id');
        $this->createIndex('idx-gather-garden_id', 'gather',  'garden_id');
        $this->addForeignKey(
            'fk-gather-land_id',
            'gather', 'land_id',
            'land', 'id'
        );
        $this->addForeignKey(
            'fk-gather-product_id',
            'gather', 'product_id',
            'product', 'id'
        );
        $this->addForeignKey(
            'fk-gather-garden_id',
            'gather', 'garden_id',
            'garden', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-gather-land_id', 'gather');
        $this->dropForeignKey('fk-gather-product_id', 'gather');
        $this->dropForeignKey('fk-gather-garden_id', 'gather');
        $this->dropIndex('idx-gather-land_id', 'gather');
        $this->dropIndex('idx-gather-product_id', 'gather');
        $this->dropIndex('idx-gather-garden_id', 'gather');
        $this->dropTable('{{%gather}}');
    }
}
