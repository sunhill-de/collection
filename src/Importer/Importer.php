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
    
    protected function runCSVImporter(): bool
    {
        $csv = array_map('str_getcsv', file($this->import_file));
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv); # remove column header
        return $this->processData($csv);
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

    public function run(): bool
    {
        if (!file_exists($this->import_file)) {
            throw new \Exception("The file '".$this->import_file."' was not found.");
        }
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
}