<?php

namespace Sunhill\Collection\Managers;

class CamerasManager
{

    protected function getCamera($id, $name)
    {
        $result = new \StdClass();
        
        $result->id    = $id;
        $result->title = $name;
        
        return $result;
    }
    
    public function getCameras(string $quality)
    {
        return [
            $this->getCamera(1, 'Haustür'),
            $this->getCamera(2, 'Kämmerchen'),
            $this->getCamera(4, 'Carport'),
            $this->getCamera(3, 'Hasenstall')
        ];
    }
    
}
