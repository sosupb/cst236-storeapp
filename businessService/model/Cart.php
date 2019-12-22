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
    private $discount;
    private $discountCode;
    private $isDiscountPercent;
    private $isDicountActive;
    
    //constructor
    public function __construct($userid){
        $this->userid = $userid;
        $this->items = array();
        $this->total = 0.0;
        $this->discount = 0.0;
        $this->isDiscountPercent = false;
        $this->isDicountActive = false;
        
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
    
    //this method prints the discout based on its type
    public function displayDiscountString() {
        if(!$this->isDicountActive) { //no active discount so return empty string
            return "";
        }
        
        if($this->isDiscountPercent) { //this discount needs to be treated as a percentage off
            return $this->discount . "% off";
        }
        else { //this discount is a flat amount off of the total
            return "-$" . $this->discount . " off";
        }
    }
    
    //this method grabs the total amount of discount 
    public function getCurrentDiscountAmount() {
        if(!$this->isDicountActive) { //no discount so return zero
            return 0;
        }
        
        if($this->isDiscountPercent) { //treat as a percentage
            return ($this->discount / 100) * $this->total;
        }
        else {
            return $this->discount;
        }
           
    }
    
    //this method finds the subtotal based on the current discount
    public function getTotalAfterDiscount()
    {
        if(!$this->isDicountActive) {
            return $this->total;
        }
        
        $discountedTotal = $this->total - $this->getCurrentDiscountAmount();
        if($discountedTotal < 0) {
            $discountedTotal = 0.0;
        }
        return $discountedTotal; 
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
    
    public function setTotal($total)
    {
        $this->total = $total;
    }
    
    public function getDiscout()
    {
        return $this->discount;
    }

    public function setDiscount($discout)
    {
        $this->discount = $discout;
    }

    public function getIsDiscountPercent()
    {
        return $this->isDiscountPercent;
    }

    public function setIsDiscountPercent($isDiscountPercent)
    {
        $this->isDiscountPercent = $isDiscountPercent;
    }

    public function getIsDicountActive()
    {
        return $this->isDicountActive;
    }

    public function setIsDicountActive($isDicountActive)
    {
        $this->isDicountActive = $isDicountActive;
    }
    
    public function getDiscountCode()
    {
        return $this->discountCode;
    }

    public function setDiscountCode($discountCode)
    {
        $this->discountCode = $discountCode;
    }
}

