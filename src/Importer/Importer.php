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
abstract class Importer extends Loggable
{
    
    /**
     * The file to import
     * @var string
     */
    protected $import_file = '';

    /**
     * The sourcefile is build of lines with different datasets, so
     * to process this files just load it linewise and process it linewise
     * afterwards
     * 
     * @var boolean
     */
    protected $process_linewise = true;
    
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
     * For import files that are processed linewise, this method has to be overwritten
     * @param string $line
     */
    protected function processLine(string $line)
    {
        
    }
    
    protected function processData($data)
    {
        if ($this->process_linewise) {
            foreach ($data as $line) {
                $this->processLine($line);
            }
        }
        return true;
    }
    
    abstract protected function getData();
    
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