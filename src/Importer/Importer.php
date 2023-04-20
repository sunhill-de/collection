<?php

/**
 * Baseclass for importer
 * @file Importer.php
 * Explaination
 * @author Klaus Dimde
 * Lang en
 * Reviewstatus: 04.03.2023
 * Localization: none
 * Documentation: unknown
 * Tests: Unit/Importer/ImporterTest
 * Coverage: unknown
 * PSR-State: incompleted
 * Dependencies: none
 */
namespace Sunhill\Collection\Importer;

use Sunhill\Basic\Loggable;

/**
 * Baseclass for importers. Provides some basic functionallity for importing data from files
 * @author klaus
 *
 */
class Importer extends Loggable
{
    const IMPORT_LINE = 1; /* The file should be processed linewise */
    const IMPORT_JSON = 2; /* The file is a json file */
    const IMPORT_XML  = 3; /* The file is a xml file */
    const IMPORT_CSV  = 4; /* The file is a csv file */
    const IMPORT_EXEC = 5; /* The source is the result of a command execution */
    const IMPORT_HTML = 6; /* The source is a website (full html code) */
    const IMPORT_WEB  = 7; /* The source is a website (only rendered text) */
    
    /**
     * Should the run() command actually do something or just simulate it
     * @var boolean
     */
    protected $dry_run = false;

    /**
     * The file to import
     * @var string
     */
    protected $import_file = '';
    
    /**
     * What kind of import are we expecting
     * @var unknown
     */
    protected $import_type = self::IMPORT_LINE;
    
    protected $expected_seperator = ";";
    
    /**
     * Setter for dry_run
     * @param bool $on
     * @return \Sunhill\Collection\Importer\Importer
     */
    public function setDryRun(bool $on=true)
    {
        $this->dry_run = $on;
        return $this;
    }
    
    /**
     * Getter for dry_run
     * @return bool
     */
    public function getDryRun(): bool
    {
        return $this->dry_run;
    }
    
    /**
     * Setter for import_file
     * @param string $file
     * @return \Sunhill\Collection\Importer\Importer
     */
    public function setImportFile(string $file)
    {
        $this->import_file = $file;
        return $this;
    }
    
    /**
     * Getter for import_file
     * @return string
     */
    public function getImportFile(): string
    {
        return $this->import_file;
    }

    /**
     * A dry query builder that just displays the query that would have been executed
     * @param string $table
     * @param array $fields
     */
    protected function dryInsert(string $table, array $fields)
    {
        $str = "insert into '$table' ( ";
        $first = true;
        foreach ($fields as $name => $value) {
            $str .= ($first?"":",").$name." ";
            $first = false;
        }
        $str .= ") values ( ";
        $first = true;
        foreach ($fields as $name => $value) {
            $str .= ($first?"":",")."'$value' ";
            $first = false;
        }
        $str .= ")";
        $this->info($str);
    }
    
    /**
     * Really inserts the given fields into the table '$table'
     * @param string $table
     * @param array $fields
     */
    protected function realInsert(string $table, array $fields)
    {
        DB::table($table)->insert($fields);
        return DB::getPdo()->lastInsertId();
    }
    
    /**
     * Wrapper for database insert queries that respect thd dry run field
     * @param string $table
     * @param array $fields
     */
    protected function insertIntoTable(string $table, array $fields)
    {
        if ($this->dry_run) {
            $this->dryInsert($table,$fields);
            return 0;
        } else {
            return $this->realInsert($table,$fields);
        }
    }
    
    /**
     * For import files that are processed linewise, this method has to be overwritten
     * @param string $line
     */
    protected function processLine(string $line)
    {
        
    }
    
    protected function processData($data)
    {
        
    }
    
    protected function runLineImporter(): bool
    {
        $lines = file($this->import_file);
        foreach ($lines as $line) {
            $this->processLine($line);
        }
        return true;
    }
    
    protected function runJSONImporter(): bool
    {
        $result = json_decode(file($this->import_file), true);
        if (is_null($result)) {
            return false;
        } 
        return $this->processData($result);        
    }
    
    protected function runXMLImporter(): bool
    {
        $result = json_decode(json_encode(simplexml_load_string(file($this->import_file))), true);
        if (is_null($result)) {
            return false;
        }
        return $this->processData($result);        
    }
    
    /**
     * In some CSV files the header row has some skipped columns. The later algorithm would
     * cause an unexpected overwrite of columnnames, so make every column in the header unique 
     * by exchanging empty column names with the previous column with an extra _1.
     * Note: When there are two empty columns the name would be something_1_1
     * 
     * @param array $header_row
     * @return array
     * 
     * Test: tests/Unit/Importer/ImporterTest->testProcessCVSHeader
     */
    protected function processCSVHeader(array $header_row): array
    {
        for ($i=1;$i<count($header_row);$i++) {
            if (empty($header_row[$i])) {
                $header_row[$i] = $header_row[$i-1]."_1";
            }
        }
        return $header_row;
    }
    
    /**
     * Imports a csv file linewise, correctes the header and combines every data row 
     * with the header. It returns an associative array 
     * 
     * @return array
     * 
     * Test: tests/Unit/Importer/ImporterTest->testRunCSVImporter()
     */
    protected function runCSVImporter()
    {
        $csv = array_map(function($row) {
            return str_getcsv($row, $this->expected_seperator);
        }, file($this->import_file));
        $csv[0] = $this->processCSVHeader($csv[0]);
        array_walk($csv, function(&$a) use ($csv) {
            if (count($a) == count($csv[0])) {
               $a = array_combine($csv[0], $a);
            } else {
                
            }
        });
        array_shift($csv); # remove column header
        return $csv;
    }
    
    protected function runExecImporter(): bool
    {
        
    }
    
    /**
     * Returns the command to execute for the IMPORT_EXEC importer
     * @return string
     */
    protected function getExecCommand(): string
    {
        return '';    
    }
    
    protected function runHTMLImporter(): bool
    {
        
    }
    
    protected function runWebImporter(): bool
    {
        
    }
    
    /**
     * Returns the website to load for the IMPORT_HTML and IMPORT_WEB importers
     * @return string
     */
    protected function getSite(): string
    {
        return '';
    }

    protected function getData()
    {
        switch ($this->import_type) {
            case self::IMPORT_LINE: return $this->runLineImporter();
            case self::IMPORT_JSON: return $this->runJSONImporter();
            case self::IMPORT_XML: return $this->runXMLImporter();
            case self::IMPORT_CSV: return $this->runCSVImporter();
            case self::IMPORT_EXEC: return $this->runExecImporter();
            case self::IMPORT_HTML: return $this->runHTMLImporter();
            case self::IMPORT_WEB: return $this->runWebImporter();
            default:
                throw new \Exception("Unknown import type");
        }        
    }
    
    
    public function run(): bool
    {
        if (!file_exists($this->import_file)) {
            throw new \Exception("The file '".$this->import_file."' was not found.");
        }
        if (!$data = $this->getData()) {
            return false;   
        }
        return $this->processData($data);
    }
    
    public static function autodetect(string $content): bool
    {
        return false;
    }
}