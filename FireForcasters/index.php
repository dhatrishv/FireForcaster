<?php
session_start();
$wasRegister = isset($_SESSION['from']) && $_SESSION['from'] === 'register';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> FireFO | Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    @import url(https://fonts.googleapis.com/css2?family:Poppins:wght@300;400;500;600;700;800;900&display=swap);
    *{
        margin: 0;
        padding: 0;
        box-sizing: bo rder-box;
        font-family: 'Poppins', sans-serif;
    }
    
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background:url('fire.jpg') no-repeat;
        background-size: cover;
        background-position: center;

    }
    .container{
        position: relative;
        width: 800px;
        height: 500px;
        border: 2px solid rgba(255,255,255,.5);
        background:transparent;
        backdrop-filter: blur(10px);
        border-radius: 30px;
        box-shadow: 0 0 30px rgba(0,0,0,.2);
        margin: 20px;
        overflow: hidden;
    }
    .form-box{
        position: absolute;
        right: 0;
        width: 50%;
        height: 100%;
        background:transparent;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        color:#fffcfc;
        text-align: center;
        padding: 8px;
        z-index: 1;
        transition: .6s ease-in-out 1.2s , visibility 0s 1s;
    }

    .container.active .form-box{
         right: 50%;

    }
    .form-box.login{
        visibility: visible;
        transition: .6s ease-in-out 1.2s , visibility 0s 1s;
    }
    .container.active .form-box.login{
        visibility: hidden;
    }

    .form-box.register{
        visibility: hidden;
    }

    .container.active .form-box.register{
        visibility: visible;
        
        
    }
     
    form{
        width: 100%;
    }
    .container h1{
        font-size: 36px; 
        margin: -10px 0; 
    }
    .input-box{
        position: relative;
        margin: 30px 0;
    }
    .input-box input{
        width: 85%;
        padding: 10px;
        font-size: 16px;
        outline: none;
        border: none;
        border-radius: 6px;
        outline: none;
        background: #eee;
        color: #333;
        font-weight: 500;
    }
    .input-box input::placeholder{
        color: #888;
        font-weight: 400;
    }
    .input-box i{
        position: absolute;
        right:30px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-size: 20px;
    }
    .forget-link{
        margin: -15px 0 15px;
    }

    .forget-link a{
        color: #f4f1f1;
        font-size: 14.5px;
        text-decoration: none;
    }
    .forget-link a:hover{
        text-decoration:underline;
        transition: 3s;
    }
    .forget-link a:active{
        color: #333;
    }
    .btn{
        width:90%;
        height: 48px;
        background: #1e55ee;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,.1);
        border: none;
        cursor: pointer;
        font-size: 16px;
        color:#fff;
        font-weight: 600;  
    }
    .btn:hover{
        background: #5a6a97;
        transition: .5s;
    }
    .container p{
        margin: 15px 0;
        font-size: 14.5px;
    } 

    .social-icons{
        display: flex;
        justify-content: center;
    }
    .social-icons a {
        display: inline-flex;
        padding: 10px;
        background: #000000;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 24px;
        color: #fffefe;
        text-decoration: none;
        margin: 0 8px;
    }
    .social-icons a:hover{
        background: #fff;
        color: #000;
        transition: .5s;
    }

    toggle-box{
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgb(255, 0, 255);
    }
    .toggle-box::before{
        content: '';
        position: absolute;
        left: -250%;
        width: 300%;
        height: 100%;
        background: rgb(0, 0, 0);
        border-radius: 150px;
        z-index: 2;
        transition: 1.8s ease-in-out;

    }

    .container.active .toggle-box::before{
        left: 50%;   
    }
    .toggle-panel{
        position: absolute;
        width: 50%;
        height: 100%;
        color: #fff;
        border-radius: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        z-index: 2;
        transition: .6s ease-in-out; 
    }

    .toggle-panel.toggle-left{
        left:0;
        transition-delay: 1.2s;
    }

    .container.active .toggle-panel.toggle-left{
        left: -50%;
        transition-delay: .6s;
    }

    .toggle-panel.toggle-right {
        right: -50% ;
        transition-delay: .6s;
    }
    .container.active .toggle-panel.toggle-right{
        right: 0;
        transition-delay: 1.2s;
    }

    .toggle-panel p{
        margin-bottom:20px;
    }

    .toggle-panel .btn{
        width:160px;
        height: 46px;
        background: transparent;
        border: 2px solid #fff;
        box-shadow: none;
    }

    @media screen and (max-width: 650px){
        .container{
            height: calc(100vh - 20px)  
        }
    }
    .message {
    margin: 20px auto;
    padding: 15px 25px;
    width: 80%;
    text-align: center;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    }

    .message.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .message.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    


</style>
<body>


    <div class="container">
        <div class="form-box login">
            <form action="login.php" method="POST">
                <h1>Login</h1>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="message <?= $_SESSION['type'] ?>">
                    <?= $_SESSION['message'] ?>
                </div>
                <?php
                unset($_SESSION['message']);
                unset($_SESSION['type']);
                unset($_SESSION['from']);
                ?>
                <?php endif; ?>
       

                <div class="input-box">
                    <input type="text" name='username' placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name='password' placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="forget-link">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn" name='login'>Login</button>
                <p>or login with below platforms</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-google'></i></a>
                </div>

            </form>
        </div>

        <div class="form-box register">
            <form action="register.php" method="POST">
                <h1>Registration</h1>
                
                <div class="input-box">
                    <input type="text" name='username' placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name='email' placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name='password' placeholder="Set your password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn" name='register'>Register</button>
                <p>or register with below platforms</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-google'></i></a>
                </div>

            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>
        
    <script>
        const container =document.querySelector('.container');
        const registerBtn = document.querySelector('.register-btn');
        const loginBtn = document.querySelector('.login-btn');

        registerBtn.addEventListener('click', () => {
            container.classList.add('active');
        });
        loginBtn.addEventListener('click', () => {
            container.classList.remove('active');
        });
    </script>
</body>
</html>