<?php

namespace Sunhill\Collection\Response\Database\Classes;

use Sunhill\Visual\Response\SunhillListResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\SunhillSiteManager;
use Sunhill\Visual\Response\ListDescriptor;

class ListClassesResponse extends SunhillListResponse
{
    
    protected $template = 'collection::classes.list';
    
    protected function defineList(ListDescriptor &$descriptor)
    {
            
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(string $filter = '')
    {
        return Classes::getClassCount();        
    }
    
    protected function prepareHeaders(): array 
    {
        $this->params['headers'] = [
            $this->getStdClass(['name'=>__('Class name'),'link'=>null]),
            $this->getStdClass(['name'=>__('Name'),'link'=>null]),
            $this->getStdClass(['name'=>__('Description'),'link'=>null]),
            $this->getStdClass(['name'=>__('Parent'),'link'=>null]),
            $this->getStdClass(['name'=>"",'link'=>null]),
            $this->getStdClass(['name'=>"",'link'=>null]),
            $this->getStdClass(['name'=>"",'link'=>null]),
        ];
        return $this->params['headers'];
    }
    
    protected function prepareList($key,$order,$delta,$limit)
    {
        return $this->sliceList(Classes::getAllClasses(),$delta);
    }

    protected function getPrefix()
    {
        return SunhillSiteManager::getPrefix();    
    }
    
    protected function prepareMatrix($input): array
    {
        $result = [];        
        foreach ($input as $name => $description)
        {
            if ($description['name'] == 'object') {
                $description['name'] = 'ORMObject'; // @todo: Dirty hack to remove error in list objects
            }
            $row = [];
            $row[] = $this->getStdClass(['name'=>$description['class'],'link'=>null]);
            $row[] = $this->getStdClass(['name'=>$description['name'],'link'=>null]);
            $row[] = $this->getStdClass(['name'=>(isset($description['description'])?$description['description']:""),'link'=>null]);
            $row[] = $this->getStdClass(['name'=>$description['parent'],'link'=>null]);
            $row[] = $this->getStdClass(['name'=>__('list'),'link'=>route('objects.list',['key'=>$description['name']])]);
            $classname = $description['class'];
            if ($classname::getInfo('instantiable', false)) {
                $row[] = $this->getStdClass(['name'=>__('add'),'link'=>route('objects.add',['class'=>$description['name']])]);
            } else {
                $row[] = $this->getStdClass(['name'=>__('add'),'link'=>null]);                
            }
            $row[] = $this->getStdClass(['name'=>__('show'),'link'=>route('classes.show',['class'=>$description['name']])]);
            $result[] = $row;
        }
        return $result;        
    }
    
    protected function getTotalEntryCount()
    {
        return Classes::getClassCount();
    }
    
    
    protected function getPaginatorLink(int $index)
    {
        return route('classes.list',['page'=>$index]); 
    }
    
}  
