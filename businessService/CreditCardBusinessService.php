<?php
/**
 *
 * Description:  This class handles validating a users entered credit card.
 *
 * @author Marc
 * Dec 7, 2019
 */

class CreditCardBusinessService
{
    
    //this function will mimic a 3rd party card validation service
    public function validateCard($card) {
        
        //fake cvv check
        if($card->getCvv() != 123) {
            return false;
        }
        
        //check for card number length
        if(str_replace('-', '', strlen($card->getNumber())) != 19) {
            return false;
        }
        
        return true;
    }
    
    //this method charges the users card for the given amount
    public function chargeCard($card, $amount) {
        return TRUE;
    }
    
    //this queries a charge to the given card
    public function queryCreditCharge($card, $amount) {
        return TRUE;
    }
}

