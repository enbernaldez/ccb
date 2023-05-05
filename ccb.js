//adds shadow to the bottom of navbar when scrolled
window.addEventListener('scroll', function(){
    const shadow = document.querySelector('.navbar');
    if(window.pageYOffset>3){
        shadow.classList.add("add-shadow");
    }else{
        shadow.classList.remove("add-shadow");
    }
});
//allows user to see the password they typed
function toggle_pwd() {
    var pwd = document.getElementById("reg_password");

    if (pwd.type === "password") {
        pwd.type = "text";
    } else {
        pwd.type = "password";
    }
}

//add js for automatic change of total display