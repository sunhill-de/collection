<?php

/**
 * An importer for the Netflix data collection
 * @file NetflixImporter.php
 * Explaination
 * @author Klaus Dimde
 * Lang en
 * Reviewstatus: 04.03.2023
 * Localization: none
 * Documentation: unknown
 * Tests: /Unit/Importer/NetflixImporterTest
 * Coverage: unknown
 * PSR-State: incompleted
 * Dependencies: none
 */
namespace Sunhill\Collection\Importer;

/**
 * Parses the netflix ViewingActivity sheet. Netflix also stores autoviews and trailers, so
 * there is a constant called DURATION_CUTOFF that only processes movies and episodes that
 * are longer than that.
 * @author klaus
 *
 */
class NetflixImporter extends Importer
{
    
    use MovieUtils, EventUtils;
    
    const DURATION_CUTOFF = 120;
    
    protected $expected_seperator = ",";
    
    protected $import_type = self::IMPORT_CSV;
    
    protected $indicators = [
        'de'=>['season'=>'Staffel','miniseries'=>'Miniserie','release'=>'Ausgabe']
    ];
    
    protected $lang = 'de';
    
    protected function getRegEx()
    {
        $indicators = $this->indicators[$this->lang]['season'].' |'.$this->indicators[$this->lang]['miniseries'].'|'.$this->indicators[$this->lang]['release'].' ';
        return "/(.*)\: ($indicators)([0-9]*)\:(.*)\((.*) ([0-9]+)\)/mU";
    }
    
    protected function processSeries($row)
    {
        $result = [];
        preg_match($this->getRegEx(),$row['Title'],$result);
        
        $series = trim($result[1]);
        $season = empty($result[3])?0:$result[3];
        $episode = $result[6];
        $title = trim($result[4]);
        
        $series_id = $this->searchOrInsertSeries($series);
        $episode_id = $this->searchOrInsertEpisode($title, $series_id, $season, $episode, 'netflix', $row['Start Time']);
        
        
    }
    
    /**
     * Processes one row in the data sheet. Explaination of the data see above
     * @param unknown $row
     */
    protected function processRow($row)
    {
        if (preg_match($this->getRegEx(),$row['Title'])) {
            return $this->processSeries($row);
        }
        $movie = $this->searchOrInsertInImports($row['Title'], 'netflix', $row['Start Time']);
    }
    
    protected function calculateDuration($time): int
    {
        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $time);
        
        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
        
        return $hours * 3600 + $minutes * 60 + $seconds;
    }
    
    protected function processData($data)
    {
        foreach ($data as $row) {
            if ($this->calculateDuration($row['Duration']) > self::DURATION_CUTOFF) {
                $this->processRow($row);
            }
        }
        return true;
    }
    
    public static function autodetect(string $content): bool
    {
        return strpos($content,'Profile Name,Start Time,Duration') !== false;
    }
    
}