<?php

namespace Sunhill\Collection\Tests\Unit\Importer;

use Sunhill\Collection\Importer\Importer;
use Sunhill\Collection\Tests\DatabaseTestCase;

class ImporterTest extends DatabaseTestCase
{
    
    /**
     * Tests: /src/Importer/Importer->processCSVHeader()
     */
    public function testProcessCSVHeader()
    {
        $test = new Importer();
        
        $result = $this->callProtectedMethod($test, 'processCSVHeader',[['A','B','','','D']]);
        
        $this->assertEquals('A', $result[0]);
        $this->assertEquals('B_1',$result[2]);
        $this->assertEquals('B_1_1',$result[3]);
        $this->assertEquals('D',$result[4]);
    }
    
    /**
     * Tests: /src/Importer/Importer->runCSVImporter()
     */
    public function testCSVImport()
    {
        $test = new Importer();
        $test->setImportFile(realpath(__DIR__.'/../../files/csvtest.csv'));
        
        $data = $this->callProtectedMethod($test, 'runCSVImporter');
        
        $this->assertEquals('AAA', $data[0]['Column 1']);
        $this->assertEquals('FGH', $data[1]['Skipped Column']);
        $this->assertEquals('GGG', $data[0]['Skipped Column_1']);
    }
}