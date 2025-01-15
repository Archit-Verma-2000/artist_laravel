<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('Admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
    .form-select-lg {
       
        font-size: 1.25rem;
    }
    .form-control-user::placeholder {
        font-size: 0.8rem; /* Set font size for input placeholder text */
    }
    </style>
    <style>
        .background {
            background-color: #f5f0f0;
        }
    </style>

</head>

<body class="background">

    <div class="container px-5">

        <div class="card o-hidden border-0 shadow-lg " style="margin-left:200px;margin-right:200px;margin-top:50px;">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">
                                @if(Route::is('admin.register'))        
                                    Admin-Register
                                @elseif(Route::is('customer.register'))
                                    Customer-Register
                                @endif
                            </h1>
                        </div>
                        <form class="user" id="registerForm">
                            @csrf
                            <div class="form-group">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" 
                                        placeholder="First Name" id="fname" name="fname" required>
                                </div>
                                <div id="fname-error">

                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-sm-12 mt-3">
                                    <input type="text" class="form-control form-control-user" 
                                        placeholder="Last Name" id="lname" name="lname" required>
                                </div>
                                <div id="lname-error">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 mt-3">
                                    <input type="email" class="form-control form-control-user" 
                                    placeholder="Email Address" id="email" name="email" required>
                                </div>
                                <div id="email-error">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                        placeholder="Password" id="pass" name="password" required>
                                </div>
                                <div id="pass-error">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 mt-3">
                                    <input type="password" class="form-control form-control-user"
                                         placeholder="Repeat Password" id="password_confirmation" name="password_confirmation" required>
                                </div>
                                <div id="rpass-error">

                                </div>
                            </div>
                    </div>
                    <a type="btn" class="btn btn-primary btn-user btn-block" id="Register">
                        Register Account
                    </a>
                    <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                        <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                    </a>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="login.html">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('Admin/js/sb-admin-2.min.js')}}"></script>

</body>
<script>
    window.addEventListener("load",()=>{
        /*<<<<<<<<Form Validation>>>>>>>>>> */
            let errorFlag=false;
            let fname=document.getElementById(
                "fname"
            );
            let lname=document.getElementById(
                "lname"
            );
            let email=document.getElementById(
                "email"
            );
            let pass=document.getElementById(
                "pass"
            );
            let rpass=document.getElementById(
                "password_confirmation"
            );
            fnameError=document.getElementById(
                "fname-error"
            );
            lnameError=document.getElementById(
                "lname-error"
            );
            emailError=document.getElementById(
                "email-error"
            );
            passError=document.getElementById(
                "pass-error"
            );
            rpassError=document.getElementById(
                "rpass-error"
            );
            /*Checks for fname validation*/
            fname.addEventListener("input",(e)=>{
                let fnameVal=e.target.value;
                fnameError.innerHTML="";
                innerUnorderList=document.createElement("ul");
                fnameError.appendChild(innerUnorderList);
                nameRegex=/^(?!.*\s+)(?!.*\d)(?!.*\W+)[a-zA-Z]{5,}/;
                if(fnameVal=="")
                {
                    errorFlag=true;
                    fname.style.border="2px solid red";
                    innerList=document.createElement("li");
                    innerListText=document.createTextNode("field cant be empty");
                    innerList.appendChild(innerListText);
                    innerUnorderList.appendChild(innerList);
                    innerUnorderList.style.color="red";
                    innerUnorderList.style.marginLeft="30px";
                    console.log("name required");
                }
                else if(!nameRegex.test(fnameVal))
                {   
                        errorFlag=true;
                        fname.style.border="2px solid red";
                        lengthRegex=/^.{5,}$/;
                        digitRegex=/\d/;
                        whitespaceRegex=/\s/;
                        SpecialRegex=/\W+/;
                        if(!lengthRegex.test(fnameVal)) 
                        {
                            let msg="minimum 6 character required";
                            nameValidation(msg,innerUnorderList);
                        }
                        if(digitRegex.test(fnameVal))
                        {
                            let msg="no digits allowed";
                            nameValidation(msg,innerUnorderList);
                            
                        }
                        if(whitespaceRegex.test(fnameVal))
                        {
                            let msg="no whitespace allowed";
                            nameValidation(msg,innerUnorderList);
                        }
                        if(SpecialRegex.test(fnameVal))
                        {
                            let msg="Special Characters not allowed";
                            nameValidation(msg,innerUnorderList);
                        }
                }
                else
                {
                    errorFlag=false;
                    console.log("regex passed");
                    fnameError.innerHTML="";
                    fname.style.border="2px solid green";
                    
                }
            });
            /*Checks for fname validation*/

            /*Checks for lname validation*/
            lname.addEventListener("input",()=>{
                lnameObject=this.lname;
                regexPat=/^(?!.*\s+)(?!.*\d)(?!.*\W+)[a-zA-Z]{5,}/;
                lnameError.innerHTML="";
                let unorderedList=document.createElement("ul");
                lnameError.appendChild(unorderedList);
                lnameObject.style.border="2px solid red";
                if(lnameObject.value=="")
                {
                    errorFlag=true;
                    msg="field is required";
                    nameValidation(msg,unorderedList);
                    console.log("Fields cant be empty")
                }
                else if(!regexPat.test(lnameObject.value))
                {
                    errorFlag=true;
                    lengthRegex=/^.{5,}$/;
                    digitRegex=/\d/;
                    whitespaceRegex=/\s/;
                    SpecialRegex=/\W+/;
                    if(!lengthRegex.test(lnameObject.value)) {
                        let msg="only 5 character required";
                        nameValidation(msg,unorderedList);
                        console.log("minimum 5 charcter allowed");
                    }
                    if(digitRegex.test(lnameObject.value)) {
                        let msg="no digits allowed";
                        nameValidation(msg,unorderedList);
                        console.log("no digits allowed");
                    }
                    if(whitespaceRegex.test(lnameObject.value)) {
                        let msg="no whitespace allowed";
                        nameValidation(msg,unorderedList);
                        console.log("no whitespace allowed");
                    }
                    if(SpecialRegex.test(lnameObject.value)) {
                        let msg="no special characters allowed";
                        nameValidation(msg,unorderedList);
                        console.log("no whitespace allowed");
                    }
                }
                else
                {
                    errorFlag=false;
                    lnameObject.style.border="2px solid green";
                    console.log("pattern matched");
                }
            });
            /*Checks for lname validation*/

            /*Checks for email validation*/
                email.addEventListener("input",()=>{
                    emailObject=this.email;
                    emailObject.style.border="2px solid red";
                    emailError.innerHTML="";
                    let unorderedList=document.createElement("ul");
                    emailError.appendChild(unorderedList);
                    emailRegex=/^[A-za-z0-9._%+\-]+@[A-za-z.\-]+\.[a-zA-Z]{2,}/;
                    if(emailObject.value=="")
                    {
                        errorFlag=true;
                        msg="email is required";
                        nameValidation(msg,unorderedList);
                    }
                    else if(!emailRegex.test(emailObject.value))
                    {
                        errorFlag=true;
                        msg="email not valid";
                        nameValidation(msg,unorderedList);
                    }
                    else
                    {
                        errorFlag=false;
                        emailObject.style.border="2px solid green"; 
                    }
                });
            /*Checks for email validation*/
            /* Password validation */
                pass.addEventListener("input",()=>{
                    passObject=this.pass;    
                    passObject.style.border="2px solid red";  
                    passError.innerHTML="";
                    unorderedList=document.createElement("ul");
                    passError.appendChild(unorderedList);
                    passRegex=/^(?!^$)(?=.*[a-z])(?=.*[A-Z])(?=.*\W+)(?=.*[0-9])[a-zA-z0-9~`!@#$%^@*\(\)-_+=\{\{\[\]\|\\;:"<>,.\/?]{8,}$/;
                    if(passObject.value=="")
                    {
                        errorFlag=true;
                        msg="password is required";
                        nameValidation(msg,unorderedList);
                    }
                    else if(!passRegex.test(passObject.value))
                    {
                        errorFlag=true;
                        let msg
                        lengthRegex=/^.{8,}/;
                        upperRegex=/[A-Z]/;
                        lowerRegex=/[a-z]/;
                        digitRegex=/\d/;
                        specialRegex=/\W+/;
                        if(!lengthRegex.test(passObject.value))
                        {
                            msg="password should be minimum of 8 length";
                            nameValidation(msg,unorderedList);
                        }
                        if(!upperRegex.test(passObject.value))
                        {
                            msg="one Uppercase character required";
                            nameValidation(msg,unorderedList);
                        }
                        if(!lowerRegex.test(passObject.value))
                        {
                            msg="one Lowercase character required";
                            nameValidation(msg,unorderedList);
                        }
                        if(!digitRegex.test(passObject.value))
                        {
                            msg="one Digit required";
                            nameValidation(msg,unorderedList);
                        }
                        if(!specialRegex.test(passObject.value))
                        {
                            msg="one Special character required";
                            nameValidation(msg,unorderedList);
                        }
                        
                    }
                    else
                    {
                        errorFlag=false;
                        passObject.style.border="2px solid green";
                    }
                });
            /* Password validation */
        function nameValidation(msg,innerUnorderList)
        {
            innerList=document.createElement("li");
            innerListText=document.createTextNode(msg);
            innerList.appendChild(innerListText);
            innerUnorderList.appendChild(innerList);
            innerUnorderList.style.color="red";
            innerUnorderList.style.marginLeft="30px";
        } 
        /*<<<<<<<<Form Validation>>>>>>>>>> */
        /*Blur event on input*/
        fname.addEventListener("blur",(e)=>{
                fnameError.innerHTML="";
                this.fname.style.border="";
            });
            lname.addEventListener("blur",(e)=>{
                lnameError.innerHTML="";
                this.lname.style.border="";
            });
          
        /*Blur event on input*/
        let form=document.getElementById("registerForm");
        document.querySelector("#Register").addEventListener("click",function(e){
                e.preventDefault();
                if(form.checkValidity()&&!errorFlag)
                {
                    if(pass.value==rpass.value)
                    {
                        let currentUrl = window.location.href; // Get the current URL
                        let userType=currentUrl.includes('admin') ? 'admin' : 'customer';
                        console.log("inside promise");
                        new Promise((resolve,reject)=>{
                            let fd=new FormData(form);
                            
                            let url=userType=='admin'?"{{route('admin.registerstore')}}":"{{route('customer.registerstore')}}";
                            fetch(url,{
                                body:fd,
                                method:"POST",
                            })
                            .then((response) => response.json())
                            .then((data) => {resolve(data)})
                            .catch((error) => {reject(error)});
                        })
                        .then((data) => {
                            if(data.status=="success")
                            {
                                let loginpage=userType=='admin'?"{{route('admin.login')}}":"{{route('customer.login')}}";
                                window.location.href=loginpage;
                            }
                            else if(data.status=="failed")
                            {
                                console.log(data); 
                            }
                        })  
                        .catch((error) => {console.log(error)});   
                    }
                    else
                    {
                        console.log("password dont match");
                    }
                }
                else
                {
                    console.log("invalid");
                }
            });
        /*Register Form request*/
    })
    
</script>
</html>