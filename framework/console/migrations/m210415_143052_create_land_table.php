<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%land}}`.
 */
class m210415_143052_create_land_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%land}}', [
            'id' => $this->primaryKey(),
            // владелец участка:
            'user_id' => $this->integer()->notNull()->comment('Owner ID'),
            // климатические условия:
            'climate_id' => $this->integer()->notNull()->comment('Climate ID'),

            // размеры участка - условное количество клеток в ширину и длину:
            'width' => $this->integer()->unsigned()->notNull()->comment('Land width'),
            'length' => $this->integer()->unsigned()->notNull()->comment('Land length'),
            // рейтинг сада у пользователей :)
            'rating' => $this->integer(2)->unsigned(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Creation time'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Last update time')
        ]);

        $this->createIndex('idx-land-user_id', 'land',  'user_id');
        $this->createIndex('idx-land-climate_id', 'land',  'climate_id');
        $this->addForeignKey(
            'fk-land-climate_id',
            'land', 'climate_id',
            'climate', 'id'
        );
        $this->addForeignKey(
            'fk-land-user_id',
            'land', 'user_id',
            'user', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-land-climate_id', 'land');
        $this->dropForeignKey('fk-land-user_id', 'land');
        $this->dropIndex('idx-land-climate_id', 'land');
        $this->dropIndex('idx-land-user_id', 'land');
        $this->dropTable('{{%land}}');
    }
}
