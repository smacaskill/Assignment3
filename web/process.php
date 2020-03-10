<!-- PHP validation from POST of Assignment 3 PROG1800-->
<?php 
    if (!empty($_POST)) // Checks for empty POSt, then runs remaining validation of each field
    {
        $errors = "";


        $name = $_POST['name'];
        if ($name == "")
        {
            $errors = $errors."Please enter a Name<br>";
        }

        $email = $_POST['email'];
        if ($email == "")
        {
            $errors = $errors."Please enter an Email<br>";
        }

        $phone = $_POST['phone'];
        if ($phone == "")
        {
            $errors = $errors."Please enter a Phone Numbere<br>";
        }
        else if (preg_match('/^\d{3}[\-]\d{3}[\-]\d{4}$/', $phone) == 0) // Regular expression for phone number check
        {
            $errors = $errors."Phone number incorrect format. Must be 10 digits, use dashes.<br>";
        }

        $address = $_POST['address'];
        if ($address == "")
        {
            $errors = $errors."Please enter a Address<br>";
        }

        $city = $_POST['city'];
        $city = strtoupper($city);
        if ($city == "")
        {
            $errors = $errors."Please enter a City<br>";
        }

        $postalCode = $_POST['postalCode'];
        $postalCode = strtoupper($postalCode);
        if ($postalCode == "")
        {
            $errors = $errors."Please enter a Postal Code<br>";
        }
        else if (preg_match('/^[A-Z][0-9][A-Z]\s?[0-9][A-Z][0-9]$/', $postalCode) == 0) // Regular Expression for Postal Code check
        {
            $errors = $errors."Postal Code format incorrect, please retry.<br>";
        }

        // Sets up sales tax based on province selection
        $province = $_POST['province'];
        switch($province)
        {
            case "AB":
            case "NT":
            case "NU":
            case "YT":
                $salesTax = 0.05;
                break;
            case "BC":
                $salesTax = 0.12;
                break;
            case "MB":
            case "ON":
                $salesTax = 0.13;
                break;
            case "NB":
            case "NL":
            case "NS":
            case "PE":
                $salesTax = 0.15;
                break;
            
            case "QC":
                $salesTax = 0.1498;
                break;
            case "SK":
                $salesTax = 0.11;
                break;

            default:
        }

        // Sets null numeric fields to 0
        $pens = $_POST['pens'];
        if ($pens == null)
        {
            $pens = 0;
        }

        $markers = $_POST['markers'];
        if ($markers == null)
        {
            $markers = 0;
        }

        $paper = $_POST['paper'];
        if ($paper == null)
        {
            $paper = 0;
        }

        // Sets Delivery Time frame based on POST Delivery Charge
        $deliveryCharge = $_POST['deliveryCharge'];
        switch ($deliveryCharge)
        {
            case 15:
                $deliveryTime = 4;
                break;
            case 20:
                $deliveryTime = 3;
                break;
            case 25:
                $deliveryTime = 2;
                break;
            case 30:
                $deliveryTime = 1;
                break;
            default:
        }
        
        // Checks for valid input in number only fields, checks for at least one purchase
        if (!is_numeric($pens) || !is_numeric($markers) || !is_numeric($paper))
        {
            $errors = $errors."Please use only numbers for the quantity of product.";
        }
        else if ($pens < 0 || $markers < 0 || $paper < 0)
        {
            $errors = $errors."Please use only positive numbers for quantity of product.";
        }
        else if ($pens < 1 && $markers < 1 && $paper < 1)
        {
            $errors = $errors."You must purchase at least one item<br>";
        }
        else
        {
        $subTotal = ($pens*0.05) + ($markers*0.25) + ($paper*2) + ($deliveryCharge);
        
        $tax = $subTotal*$salesTax;
        $total = $tax+$subTotal;
            
        }
        
        // Concatenates user info for Invoice header
        $customerInfo = "   <br>Send To:<br>
                            $name<br>
                            $address<br>
                            $city,$province<br>
                            $postalCode<br><br>
                            
                            <strong>Shipment Details:</strong><br>";
                    
        $customerContact = "Contact at:<br><br>
                            $email<br>
                            $phone<br><br>";
    }        ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assignment 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"> <!-- Styles file -->
    <script src="main.js"></script><!-- Javascript file -->
    
</head>
<body>
        
    <?php if (!empty($_POST) && $errors == "") { ?> <!-- Checks for empty post or errors -->
    
    <!-- Final Invoice Output -->
    <main>
        <fieldset>
            <h2>Your Order is confirmed!</h2>
            <table>
                <th>
                    Invoice # <? echo rand(); ?>
                </th>
                <tr>
                    <td>
                        <? echo $customerInfo;?>
                    </td>
                    <td class="right">
                        <? echo $customerContact;?>
                    </td>
                </tr>
                
                <? if ($pens > 0) {?>
                <tr>
                    <td>
                        <?php echo $pens;?> Pens @ $0.05
                    </td>
                    <td class="right">
                        $<? echo number_format($pens*0.05, 2, '.', ',');?>
                    </td>
                </tr>
                <? }?>
                
                
                
                <? if($markers > 0) {?>
                <tr>
                    <td>
                        <?php echo $markers;?> Markers @ $0.25
                    </td>
                    <td class="right">
                        $<? echo number_format($markers*0.25, 2, '.', ',');?>
                    </td>
                </tr>
                <? } ?>

                <? if($paper > 0) { ?>
                <tr>
                    <td>
                        <?php echo $paper;?> Paper @ $2.00
                    </td>
                    <td class="right">
                        $<? echo number_format($paper*2, 2, '.', ',');?>
                    </td>
                </tr>
                <? } ?>

                <tr class="deliveryCharge">
                    <td>
                        <? echo $deliveryTime;?> Day Delivery 
                    </td>
                    <td class="right">
                        $<? echo number_format($deliveryCharge,2,'.',',');?>
                    </td>
                </tr>

                <tr class="subtotal">
                    <td>
                        Subtotal 
                    </td>
                    <td class="right">
                        $<? echo number_format($subTotal,2,'.',',');?>
                    </td>
                </tr>

                <tr class="tax">
                    <td>
                        Tax
                    </td>
                    <td class="right">
                        $<? echo number_format($tax,2,'.',',');?>
                    </td>
                </tr>

                <tr class="total">
                    <td>
                        <strong>Total</strong>
                    </td>
                    <td class="right">
                        <strong>$<? echo number_format($total,2,'.',',');?></strong>
                    </td>
                </tr>
            </table>
        </fieldset>
    </main>
    <? }

    else{?> <!-- Runs form again if errors found -->

    <form method ="Post" onsubmit="return Validate()" action="process.php">
        <fieldset>
            <h2>Todays Shop</h2>
            <p>Name:
            <input type="text" id="name" name="name" value="<?echo$name;?>"><br>
            <p>Email:
            <input type="email" id="email" name="email" value="<?echo$email;?>"><br>
            <p>Phone:
            <input type="text" id="phone" name="phone" value="<?echo$phone;?>"><br>
            <p>Address:
            <input type="text" id="address" name="address" value="<?echo$address;?>"><br>
            <p>City:
            <input type="text" id="city" name="city" value="<?echo$city;?>"><br>
            <p>Postal Code:
            <input type="text" id="postalCode" name="postalCode" value="<?echo$postalCode;?>"><br>
            <p>Province:
            <select id="province" name="province" default="<?echo 'ON';?>"> <!-- Checks for previous selection and echos selected -->
                <option <? if($province == "AB") { echo "selected"; }?> value="AB">Alberta</option>
                <option <? if($province == "BC") { echo "selected";}?> value="BC">British Columbia</option>
                <option <? if($province == "MB") { echo "selected";}?> value="MB">Manitoba</option>
                <option <? if($province == "NB") { echo "selected";}?> value="NB">New Brunswick</option>
                <option <? if($province == "NL") { echo "selected";}?> value="NL">Newfoundland</option>
                <option <? if($province == "NB") { echo "selected";}?> value="NT">North West Terrirtories</option>
                <option <? if($province == "NS") { echo "selected";}?> value="NS">Nova Scotia</option>
                <option <? if($province == "NU") { echo "selected";}?> value="NU">Nunavut</option>
                <option <? if($province == "ON") { echo "selected";}?> value="ON">Ontario</option>
                <option <? if($province == "QC") { echo "selected";}?> value="QC">Quebec</option>
                <option <? if($province == "PE") { echo "selected";}?> value="PE">Prince Edward Island</option>
                <option <? if($province == "SK") { echo "selected";}?> value="SK">Saskatchewan</option>
                <option <? if($province == "YT") { echo "selected";}?> value="YT">Yukon</option>
            </select><br>
            <p># of Pens @ $0.05 Each: 
            <input type="text" id="pens" name="pens" value="<?echo$pens;?>"><br>
            <p># of Markers @ $0.25 Each:
            <input type="text" id="markers" name="markers" value="<?echo$markers;?>"><br>
            <p># of Paper @ $2.00 per 50 pack:
            <input type="text" id="paper" name="paper" value="<?echo$paper;?>"><br>
            <p>Delivery Time:
            <select id="deliveryCharge" name="deliveryCharge"> <!-- Checks for previous selection and echos selected -->
                <option <? if($deliveryCharge == "30") { echo "selected";}?> value="30">1 Day @ $30.00</option>
                <option <? if($deliveryCharge == "25") { echo "selected";}?> value="25">2 Days @ $25.00</option>
                <option <? if($deliveryCharge == "20") { echo "selected";}?> value="20">3 Days @ $20.00</option>
                <option <? if($deliveryCharge == "15") { echo "selected";}?> value="15">4 Days @ $15.00</option>
            </select><br>
            <div id="submitButton"><button type="submit">Submit</button></div>
        </fieldset>
    </form>

    <div id="errors"></div>
    <? echo "<fieldset id='errors'>".$errors."</fieldset>"; }?>
</body>
</html>

        

   
</body>
</html>