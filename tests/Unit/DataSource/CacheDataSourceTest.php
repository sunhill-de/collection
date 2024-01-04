<?php

namespace Sunhill\Collection\Tests\Unit\DataSource;

use Sunhill\Collection\Marketeers\DataSource\CacheDataSource;
use Sunhill\Collection\Tests\DatabaseTestCase;
use Illuminate\Support\Facades\DB;
use Sunhill\Collection\Marketeers\DataSource\Exceptions\UnknownCacheItemException;

/**
 * GetProperties test case.
 */
class CacheDataSourceTest extends DatabaseTestCase
{

    public function testGetData()
    {
        DB::table('cache_items')->truncate();
        DB::table('cache_items')->insert(['id'=>1,'name'=>'test']);
        DB::table('cache_entries')->truncate();
        DB::table('cache_entries')->insert(['item'=>1,'entry'=>'This is a test']);
        
        $test = new CacheDataSource();
        $test->setCacheName('test');
        
        $this->assertEquals('This is a test', $test->getData());
    }
    
    public function testUnkownItem()
    {
        $this->expectException(UnknownCacheItemException::class);
        
        $test = new CacheDataSource();
        $test->setCacheName('not_existing_item');
        
        $test->getData();
    }
}

