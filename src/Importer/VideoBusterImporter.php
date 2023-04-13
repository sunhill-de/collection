<?php

/**
 * An importer for the VideoBuster data collection
 * @file NetflixImporter.php
 * Explaination
 * @author Klaus Dimde
 * Lang en
 * Reviewstatus: 04.03.2023
 * Localization: none
 * Documentation: unknown
 * Tests: /Unit/Importer/VideoBusterImporterTest
 * Coverage: unknown
 * PSR-State: incompleted
 * Dependencies: none
 */
namespace Sunhill\Collection\Importer;

use Illuminate\Support\Facades\DB;

class VideoBusterImporter extends Importer
{
    
    use MovieUtils;
    
    protected $import_type = self::IMPORT_CSV;
    
    protected function processRow($row)
    {
        $movie1 = $this->searchOrInsert($row['Film1'],$row['Ausgang']);
        $movie2 = $this->searchOrInsert($row['Film2'],$row['Ausgang']);
    }
    
    protected function processData($data)
    {
        foreach ($data as $row) {
            $this->processRow($row);
        }
    }
    
}