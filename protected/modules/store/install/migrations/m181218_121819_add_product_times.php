<?php

class m181218_121819_add_product_times extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'times', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'times');
    }
}