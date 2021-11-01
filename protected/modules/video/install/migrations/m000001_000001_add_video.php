<?php

class m000001_000001_add_video extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{video}}', 'video', 'varchar(250)');
    }

    public function safeDown()
    {
        $this->dropColumn('{{video}}', 'video');
    }
}
