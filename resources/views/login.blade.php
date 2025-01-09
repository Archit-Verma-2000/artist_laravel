<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('Admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        .background{
            background-color: #f5f0f0;
        }
    </style>
</head>

<body class="background">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="Login-form">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                 aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..."  name="email" id="email" pattern='^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$' value="{{old('email')}}" required>
                                            <div id="email-valid">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                 placeholder="Password" name="password" id="password" pattern='^(?!^$)(?=.*[a-z])(?=.*[A-Z])(?=.*\W+)(?=.*[0-9])[a-zA-z0-9~`!@#$%^@*\(\)-_+=\{\{\[\]\|\\;:"<>,.\/?]{8,}' required>
                                            <div id="password-valid">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember">
                                                <label class="custom-control-label" for="customCheck" name="remember" >Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <a href="index.html" class="btn btn-primary btn-user btn-block" name="Loginbtn" id="Loginbtn">
                                            Login
                                        </a>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
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
       errorFlag=true;
       email=document.getElementById("email");
       password=document.getElementById("password");
       errorEmail=["email field required","pattern matched"];
       errorPass=["Minimum length 8","atleast one Lowercase","atleast one Uppercase","atleast one special character"];
       email.addEventListener("keyup",(e)=>{
            // let inputText=(e.target.value).slice(-1);
            // console.log(inputText);
            let emailValid=document.getElementById("email-valid");
            emailValid.innerHTML="";
            errorEmail.forEach((error)=>{
                let innerDiv=document.createElement("div");
                let innerDivText=document.createTextNode(error);
                innerDiv.appendChild(innerDivText);
                emailValid.appendChild(innerDiv);
                emailValid.style.color="red";
                emailValid.style.marginLeft="30px";
            })
            if(e.target.value==="")
            {
                errorFlag=true;
                e.target.style.border="2px solid red";
                console.log("email field required"); 
            }
            else if(!email.checkValidity())
            {
                errorFlag=true;
                emailValid.children[0].style.color="green";
                if(email.validity.patternMismatch)
                {
                    e.target.style.border="2px solid red";
                    console.log("pattern mismatch");
                }
            }
            else
            {       
                    errorFlag=false;
                    emailValid.children[0].style.color="green";
                    emailValid.children[1].style.color="green";
                    e.target.style.border="2px solid green"
                    console.log("valid email format");
            }
       });
       email.addEventListener("click",(e)=>{
            let passwordValid=document.getElementById("password-valid");
            password.style.border="";
            passwordValid.innerHTML="";
       });
       password.addEventListener("click",(e)=>{
            let emailValid=document.getElementById("email-valid");
            email.style.border="";
            emailValid.innerHTML="";
       });
       password.addEventListener("input",(e)=>{
            // let inputText=(e.target.value).slice(-1);
            // console.log(inputText);
            let passwordValid=document.getElementById("password-valid");
            passwordValid.innerHTML="";
            errorPass.forEach((error)=>{
                let innerDiv=document.createElement("div");
                let innerDivText=document.createTextNode(error);
                innerDiv.appendChild(innerDivText);
                passwordValid.appendChild(innerDiv);
                passwordValid.style.color="red";
                passwordValid.style.marginLeft="30px";
            });
            if(e.target.value==="")
            {       errorFlag=true;
                    e.target.style.border="2px solid red"
                    console.log("password field required");
                    passwordValid.innerHTML="";
            }
            else if(!password.checkValidity())
            {       errorFlag=true;
                    if(password.validity.patternMismatch)
                    {
                        e.target.style.border="2px solid red"
                        console.log("password not matched");
                        passValidation(passwordValid);
                    }
            }
            else
            {       errorFlag=false;
                    e.target.style.border="2px solid green";
                    console.log("password matched");
                    passValidation(passwordValid);
            }
       });   
       function passValidation(passwordValid){
                        let lengthRegex=/.{4,}/;
                        let upperRegex=/(?=.*[A-Z])/;
                        let LowerRegex=/(?=.*[a-z])/;
                        let SpecialRegex=/(?=.*\W+)/;
                        if(lengthRegex.test(password.value))
                        {
                            passwordValid.children[0].style.color="green";
                        }
                        if(LowerRegex.test(password.value))
                        {
                            passwordValid.children[1].style.color="green";
                        }
                        if(upperRegex.test(password.value))
                        {
                            passwordValid.children[2].style.color="green";
                        }
                        if(SpecialRegex.test(password.value))
                        {
                            passwordValid.children[3].style.color="green";
                        }
       }
       loginForm=document.getElementById("Login-form");
       document.querySelector("#Loginbtn").addEventListener("click",(e)=>{
            e.preventDefault();
            let Login=document.querySelector("#Login-form");
            if(Login.checkValidity()&&!errorFlag)
            {
                new Promise(function(resolve,reject){
                    fd=new FormData(loginForm);
                    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch("{{route('Login')}}",{
                        method:"POST",
                        body:fd,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Add CSRF token to headers
                        },
                    })
                    .then((response)=>response.json())
                    .then((data)=>{resolve(data)})
                    .catch((error)=>{reject(error)})
                })
                .then((data)=>{
                     alert(data.session);
                     console.log(data.session);
                     if(data.status==="failed")
                     {
                        
                     }
                     else if(data.status==="success")
                     {
                        window.location.href="{{route('products')}}";
                     }  
                })
                .catch((error)=>{
                    alert(error);
                    console.log(error);
                });
            }
            else
            {
                console.log("validity failed")
            }
        });
    })
</script>
</html>