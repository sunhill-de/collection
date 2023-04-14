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
        $this->assertEquals(1,$this->searchEvent('import_movies',1,'watch','2022-11-04'));
    }
    
    /**
     * tests: src/Importer/MovieUtils->searchMoveInImports()
     */
    public function testSearchMovie_fail()
    {
        $this->assertFalse($this->searchEvent('import_movies',1,'watch','2020-11-04'));
    }
    
    /**
     * tests: src/Importer/MovieUtils->insertInImports()
     */
    public function testInsertInImports()
    {
        $id = $this->insertEvent('import_movies',2,'watch','2023-04-13');
        $this->assertDatabaseHas('import_events',['date'=>'2023-04-13']);
    }
    
    /**
     * tests: src/Importer/MovieUtils->searchOrInsertInImports()
     */
    public function testSearchOrInsertInImports_known()
    {
        $this->assertEquals(1,$this->searchOrInsertEvent('import_movies',1,'watch','2022-11-04'));
    }

    /**
     * tests: src/Importer/MovieUtils->searchOrInsertInImports()
     */
    public function testSearchOrInsertInImports_unknown()
    {
        $this->assertTrue($this->searchOrInsertEvent('import_movies',2,'watch','2023-04-13')>0);
    }
    
    /**
     * tests: src/Importer/MovieUtils->isAlreadyImported()
     */
    public function testEventIsAlreadyImported()
    {
        $this->assertFalse($this->eventIsAlreadyImported(1));
        $this->assertTrue($this->eventIsAlreadyImported(2));
    }
    
    public function testGetDate()
    {
        $this->assertEquals('2022-02-02',$this->getDate('02.02.2022'));
        $this->assertEquals('2022-02-02',$this->getDate('2.2.2022'));
    }
}