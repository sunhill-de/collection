<?php

namespace Sunhill\Collection\Tests\Unit\Importer;

use Sunhill\Collection\Tests\DatabaseTestCase;
use Sunhill\Collection\Importer\EventUtils;
use Illuminate\Support\Facades\DB;

class EventUtilsTest extends DatabaseTestCase
{
    
    use EventUtils;
    
    /**
     * tests: src/Importer/MovieUtils->searchMoveInImports()
     */
    public function testSearchEvent_pass()
    {
    }
    
    /**
     * tests: src/Importer/MovieUtils->searchMoveInImports()
     */
    public function testSearchMovie_fail()
    {
    }
    
    /**
     * tests: src/Importer/MovieUtils->insertInImports()
     */
    public function testInsertInImports()
    {
    }
    
    /**
     * tests: src/Importer/MovieUtils->searchOrInsertInImports()
     */
    public function testSearchOrInsertInImports_known()
    {
    }

    /**
     * tests: src/Importer/MovieUtils->searchOrInsertInImports()
     */
    public function testSearchOrInsertInImports_unknown()
    {
    }
    
    /**
     * tests: src/Importer/MovieUtils->isAlreadyImported()
     */
    public function testEventIsAlreadyImported()
    {
    }
    
    public function testGetDate()
    {
        $this->assertEquals('2022-02-02',$this->getDate('02.02.2022'));
        $this->assertEquals('2022-02-02',$this->getDate('2.2.2022'));
    }
}