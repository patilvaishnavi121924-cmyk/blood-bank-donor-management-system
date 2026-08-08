function togglePassword()
{
    var x = document.getElementById("password");

    if(x.type==="password")
    {
        x.type="text";
    }
    else
    {
        x.type="password";
    }
}

function showLoginPassword()
{

var x=document.getElementById("loginPassword");

if(x.type==="password")
{

x.type="text";

}

else
{

x.type="password";

}

}