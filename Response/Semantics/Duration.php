<?php
/**
 * @file Duration.php
 * Provides the semantic duration that stands to the amount of time a process has consumes (e.g. running time)
 * Lang en
 * Reviewstatus: 2022-11-08
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Semantics;

class Duration extends Semantic
{
    public function __construct()
    {
        $this->setName('Duration');
    }

    /**
     * Normally all entries of this semantic have the same type, so define it here
     * @return string The name of the type
     */
    public function getDefaultType(): string
    {
        return 'Integer';
    }
    
    /**
     * With this method it is possible to define a conversion to display a raw value in a human readable one
     * @return string: The human readable representation of value
     */
    public function processHumanReadableValue($timespan, string $human_readable_unit = ''): string
    {
        $seconds = $timespan%60;
        $timespan = intdiv($timespan,60);
        $minutes = $timespan%60;
        $timespan = intdiv($timespan,60);
        $hours = $timespan%24;
        $timespan = intdiv($timespan,24);
        $days = $timespan%365;
        $years = intdiv($timespan,365);
        if ($years > 0) {
            return $years.' '.(($years == 1)?$this->translate('year'):$this->translate('years')).
            ' '.$this->translate('and').' '.$days.' '.(($days == 1)?$this->translate('day'):$this->translate('days'));
        } elseif ($days > 0) {
            return $days.' '.(($days == 1)?$this->translate('day'):$this->translate('days')).
            ' '.$this->translate('and').' '.$hours.' '.(($hours == 1)?$this->translate('hour'):$this->translate('hours'));
        } elseif ($hours > 0) {
            return $hours.' '.(($hours == 1)?$this->translate('hour'):$this->translate('hours')).
            ' '.$this->translate('and').' '.$minutes.' '.(($minutes == 1)?$this->translate('minute'):$this->translate('minutes'));
        } elseif ($minutes > 0) {
            return $minutes.' '.(($minutes == 1)?$this->translate('minute'):$this->translate('minutes')).
            ' '.$this->translate('and').' '.$seconds.' '.(($seconds == 1)?$this->translate('second'):$this->translate('seconds'));
        } else {
            return $seconds.' '.(($seconds == 1)?$this->translate('second'):$this->translate('seconds'));
        }
    }
    
}
