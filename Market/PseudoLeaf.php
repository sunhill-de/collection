<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

/**
 * A pseudo leaf is a element that appears to be a leaf (it has a final destination in a marketeer) but
 * is able to process further routing informations. Examples for pseudo leafs are arrays or objects. For 
 * sake of simplicity, pseudo leafs have to process further informations (otherwise they are items).
 * Example:
 * In a marketeer there is a leaf with the destination "this.is.a.test". Via the market comes the request 
 * for "this.a.a.test.for.a.pseduo.leaf". This is routet to this leaf with the remaining "for.a.pseudo.leaf"
 * informations. These a passed to the pseudo leaf and are further processed by them (or not, if the pseudo 
 * leaf can't process them) 
 * @author klaus
 */
abstract class PseudoLeaf extends Leaf
{

}