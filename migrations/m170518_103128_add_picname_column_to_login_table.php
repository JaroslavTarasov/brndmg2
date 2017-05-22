<?php

use yii\db\Migration;

class m170518_103128_add_picname_column_to_login_table extends Migration
{

    public function up()
    {
        $this->addColumn('login', 'avatar', 'VARCHAR(256)');
        $this->addColumn('login', 'filename', 'VARCHAR(256)');
    }

    public function down()
    {
        $this->dropColumn('login', 'avatar');
        $this->dropColumn('login', 'filename');
    }
}
