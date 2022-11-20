<?php

namespace Sunhill\InfoMarket\Market;

class AliasItem extends Leaf
{
    /**
     * The target item this alias points to
     * @var string
     */
    protected $target =""; 
    
    /**
     * This contructor needs the target item. AliasItems should only be contructed by Market::addAlias()
     * @param string $target
     * @throws InfoMarketException
     */
    public function __construct(string $target)
    {
        if (empty($target)) {
            throw new InfoMarketException(__("The target mustn't be empty"));
        }
        $this->target = $target;
    }
}