let userNameInput=document.getElementById('userNameInput');
let emailInput=document.getElementById('emailInput');
let passwordInput=document.getElementById('password-field');
let repassword=document.getElementById('repassword');
let signUpBtn=document.getElementById('signUpBtn');
let alertMassage=document.getElementById('alertMassage');
let loginBtn=document.getElementById('loginBtn');
let welcomeMassage=document.getElementById('welcomeMassage');
let logOutBtn=document.getElementById('logOutBtn')
let userContainer=[];


if(localStorage.getItem('Users')!=null)
{
    userContainer=JSON.parse(localStorage.getItem('Users'));
}
if(signUpBtn != null)
{
    signUpBtn.addEventListener('click',signUp)
}
if(loginBtn != null)
{
    loginBtn.addEventListener('click',logIn)
}
if(logOutBtn != null)
{
    logOutBtn.addEventListener('click',logOut)
}


function signUp()
{
    let user={
        Name:userNameInput.value,
        email:emailInput.value,
        password:passwordInput.value
    }
    if(userNameInput=='' ||emailInput.value==''||passwordInput.value==''||repassword.value==''||checkEmailExist() !=-1 )
    {
        if(userNameInput=='' ||emailInput.value==''||passwordInput.value==''||repassword.value=='')
        {
            getAlertMessage('All inputs required','red');
        }
        if(checkEmailExist() !=-1)
        {
            getAlertMessage('Email is already exist','red');
        }
    }
    else if(passwordInput.value!=repassword.value){
        getAlertMessage("Passwords don't match",'red');
    }
    else
    {
        getAlertMessage('Success','green')
        userContainer.push(user);
        localStorage.setItem('Users',JSON.stringify(userContainer));
        // console.log(userContainer);
    }  
}
function getAlertMessage(str,color)
{
    alertMassage.innerHTML=str;
    alertMassage.classList.replace('d-none','d-block');
    alertMassage.style.color=color;   
}
function checkEmailExist()
{
   let res=  userContainer.findIndex(ele=>ele.email==emailInput.value);
   return res;
}

function logIn()
{
    if(emailInput.value=='' || passwordInput.value=='')
    {
        getAlertMessage('All inputs required','red')
    }
    else
    {
        let res= userContainer.find(ele=> ele.email==emailInput.value && ele.password==passwordInput.value);
        if(res == undefined)
        {
          getAlertMessage('Email or password not correct','red'); 
        }
        else
        {
          localStorage.setItem('userName',JSON.stringify(res.Name));
          window.location.href='/project/php/home.php'
      
        }
    }
}
function logOut()
{ 
    window.location.href='/project/index.html'
}


// Hide Password
$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });

// // Login section & signup
// function toggleForms() {
//     var signupForm = document.getElementById("signup");
//     var signonForm = document.getElementById("login");

//     if (signupForm.style.display === "none") {
//         signupForm.style.display = "block";
//         signonForm.style.display = "none";
//         // change button text to "Already have an account? Sign On"
//     } else {
//         signupForm.style.display = "none";
//         signonForm.style.display = "block";
//         // change button text to "Don't have an account? Sign Up"
//     }
// }