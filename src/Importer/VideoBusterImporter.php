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

/**
 * Videobuster is a dvd and blu ray rental service that sends movies per mail to the customer. 
 * In one envelop are typically two movie mediums. 
 * 
 * The data of videobuster is quite simple:
 * Columns 1-2 deal with payment and is ignored
 * Column 3 ("Ausgang") means the date the movies where sent out
 * Column 4 ("Eingang") means the date the movies came back
 * Column 5 ("Zahlungsdatum") means the date the rental was paid
 * Column 6+7 are the first movie
 * Column 8+9 are the second movie
 * Column 7+9 are unnamed and mean the kind of video (dvd or bluray)
 * Dolumn 6+8 (Film1 and Film2) are the title of the rented movie
 * 
 * So the column we need are "Ausgang", "Film1" and "Film2" 
 * @author klaus
 *
 */
class VideoBusterImporter extends Importer
{
    
    use MovieUtils, EventUtils;
    
    protected $import_type = self::IMPORT_CSV;
    
    public function processMovie(string $name, string $date)
    {
        $movie = $this->searchOrInsertInImports($name,'videobuster',$date);
        $this->searchOrInsertEvent('import_movies',$movie,'watch',$this->getDate($date));        
    }
    
    /**
     * Processes one row in the data sheet. Explaination of the data see above
     * @param unknown $row
     */
    protected function processRow($row)
    {
        $this->processMovie($row['Film1'],$row['Ausgang']);
        $this->processMovie($row['Film2'],$row['Ausgang']);
    }
    
    protected function processData($data)
    {
        foreach ($data as $row) {
            $this->processRow($row);
        }
        return true;
    }
    
    public static function autodetect(string $content): bool
    {
        return strpos($content,'"Status";"Euro";"Ausgang"') !== false;
    }
    
}