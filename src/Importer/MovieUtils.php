<?php

namespace Sunhill\Collection\Importer;

use Illuminate\Support\Facades\DB;

trait MovieUtils
{
    
    protected function getImportTarget()
    {
        return 'movies';    
    }
    
    /**
     * Searches the movie with the title $name in the import table. $source and $key have
     * to match too. The import table doesn't care if any other source has imported the 
     * same movie again (duplicates are handled later in the transfer from import into the
     * orm system)
     * 
     * @param string $name
     * @param string $source
     * @param string $key
     * @return unknown|boolean
     * 
     * Test: 
     * - tests/Unit/Imports/MovieUtilsTest->testSearchMovieInImports_pass()
     * - tests/Unit/Imports/MovieUtilsTest->testSearchMovieInImports_fail()
     * - tests/Unit/Imports/MovieUtilsTest->testSearchMovieInImports_differentkey()
     */
    protected function searchMovieInImports(string $name, string $source, string $key)
    {
        if ($query = DB::table('import_movies')->where('title',$name)->where('source',$source)->where('source_id',$key)->first()) {
            return $query->id;
        }
        return false;
    }

    /**
     * Inserts the given movie into the import table
     * 
     * @param string $name
     * @param string $source
     * @param string $key
     *
     * Test: tests/Unit/Importer/MovieUtilsTest->testInsertInImports()
     */
    protected function insertInImports(string $name, string $source, string $key)
    {
        DB::table('import_movies')->insert(['title'=>$name,'source'=>$source,'source_id'=>$key]);
        return DB::getPdo()->lastInsertId();        
    }
    
    /**
     * Searches the given movie in the import table. If found returns its ID otherwise
     * inserts into import table and returns the newly created id
     * 
     * @param string $name
     * @param string $source
     * @param string $key
     * @return \Sunhill\Collection\Importer\unknown|boolean|unknown
     * 
     * Test: tests/Unit/Importer/MovieUtilsTest->testSearchOrInsertInImports()
     */
    protected function searchOrInsertInImports(string $name, string $source, string $key)
    {
        if ($id = $this->searchMovieInImports($name, $source, $key)) {
            return $id;
        }
        return $this->insertInImports($name, $source, $key);
    }
    
    /**
     * Checks if the import entry with the given $id was already imported
     * 
     * @param int $id
     * @return unknown
     * 
     * Test: tests/Unit/Importer/MovieUtilsTest->testIsAlreadyImported()
     */
    protected function isAlreadyImported(int $id)
    {
        $query = DB::table('import_movies')->where('id',$id)->first();
        return $query->object_id;
    }
    
}