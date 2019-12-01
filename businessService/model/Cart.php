<?php
/**
 *
 * Cart.php
 * Description: This class is designed to hold to handle a users cart.
 * Author: Marc
 * Date Nov 30, 2019
 */
class Cart
{
    //properties
    private $userid;
    private $items;
    private $total;
    
    //constructor
    public function __construct($userid){
        $this->userid = $userid;
        $this->items = array();
        $this->total = 0.0;
        
    }
    
    //methods
    public function addItems($product, $quantity){
        $item = array('PRODUCT' => $product, 'QUANTITY' => $quantity, 'SUBTOTAL' => $quantity * $product->getPrice());
        
        if(array_key_exists($product->getId(), $this->items)){
            $this->items[$product->getId()]['QUANTITY'] += $item['QUANTITY'];
            $this->items[$product->getId()]['SUBTOTAL'] += $item['SUBTOTAL'];
            $this->total += $item['SUBTOTAL'];
        }
        else {
            $this->items += array($product->getId() => $item);
            $this->total += $item['SUBTOTAL'];
        }

    }
    
    //this functions returns an multidimesnional array of product names prices subtotals and quantities 
    public function getItemsList(){
        $itemArray = array();
        foreach($this->items as $item){
            $itemArray[] = array('ID' => $item['PRODUCT']->getId(), 
                                'PRODUCT_NAME' => $item['PRODUCT']->getName(),
                                'PRICE' => $item['PRODUCT']->getPrice(), 
                                'QUANTITY' => $item['QUANTITY'], 
                                'SUBTOTAL' => $item['SUBTOTAL']);
        }
        return $itemArray;
    }
    
    //getters and setters

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }
    
    
}

