<?php
/**
 * 
 * This file is used to display form for the user to enter in credit card information
 * 
**/
?>

<div class="creditCardForm">
    <div class="payment">
        <form action="/presentation/handlers/creditCardHandler.php" method="POST">
            <div class="form-group owner">
                <label for="owner">Name</label>
                <input type="text" class="form-control" id="owner" name="Name">
            </div>
            <div class="form-group CVV">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" name="CVV">
            </div>
            <div class="form-group" id="card-number-field">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="Number">
            </div>
            <div class="form-group" id="expiration-date">
                <label>Expiration Date</label>
                <select name ="Month">
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select name="Year">
                    <option value="19"> 2019</option>
                    <option value="20"> 2020</option>
                    <option value="21"> 2021</option>
                    <option value="22"> 2022</option>
                    <option value="23"> 2023</option>
                    <option value="24"> 2024</option>
                </select>
            </div>
            <div class="form-group" id="pay-now">
                <button type="submit" class="btn btn-default" id="confirm-purchase">Validate</button>
            </div>
        </form>
    </div>
</div>