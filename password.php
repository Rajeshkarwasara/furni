<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Input Toggle</title>
    <style>
        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

       
    </style>
</head>

<body>

    <?php
    // You can use PHP for your form processing logic here.
    ?>

    <div class="password-container">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span class="password-toggle" onclick="togglePassword()">Show</span>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var passwordToggle = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                passwordToggle.textContent = 'Show';
            }
        }
    </script>

</body>

</html>