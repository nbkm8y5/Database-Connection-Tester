function signIn() {

    var email, password, text;

    email = document.getElementById("inputEmail").value;
    password = document.getElementById("inputPassword").value;


    if (email === "1@2.net") {

        text = "Email Okay";
    } else {
        text = "Email Not Okay";
    }

    document.getElementById("signInAlert").innerHTML = text;
}

function resetForm() {
    document.getElementById("signInForm").reset();
    }


/*
JavaScript Objects
JavaScript objects are written with curly braces.

Object properties are written as name:value pairs, separated by commas.

Example

var person = {firstName:"John", lastName:"Doe", age:50, eyeColor:"blue"};
*/