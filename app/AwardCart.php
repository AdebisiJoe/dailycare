<?php
/**
 * Created by PhpStorm.
 * User:  12
 * Date: 9/5/2017
 * Time: 8:26 AM
 */

namespace App;


class AwardCart
{
    Public $items=null;


    public function __construct($oldCart)
    {
        if($oldCart)
        {
            $this->items=$oldCart->items;

        }
    }

    public function add($item,$product,$id)
    {
        $storedItem = ['qty' => $item->quantity, 'price' => $item->price, 'item' => $item, 'product' => $product];
        if ($this->items) {
            # code...
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        $this->items[$id]=$storedItem;
    }

}