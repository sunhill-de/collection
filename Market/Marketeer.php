<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\Basic\Loggable;

abstract class Marketeer extends Loggable
{

    protected $market;
    
    /**
     * Derrived marketeers have to overwrite this method to return all avaiable items of this
     * marketeer.
     * @return array
     */
    abstract protected function getOffering(): array;
    
    public function getOffer()
    {
        return $this->getOffering();
    }
    
    /**
     * Setter for market
     * @param Market $market
     * @return \Sunhill\InfoMarket\Market\Marketeer
     */
    public function setMarket(Market $market)
    {
        $this->market = $market;
        return $this;
    }

    /**
     * Getter for market
     * @return unknown
     */
    public function getMarket()
    {
        return $this->market;
    }
}