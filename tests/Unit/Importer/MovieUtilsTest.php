<?php

namespace Sunhill\Collection\Tests\Unit\Importer;

use Sunhill\Collection\Tests\DatabaseTestCase;
use Sunhill\Collection\Importer\MovieUtils;

class MovieUtilsTest extends DatabaseTestCase
{
    
    use MovieUtils;
    
    /**
     * tests: src/Importer/MovieUtils->searchMoveInImports()
     */
    public function testSearchMovie_pass()
    {
       $this->assertEquals(1,$this->searchMovieInImports('After.Life','videobuster','04.11.2022'));
    }
    
    /**
     * tests: src/Importer/MovieUtils->searchMoveInImports()
     */
    public function testSearchMovie_fail()
    {
        $this->assertFalse($this->searchMovieInImports('8. Wonderland','videobuster','28.10.2022'));
    }
    
    /**
     * tests: src/Importer/MovieUtils->searchMoveInImports()
     */
    public function testSearchMove_differentkey()
    {
        $this->assertFalse($this->searchMovieInImports('After.Life','videobuster','28.10.2022'));        
    }
    
    /**
     * tests: src/Importer/MovieUtils->insertInImports()
     */
    public function testInsertInImports()
    {
        $this->insertInImports('Fight Club','videobuster','01.01.2023');
        $this->assertDatabaseHas('import_movies',['title'=>'Fight Club']);
    }
    
    /**
     * tests: src/Importer/MovieUtils->searchOrInsertInImports()
     */
    public function testSearchOrInsertInImports_known()
    {
        $this->assertEquals(1,$this->searchOrInsertInImports('After.Life','videobuster','04.11.2022'));
    }

    /**
     * tests: src/Importer/MovieUtils->searchOrInsertInImports()
     */
    public function testSearchOrInsertInImports_unknown()
    {
        $result = $this->searchOrInsertInImports('8. Wonderland','videobuster','04.11.2022');
        $this->assertTrue(is_numeric($result) && ($result > 0));
    }
    
    /**
     * tests: src/Importer/MovieUtils->isAlreadyImported()
     */
    public function testIsAlreadyImported()
    {
        $this->assertTrue($this->isAlreadyImported(3) > 0);
        $this->assertFalse($this->isAlreadyImported(1) > 0);
    }
}