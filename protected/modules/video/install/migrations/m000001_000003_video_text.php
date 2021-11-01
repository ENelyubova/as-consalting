<?php

class m000001_000003_video_text extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{video}}', 'desc', 'text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{video}}', 'desc');
    }
}
