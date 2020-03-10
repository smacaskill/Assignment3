<!DOCTYPE html> <!-- Sandy MacAskill Assignment 3 - PROG 1800 -->
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
    <form method ="Post" onsubmit="return Validate()" action="process.php"> <!-- Form runs Javascript validation before sending to PHP validation-->
        <fieldset>
            <h2>Todays Shop</h2>
            <p>Name:
            <input type="text" id="name" name="name"><br>
            <p>Email:
            <input type="email" id="email" name="email"><br>
            <p>Phone:
            <input type="text" id="phone" name="phone" placeholder="555-555-5555"><br>
            <p>Address:
            <input type="text" id="address" name="address"><br>
            <p>City:
            <input type="text" id="city" name="city"><br>
            <p>Postal Code:
            <input type="text" id="postalCode" name="postalCode" placeholder="A1A 1A1"><br>
            <p>Province:
            <select id="province" name="province">
                <option value="AB">Alberta</option>
                <option value="BC">British Columbia</option>
                <option value="MB">Manitoba</option>
                <option value="NB">New Brunswick</option>
                <option value="NL">Newfoundland</option>
                <option value="NT">North West Terrirtories</option>
                <option value="NS">Nova Scotia</option>
                <option value="NU">Nunavut</option>
                <option value="ON">Ontario</option>
                <option value="PE">Prince Edward Island</option>
                <option value="QC">Quebec</option>
                <option value="SK">Saskatchewan</option>
                <option value="YT">Yukon</option>
            </select><br>
            <p># of Pens @ $0.05 Each: 
            <input type="text" id="pens" name="pens"><br>
            <p># of Markers @ $0.25 Each:
            <input type="text" id="markers" name="markers"><br>
            <p># of Paper @ $2.00 per 50 pack:
            <input type="text" id="paper" name="paper"><br>
            <p>Delivery Time:
            <select id="deliveryCharge" name="deliveryCharge">
                <option value="30">1 Day @ $30.00</option>
                <option value="25">2 Days @ $25.00</option>
                <option value="20">3 Days @ $20.00</option>
                <option value="15">4 Days @ $15.00</option>
            </select><br>
            <div id="submitButton"><button type="submit">Submit</button></div>
        </fieldset>
    </form>

    <div id="errors"></div> <!-- Error messages if there are any-->
</body>
</html>