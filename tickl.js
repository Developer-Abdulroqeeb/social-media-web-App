
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const cpassword = document.getElementById('cpassword');
        const email = document.getElementById('email');
        const submit = document.getElementById('submit');
        const form = document.getElementById('form');
        const error = document.getElementById('error');
        const required = document.getElementById('required');
        const email_require = document.getElementById('email_require');
        const password_require = document.getElementById('password_require');
        const cpassword_require = document.getElementById('cpassword_require');
        cpassword.addEventListener('input',function(){
               if(cpassword.value != password.value){
                submit.disabled = true;
                error.innerHTML = "Password doesn't match";
                error.style.color = 'red';
               }
            //    else if(password.value !== "" || cpassword.value.trim() !== ""){
            //     submit.disabled = false;
            //     // submit.style.background = '#8B5E3C';
            //     // submit.style.color = 'white';
            //    }
               else{
                error.innerHTML = "Password match";
                error.style.color = 'green';
                submit.disabled = false;
                submit.style.background = '#8B5E3C';
                submit.style.color = 'white';
               }
        });
    form.addEventListener('submit', function(e){
        if(username.value.trim() === ""){
            required.innerHTML = "Required*";
            required.style.color = "red";
     e.preventDefault();
        }
        else if(email.value.trim() === ""){
            email_require.innerHTML = "Required*";
            email_require.style.color = "red";
     e.preventDefault();
        }
        else if(password.value.trim() === ""){
            password_require.innerHTML = "Required*";
            password_require.style.color = "red";
     e.preventDefault();
        }
        else if(cpassword.value.trim() === ""){
            cpassword_require.innerHTML = "Required*";
            cpassword_require.style.color = "red";
     e.preventDefault();
        }
    });
    
     