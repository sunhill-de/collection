<?php

namespace Sunhill\Collection\Tests\Unit\Importer;

use Sunhill\Collection\Importer\VideoBusterImporter;
use Sunhill\Collection\Tests\DatabaseTestCase;

class VideoBusterImporterTest extends DatabaseTestCase
{

    public function testProcessMovie()
    {
        $test = new VideoBusterImporter();
        $this->callProtectedMethod($test, 'processMovie',['test','05.05.2023']);
        
        $this->assertDatabaseHas('import_movies',['title'=>'test']);
        $this->assertDatabaseHas('import_events',['event_type'=>'watch','date'=>'2023-05-05']);
    }
}