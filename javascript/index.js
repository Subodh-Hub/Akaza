var currentUrl=window.location.href;

var urlWithoutQueryString = currentUrl.split('?')[0];

// Get the value from the session variable named "user"
var user = sessionStorage.getItem('userJ');

// Check if the session variable exists and has a value


if(urlWithoutQueryString == "http://localhost/Akaza/video.php"){
    console.log(urlWithoutQueryString );
    if (user) {
        console.log(user);
       
    } else {
        openSignIn();
    }
}



function loggin(){
    sessionStorage.setItem("userJ","in");
}

function loggout(){
    sessionStorage.removeItem("userJ");
}

function openSignIn(){

    document.getElementById("darkbox").style.display="flex"
    document.getElementById("login_box").style.display="flex"   
}


function openRegister(){
    document.getElementById("login_box").style.display="none"
    document.getElementById("register_box").style.display="flex"
}

function openSignUp(){
    document.getElementById("login_box").style.display="flex"
    document.getElementById("register_box").style.display="none"
}

function crossSign(){
    
    
    if (user) {
        document.getElementById("darkbox").style.display="none"
        document.getElementById("login_box").style.display="none"  
        document.getElementById("register_box").style.display="none" 
       
    } else {
        alert("Login is required!")
    }
    
}

let menuBoxOpen=false;
function openBar(){
    if(!menuBoxOpen){
        document.getElementById("menu").style.display="flex" 
        document.getElementById("darkbox_menu").style.display="flex" 
        document.getElementById("darkbox_menu").style.opacity="0"
        menuBoxOpen=true
    }else{
        document.getElementById("menu").style.display="none" 
        document.getElementById("darkbox_menu").style.display="none"
        document.getElementById("darkbox_menu").style.opacity="1"
        menuBoxOpen=false
    }
}

