<?php

/**
 * An importer for the MyMovies Mobile app
 * @file MyMoviesImporter.php
 * Explaination
 * @author Klaus Dimde
 * Lang en
 * Reviewstatus: 04.03.2023
 * Localization: none
 * Documentation: unknown
 * Tests: /Unit/Importer/MyMoviesImporterTest
 * Coverage: unknown
 * PSR-State: incompleted
 * Dependencies: none
 */
namespace Sunhill\Collection\Importer;

class MyMoviesImporter extends CSVImporter
{
 
    use MovieUtils, PropertyUtils;
    
    protected $expected_seperator = ",";
    
    protected function prefixCSVHeader(array $data): array
    {
        array_unshift($data,['id','Disc title','Title','EAN','Medium','Year','Imdb-id','Length','Director','Actors','Dummy']);
        return $data;
    }
    
    protected function processLine($row)
    {
        $movie_id = $this->searchOrInsertInImports($row['Title'], 'mymovies', $row['id'], $row['Imdb-id']);
        $property_id = $this->searchOrInsertProperty('import_movies',$movie_id,$row['Title'],$row['EAN'],$row['Medium']);
    }
    
}