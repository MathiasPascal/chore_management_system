<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Registration Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Register_style.css">
</head>
<body>

    <div class="container">
        <div class="title"> Registration</div>
        <form action="#" method="post" name="registrationForm" id="registrationForm" onsubmit="return validateForm()">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">First Name</span>
                    <input type="text" placeholder="Enter your first name" name="firstName" id="firstName" required>
                </div>
                <div class="input-box">
                    <span class="details">Last Name</span>
                    <input type="text" placeholder="Enter your last name" name="lastName" id="lastName" required>
                </div>
                <div class="input-box">
                    <span class="details">Date of Birth</span>
                    <input type="date" placeholder="Enter your birth date" name="dob" id="dob" required>
                </div>
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="tel" placeholder="Enter your contact number" name="phoneNumber" id="phoneNumber" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" placeholder="Enter your email" name="email" id="email" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" placeholder="Enter your password" name="password" id="password" required>
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" placeholder="Confirm your password" name="confirmPassword" id="confirmPassword" required>
                </div>
                <div class="input-box">
                    <span class = family_role>Family Role</span>
                    <select name="familyRole" id="familyRole" required>
                        <option value="">Select yur role</option>
                        <?php
                        include '../functions/select_role_fxn.php'; // Include the function file to call the function 'selectRoleDropdown()
                         echo selectRoleDropdown(); ?>
                    </select>
                        
                </div>
            </div>
            
            <div class="gender-details">
                <span class="gender-title">Gender</span>
                <div class="category">
                    <label for="male">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                        <input type="radio" name="gender" id="male" value="Male" required>
                    </label>
                    <label for="female">
                        <span class="dot one"></span>
                        <span class="gender">Female</span>
                        <input type="radio" name="gender" id="female" value="Female" required>
                    </label>
                </div>
            </div>

            <div class="button">
                <input type="submit" value="Register">
            </div>
            <a href="Login_view.php">Already have an account? Login</a>

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

            // Phone number validation using a regular expression
            var phoneNumber = document.getElementById("phoneNumber").value;
            var phoneRegex = /^\d{10}$/;

            if (!phoneRegex.test(phoneNumber)) {
                alert("Invalid phone number. Please enter 10 digits.");
                return false;
            }

            // Password and confirm password validation
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }

            return true;
        }document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            fetch('../action/register_user_action.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = 'Login_view.php';
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>
</html>
