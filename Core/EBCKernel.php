<?php

namespace Core;

require_once 'EBCAutoloader.php';

/**
 * EBC plugin director class
 */
class EBCKernel
{
    public static function appStart()
    {
        EBCAutoloader::register();
        EBCPostType::addPostType();
        EBCTemplates::addFilters();
        EBCAssets::enqueueAllAssets();
        EBCShortcodes::addShortcodes();
    }
}