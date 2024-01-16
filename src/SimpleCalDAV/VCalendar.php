<?php

namespace Sunhill\Collection\SimpleCalDAV;

class VCalendar {
    
    /**
     * Retrieve VCALENDAR file from $url and return parsed JSON
     */
    public function toJSON($url) {
        return json_encode($this->toArray($url));
    }
    
    /**
     * Retrieve VCALENDAR file from $url and return parsed Array
     */
    public function toArray($data) {
        $results = array();
        
        $delim = "\n";
        $arr = explode($delim, $data);
        
        return $this->parse($arr);
    }
    
    /**
     * Recursively handle begin/end tags creating hierarchical array of vcalendar entries
     */
    private function parse( & $arr) {
        $vdata = array();
        $results = null;
        $isFinished = false;
        while (!$isFinished) {
            $idx = array_shift($arr);
            $name = strtok($idx, ':');
            $value = substr($idx, strlen($name) + 1);
            switch ($name) {
                case 'BEGIN':
                    $vdata[$value] = (!isset($vdata[$value])) ? array() : $vdata[$value];
                    array_push($vdata[$value], $this->parse($arr));
                    if (trim($value) == "VCALENDAR") {
                        $isFinished = true;
                        $results = $vdata;
                    }
                    break;
                case 'END':
                    $results = $vdata;
                    $isFinished = true;
                    break;
                default:
                    $name = strtolower($name);
                    if (isset($vdata[$name])) {
                        if (is_array($vdata[$name])) {
                            $vdata[$name][] = $value;
                        } else {
                            $vdata[$name] = [$vdata[$name], $value];
                        }
                    } else {
                        $vdata[strtolower($name)] = $value;
                    }
            }
        }
        
        return $results;
    }
}

?>