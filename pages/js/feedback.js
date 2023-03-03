function feedbackFormValidate()
{
    var contactFormObj = document.getElementById("feedback");
    var firstName = contactFormObj.firstname.value;
    var lastName = contactFormObj.lastname.value;
    var email = contactFormObj.email.value;
    var improvement = contactFormObj.improvement;
    var everythingOK = true;

    if (!validateName(firstName))
    {
        alert("Error: Invalid first name.");
        everythingOK = false;
    }
    
    if (!validateName(lastName))
    {
        alert("Error: Invalid last name.");
        everythingOK = false;
    }
    
    if (!validateEmail(email))
    {
        alert("Error: Invalid e-mail address.");
        everythingOK = false;
    }

    var currentLength = improvement.value.length;
    alert("You typed " + currentLength + " characters in the improvement box!");
    
    if (everythingOK)
    {
        alert("All the information looks good.\nThank you!");
        return true;
    }
    else
        return false;
}

function validateName(name)
{
    var p = name.search(/^[-'\w\s]+$/);
    if (p == 0)
        return true;
    else
        return false;
}

function validateEmail(address)
{
    var p = address.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/);
    if (p == 0)
        return true;
    else
        return false;
}