<?php

namespace Sunhill\Collection\Marketeers\DataSource;

class WebDataSource extends DataSourceBase
{
    
    protected $url;
    
    public function setUrl(string $name)
    {
        $this->url = $name;
    }
 
    public function getData()
    {
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $this->url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl_handle);

        return $response;
    }
    
}