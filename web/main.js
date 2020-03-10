// Javascript file for Assignment 3 PROG1800
function Validate(){
    // Pulls in all input fields as variables
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var phone = document.getElementById("phone").value.trim();
    var address = document.getElementById("address").value.trim();
    var city = document.getElementById("city").value.trim();
    var postalCode = document.getElementById("postalCode").value.toUpperCase().trim();
    var province = document.getElementById("province").value;
    var deliveryTime = document.getElementById("deliveryCharge").value;
    var pens = document.getElementById("pens").value.trim();
    var markers = document.getElementById("markers").value.trim();
    var paper = document.getElementById("paper").value.trim();

    // sets up default error message and regex
    var errors = `<fieldset>`;
    var phoneregex = /^\d{3}[\-]\d{3}[\-]\d{4}$/;
    var postalregex = /^[A-Z][0-9][A-Z]\s?[0-9][A-Z][0-9]$/;

    // Validation on each field
    if (name == "")
    {
        errors += "Please enter a Name<br>";
        document.getElementById("name").focus();
    }

    if (email == "")
    {
        errors += "Please enter an Email<br>";
        document.getElementById("email").focus();
    }

    if (phone == "")
    {
        errors += "Please enter a Phone Number<br>";
        document.getElementById("phone").focus();
    }
    else if (phone.length < 10)
    {
        errors += "You must use 10 digits for phone number<br>";
        document.getElementById("phone").focus();
    }
    else if (!phoneregex.test(phone))
    {
        errors += "Phone was not in proper format, use dashes<br>";
        document.getElementById("phone").focus();
    }

    if (address == "")
    {
        errors += "Please enter an Address<br>";
        document.getElementById("address").focus();
    }

    if (city == "")
    {
        errors += "Please enter a City<br>";
        document.getElementById("city").focus();
    }

    if (postalCode == "")
    {
        errors += "Please enter a Postal Code<br>";
        document.getElementById("postalCode").focus();
    }
    else if (!postalregex.test(postalCode))
    {
        errors += "Postal Code was not in proper format<br>";
        document.getElementById("postalCode").focus();
    }

    if ((pens == "" || pens == 0) && (markers == "" || markers == 0) && (paper == "" || paper == 0))
    {
        errors += "You must purchase at least one product<br>"
        document.getElementById("pens").focus();
    }
    if (isNaN(pens) || isNaN(markers) || isNaN(paper))
    {
        errors += "Please use only numbers for each product purchase<br>";
        document.getElementById("pens").focus();
    }
    if (pens < 0 || markers < 0 || paper < 0)
    {
        errors += "Please only use positive numbers for each product purchase<br>";
        document.getElementById("pens").focus();
    }


    

    // Checks for errors, posts if any are present
    if (errors != "<fieldset>")
    {
        errors += "</fieldset>";
        document.getElementById("errors").innerHTML = errors;
        return false;
    }
    else
    {
        errors = "";
        return true;
    }

}