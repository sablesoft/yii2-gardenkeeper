<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210415_144610_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'plant_id' => $this->integer()->notNull()->comment('Plant ID'),

            'name' => $this->string()->comment('Plant product name'),

            // сезон завязи и сезон созревания
            // (в данной модели предусмотрено созревание продукта лишь раз в году):
            'ovary_season_id' => $this->integer()->notNull()->comment('Product ovary season ID'),
            'ripening_season_id' => $this->integer()->notNull()->comment('Product ripening season ID'),

            // средний возраст растения, в котором оно начинает давать этот продукт
            // (одно растение может давать различные продукты в разном своем возрасте, если не указано - всегда):
            'fertility_begin' => $this->integer()->unsigned()->comment('Fertility begin age'),
            'fertility_end' => $this->integer()->unsigned()->comment('Fertility end age'),

            // может ли растение сбросить этот продукт:
            'is_droppable' => $this->boolean()->unsigned()->comment('Is plant product droppable'),

            // среднее количество данного продукта c растения в год:
            'quantity' => $this->integer()->notNull()->comment('Product medium quantity in year'),

            // ценность продукта:
            'value' => $this->integer()->notNull()->unsigned()->comment('Product value'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        $this->createIndex('idx-product-plant_id', 'product',  'plant_id');
        $this->addForeignKey(
            'fk-product-plant_id',
            'product', 'plant_id',
            'plant', 'id'
        );

        $this->createIndex('idx-product-ovary_season_id', 'product',  'ovary_season_id');
        $this->addForeignKey(
            'fk-product-ovary_season_id',
            'product', 'ovary_season_id',
            'season', 'id'
        );

        $this->createIndex('idx-product-ripening_season_id', 'product',  'ripening_season_id');
        $this->addForeignKey(
            'fk-product-ripening_season_id',
            'product', 'ripening_season_id',
            'season', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product-plant_id', 'product');
        $this->dropForeignKey('fk-product-ovary_season_id', 'product');
        $this->dropForeignKey('fk-product-ripening_season_id', 'product');
        $this->dropIndex('idx-product-plant_id', 'product');
        $this->dropIndex('idx-product-ovary_season_id', 'product');
        $this->dropIndex('idx-product-ripening_season_id', 'product');
        $this->dropTable('{{%product}}');
    }
}
