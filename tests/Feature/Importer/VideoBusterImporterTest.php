<?php

namespace Sunhill\Collection\Tests\Feature\Importer;

use Sunhill\Collection\Importer\VideoBusterImporter;
use Sunhill\Collection\Tests\DatabaseTestCase;

class VideoBusterImporterTest extends DatabaseTestCase
{

    public function testImporter()
    {
        $test = new VideoBusterImporter();
        $test->setImportFile(realpath(__DIR__.'/../../files/videobuster.csv'));
        $test->run();
        
        $this->assertDatabaseHas('import_movies',['title'=>'8. Wonderland']);
        $this->assertDatabaseHas('import_movies',['title'=>'Tetsuo']);
    }
    
}