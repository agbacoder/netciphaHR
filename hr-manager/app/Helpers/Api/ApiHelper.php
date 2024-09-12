<?php

namespace App\Helpers\Api;

use App\Models\folders;

class ApiHelper
{
    public static function includeRouteFiles(string $folder)
    {
        $dirIterator = new \RecursiveDirectoryIterator ($folder);

        /** @var \RecursiveDirectoryIterator \RecursiveIteratorIterator $it    */

        $It = new \RecursiveIteratorIterator($dirIterator);

        while($It->valid()){
            if(!$It->isDot()
            && $It->isFile()
            && $It->isReadable()
            && $It->next()
            && $It->current()->getExtension() === 'php')
            {
                require $It->key();
            }
            $It->next();
        }
    }
}
