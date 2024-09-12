<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;



trait ForeignKeyCheck
{
    protected function disableForeignKeys()
    {
        DB::statement(query:'SET FOREIGN_KEY_CHECKS=0');
    }
    protected function enableForeignKeys()
    {
        DB::statement(query:'SET FOREIGN_KEY_CHECKS=1');
    }
}

?>
