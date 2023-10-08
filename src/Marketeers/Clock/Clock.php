<?php
/**
 * @file Clock.php
 * Provides information about date and time
 * Lang en
 * Reviewstatus: 2023-10-08
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\Collection\Marketeers\Clock;

use Sunhill\ORM\InfoMarket\Marketeer;

class Clock extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'clock.time'=>Clock::class.'@time',
            'clock.unix'=>Clock::class.'@unix',
            'clock.hour'=>Clock::class.'@hour',
            'clock.minute'=>Clock::class.'@minute',
            'clock.second'=>Clock::class.'@second',
            'clock.date'=>Clock::class.'@date',
            'clock.db_date'=>Clock::class.'@db_date',
            'clock.year'=>Clock::class.'@year',
            'clock.month'=>Clock::class.'@month',
            'clock.month_name'=>Clock::class.'@month_name',
            'clock.day'=>Clock::class.'@day',
            'clock.day_of_year'=>Clock::class.'@day_of_year',            
        ];
    }
    
    public static function time()
    {
        
    }
    
    public static function unix()
    {
        
    }
    
    public static function hour()
    {
        
    }
    
    public static function minute()
    {
        
    }
    
    public static function second()
    {
        
    }
    
    public static function date()
    {
        
    }
    
    public static function year()
    {
        
    }
    
    public static function month()
    {
        
    }
    
    public static function month_name()
    {
        
    }
    
    public static function day()
    {
        
    }
    
    public static function day_of_year()
    {
        
    }
}
