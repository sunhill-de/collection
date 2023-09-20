<?php
/**
 * @file SunhillManager.php
 * A manager with routines for the sunhill collection
 * Lang en
 * Reviewstatus: 2023-09-13
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: 
 */

namespace Sunhill\Collection\Managers;

use Sunhill\Collection\Managers\Components\SunhillManager_collections;
use Sunhill\Collection\Managers\Components\SunhillManager_utils;
use Sunhill\Collection\Managers\Components\SunhillManager_keyfields;
use Sunhill\Collection\Managers\Components\SunhillManager_classes;
use Sunhill\Collection\Managers\Components\SunhillManager_objects;

class SunhillManager
{
   
    use SunhillManager_utils;
    use SunhillManager_collections;
    use SunhillManager_objects;
    use SunhillManager_keyfields;
    use SunhillManager_classes;
        
 }
