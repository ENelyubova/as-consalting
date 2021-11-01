<?php

class m181218_121818_add_product_units extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{store_product}}', 'units', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('{{store_product}}', 'units');
    }
}