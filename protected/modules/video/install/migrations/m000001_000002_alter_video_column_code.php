<?php

class m000001_000002_alter_video_column_code extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->alterColumn('{{video}}', 'code', 'text null');
    }

    public function safeDown()
    {
        $this->dropColumn('{{video}}', 'video');
    }
}
