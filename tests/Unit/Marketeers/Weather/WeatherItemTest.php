<?php

use Sunhill\Collection\Tests\CollectionTestCase;
use Sunhill\Collection\Marketeers\Weather\WeatherItem;

class WeatherItemTest extends CollectionTestCase
{

    public function testDailyWeather()
    {
        $item = new WeatherItem('test');
        
        $data = $item->getDailyData(file_get_contents(dirname(__FILE__).'/../../../files/weather_daily'));

        $this->assertEquals(40.8, $data->wind_gusts_24);
        $this->assertEquals(11.1, $data->temp_max_24);
        $this->assertEquals(5.1,  $data->temp_min_24);
        $this->assertEquals(12.46,$data->precip_24);
        $this->assertEquals(8    ,$data->symbol_24);
        $this->assertEquals("2024-01-02T07:34:00Z", $data->sunrise);
        $this->assertEquals("2024-01-02T15:23:00Z", $data->sunset);
    }

    public function testMinutelyWeather()
    {
        $item = new WeatherItem('test');
        
        $data = $item->getMinutelyData(file_get_contents(dirname(__FILE__).'/../../../files/weather_minutely'));
        
        $this->assertEquals(27.1, $data->wind_speed_now);
        $this->assertEquals(30.4, $data->wind_speed_1hour);
        $this->assertEquals(26.2, $data->wind_speed_12hour);
        $this->assertEquals(17.8, $data->wind_speed_24hour);
        $this->assertEquals(15.5, $data->wind_speed_48hour);

        $this->assertEquals(0, $data->precip_now);
        $this->assertEquals(0, $data->precip_1hour);
        $this->assertEquals(0.12, $data->precip_12hour);
        $this->assertEquals(0, $data->precip_24hour);
        $this->assertEquals(0, $data->precip_48hour);

        $this->assertEquals(985, $data->pressure_now);
        $this->assertEquals(985, $data->pressure_1hour);
        $this->assertEquals(988, $data->pressure_12hour);
        $this->assertEquals(1001, $data->pressure_24hour);
        $this->assertEquals(1016, $data->pressure_48hour);

        $this->assertEquals(104, $data->symbol_now);
        $this->assertEquals(104, $data->symbol_1hour);
        $this->assertEquals(5, $data->symbol_12hour);
        $this->assertEquals(4, $data->symbol_24hour);
        $this->assertEquals(4, $data->symbol_48hour);
        
        $this->assertEquals(10.4, $data->temp_now);
        $this->assertEquals(10.6, $data->temp_1hour);
        $this->assertEquals(8.7, $data->temp_12hour);
        $this->assertEquals(4.3, $data->temp_24hour);
        $this->assertEquals(-0.9, $data->temp_48hour);
        
        $this->assertEquals(0, $data->uv_now);
        $this->assertEquals(0, $data->uv_1hour);
        $this->assertEquals(0, $data->uv_12hour);
        $this->assertEquals(0, $data->uv_24hour);
        $this->assertEquals(0, $data->uv_48hour);
     
        $this->assertEquals(222.3, $data->wind_dir_now);
        $this->assertEquals(231.9, $data->wind_dir_1hour);
        $this->assertEquals(235.6, $data->wind_dir_12hour);
        $this->assertEquals(292, $data->wind_dir_24hour);
        $this->assertEquals(60.6, $data->wind_dir_48hour);
        
        $this->assertEquals(13.9, $data->wind_gusts_now);
        $this->assertEquals(15.7, $data->wind_gusts_1hour);
        $this->assertEquals(20.4, $data->wind_gusts_12hour);
        $this->assertEquals(13.1, $data->wind_gusts_24hour);
        $this->assertEquals(10.4, $data->wind_gusts_48hour);
        
    }
    
    
}