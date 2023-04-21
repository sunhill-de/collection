<?php

/**
 * Baseclass for importers that handle csv files
 * @file CSVImporter.php
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

/**
 * Baseclass for importers. Provides some basic functionallity for importing data from files
 * @author klaus
 *
 */
class CSVImporter extends Importer
{

    protected $expected_seperator = ";";
    
    /**
     * For the case that the source file doesn't define a header this can be done here
     * @param array $data
     * @return array
     */
    protected function prefixCSVHeader(array $data): array
    {
        return $data;
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
    
    protected function handleColumnMismatch(array $header, array $data)
    {
        throw new \Exception("Column count of header row and data row does not match.");    
    }
    
    /**
     * Imports a csv file linewise, correctes the header and combines every data row
     * with the header. It returns an associative array
     *
     * @return array
     *
     * Test: tests/Unit/Importer/ImporterTest->testRunCSVImporter()
     */
    protected function getData()
    {
        $csv = array_map(function($row) {
            return str_getcsv($row, $this->expected_seperator);
        }, file($this->import_file));
        
        $csv = $this->prefixCSVHeader($csv);
        $csv[0] = $this->processCSVHeader($csv[0]);

        array_walk($csv, function(&$a) use ($csv) {
                if (count($a) == count($csv[0])) {
                    $a = array_combine($csv[0], $a);
                } else {
                    $a = $this->handleColumnMismatch($csv[0], $a);
                }
        
        });
        
        array_shift($csv); # remove column header
        return $csv;
    }
        
}