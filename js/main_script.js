//Validates the login data

function validateForm(form) {

    var teamname = form.teamname.value;
    var password = form.password.value;

    if( teamname.length >= 6 ){
         if( teamname.length < 60 ){
             var re = new RegExp("^[0-9A-Za-z]*$");
             if( re.test(teamname) ){
                if( password.length >= 6 ){
                    return true;
                }
                else{
                    alert("Password has to be atleast 6 characters");
                    return false;
                }
             }
             else{
                alert("Team Name should contain only letters and numbers");
                return false;
            }
         }
         else{
            alert("Team Name has to be less than 60 characters");
            return false;
         }
    }
    else{
        alert("Team Name has to be atleast 6 characters");
        return false;
    }
    
}
