<?php

namespace Sunhill\Collection\Marketeers\Weather;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\SimpleArrayItem;
use Sunhill\Collection\Marketeers\DataSource\CacheDataSource;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;

class OpenWeatherMapForecastMarketeer extends OnDemandMarketeer
{
    protected $data;
    
    const time_slices = 
    ['1hour','3hour','6hour','9hour','12hour','15hour','18hour','21hour','24hour',
     '27hour','30hour','33hour','36hour','39hour','42hour','45hour','48hour',
     '51hour','54hour','57hour','60hour','63hour','66hour','69hour','72hour',
     '75hour','78hour','81hour','84hour','87hour','90hour','93hour','96hour',
     '99hour','102hour','105hour','108hour','111hour','114hour','117hour'
    ];
    
    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }
    
    protected function initializeMarketeer()
    {
        $this->addEntry('update_time', (new DynamicItem())->defineValue($this->data->lastUpdate->format('Y-m-d H:i:s'))->type('datetime')->semantic('Pointintime'));
        $i=0;
        foreach ($this->data as $forecast) {            
            $this->addEntry(static::time_slices[$i++], new OpenWeatherMapItem($forecast));
        }
    }    
    
}
