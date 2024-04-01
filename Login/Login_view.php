<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="../css/Login_style.css">
</head>
<body style = "background-color: pink;">
    <div class="loginbox">
        <img src="avatar.jpeg" class="avatar">
        
        <h1>Login Here</h1>
        <form action="" name = "loginForm">
            <p>Username/Email</p>
            <input type="text" id="email" name="email" placeholder="Enter Username/ Email" required>
            
            <p>Password</p>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            
            <input type="submit" value="submit" name="submit" id="submit">
            
            <a href="Register_view.php">Don't have an account? Register</a>
        </form>
    </div>

    <script>
        function validateForm() {
            // Email validation using a regular expression
            var email = document.getElementById("email").value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                alert("Invalid email address");
                return false;
            }

            // Password validation (add your specific requirements)
            var password = document.getElementById("password").value;

            if (password.length < 8) {
                alert("Password must be at least 8 characters");
                return false;
            }
            

            return true;
        }

        document.getElementById('submit').addEventListener('click', function(event) {
            event.preventDefault();

            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../action/login_user_action.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.addEventListener('load', function() {
                var response = JSON.parse(this.responseText);
                if (this.status == 200) {
                    if (response.error) {
                        var errorMessageElement = document.getElementById('errorMessage');
                        alert(response.message);
                    } else {
                        window.location.href = '../view/home_view.php';
                    }
                }
            });

            xhr.send('submit=true&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
        });
    </script>
</body>
</html>

