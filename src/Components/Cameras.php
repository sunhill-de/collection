<?php

namespace Sunhill\Collection\Components;

use Illuminate\View\Component;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\Visual\Facades\Dialogs;
use Sunhill\ORM\Facades\InfoMarket;
use Sunhill\Collection\Objects\Dates\Date;

class Cameras extends Component
{
    
    /**
     * The width of the image
     * @var integer
     */
    protected $width = 350;
    
    /**
     * The height of the image 
     * @var integer
     */
    protected $height = 296;
    
    /**
     * The ID of the monitor to display (0 meand all monitors)
     * @var integer
     */
    protected $monitor_id = 0;
    
    /**
     * The wanted display quality
     * @var string
     */
    protected $quality = 'low';
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $width, int $height, int $monitor = 0, string $quality = 'low')
    {
        $this->width      = $width;
        $this->height     = $height;
        $this->monitor_id = $monitor;
        $this->quality    = $quality;
    }
    
    /**
     * Fetches the url-template for retrieving the live stream for the given monitor
     * 
     * There are two environment variables:
     * VIDEO_HOST = The host (and perhaps port) of the video host. 
     * VIDEO_SOURCE = A url template that is parsed for the final url. When using a zoneminder host
     *                this environment variable doesn't need to be changed
     * @param int $monitor_id
     * @return unknown
     */
    protected function getMonitorUrl(int $monitor_id)
    {
        return str_replace(
            ['%monitor_host%','%monitor_id%'],
            [env('VIDEO_HOST'),$monitor_id],
            env('VIDEO_SOURCE','%monitor_host%/cgi-bin/nph-zms?scale=0&mode=jpeg&maxfps=30&monitor=%monitor_id%')
        );
    }
    
    /**
     * Creates the cameras array for the blade template
     * @return \StdClass[]
     */
    protected function getCamerasEntries()
    {
        $result = [];
        
        foreach (\Sunhill\Collection\Facades\Cameras::getCameras($this->quality) as $monitor) {
            $entry = new \StdClass();
            $entry->url = $this->getMonitorUrl($monitor->id);
            $entry->title = $monitor->title;
            $result[] = $entry;
        }
        
        return $result;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->monitor_id) {
            return view('collection::information.cameras', [
                'url'=>$this->getMonitorUrl($this->monitor_id),
                'height'=>$this->height,
                'width'=>$this->width,
                'monitor'=>$this->monitor_id,
                'quality'=>$this->quality,
            ]);            
        } else {
            return view('collection::information.cameras', [
                'cameras'=>$this->getCamerasEntries(),
                'height'=>$this->height,
                'width'=>$this->width,
                'monitor'=>$this->monitor_id,
                'quality'=>$this->quality,
            ]);
        }
    }
}
