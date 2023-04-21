<?php

/**
 * An importer for the Amazon data collection
 * @file AmazonVideoImporter.php
 * Explaination
 * @author Klaus Dimde
 * Lang en
 * Reviewstatus: 04.03.2023
 * Localization: none
 * Documentation: unknown
 * Tests: /Unit/Importer/AmazonVideoImporterTest
 * Coverage: unknown
 * PSR-State: incompleted
 * Dependencies: none
 */
namespace Sunhill\Collection\Importer;

class AmazonVideoImporter extends CSVImporter
{
    
    use MovieUtils, EventUtils;
    
    protected $expected_seperator = ",";
    /**
     * Amazons data doesn't set escape characters so a colon in the Title would create a new column
     * {@inheritDoc}
     * @see \Sunhill\Collection\Importer\Importer::handleColumnMismatch()
     */
    protected function handleColumnMismatch(array $header, array $data)
    {
        $partial = array_slice($data,count($header)-1);
        $data[count($header)-1] = implode(',', $partial);
        $data = array_slice($data,0,count($header));
        return array_combine($header, $data);
    }
    
    protected function getTimestamp(string $stamp)
    {
        $date = \DateTime::createFromFormat('d/m/Y G:i:s',$stamp);
        return $date->format('Y-m-d G:i:s');
    }
    
    protected function processLine($row)
    {
        $timestamp = $this->getTimestamp($row['﻿Playback Hour']);
        $title = trim($row['Title']);
        
        $movie_id = $this->searchOrInsertInImports($title, 'amazon', $timestamp);
        $event_id = $this->searchOrInsertEvent('import_movies', $movie_id, 'watch', $timestamp, 'unknown');
    }
        
    public static function autodetect(string $content): bool
    {
        return strpos($content,'Playback Hour,Operating System,Browser') !== false;
    }
    
}