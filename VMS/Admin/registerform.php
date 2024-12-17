<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden; /* Prevents scrolling to ensure blur effect is consistent */
        }

        .accountbg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('save.png') no-repeat center center;
            background-size: cover;
            filter: blur(8px);
            z-index: -1; /* Ensure it stays behind the form container */
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            position: relative;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container {
            display: flex;
            flex-direction: column;
        }

        .input-name {
            position: relative;
            margin-bottom: 10px;
        }

        .input-name input,
        .input-name select {
            width: 100%;
            padding: 10px 40px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            margin-bottom
        }

        .input-name input[type="radio"] {
            width: auto;
            margin: 0 5px 0 0;
        }

        .input-name label {
            margin-left: 5px;
            font-size: 14px;
            color: #333;
        }

        .input-name .fa {
            position: absolute;
            left: 10px;
            top: 12px;
            color: #aaa;
        }

        .button {
            background-color: #5cb85c;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .button:hover {
            background-color: #4cae4c;
        }

        .input-name .arrow {
            position: absolute;
            right: 10px;
            top: 12px;
            color: #aaa;
        }
        .input-name1{
            display:inline-block;
            padding:5px;
        }
        .cancel-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: transparent;
    border: none;
    color: #34495e;
    font-size: 1.2rem;
    cursor: pointer;
    transition: color 0.3s ease;
}

.cancel-btn:hover {
    color: red;
}
    </style>
    <script>
    function hideLoginPanel() {
            window.history.back(); // This will take the user to the previous page in the browser's history
        } 
    

    </script>
</head>
<body>
    <div class="accountbg"></div>

    <div class="container" id="cont">
    <button class="cancel-btn" onclick="hideLoginPanel()">&#10005;</button>
        <h2>Registration Form</h2>
    
        <div class="form-container">
            <form action="databaseconnect/Insert.php" method="POST">
                
                <div class="input-name">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="First Name" class="name" name="first_name">
                </div>
                <div class="input-name">
                    <i class="fa fa-user"></i>
                    <input type="text" placeholder="Last Name" class="name" name="last_name">
                </div>
                <div class="input-name">
                    <i class="fa fa-envelope"></i>
                    <input type="email" placeholder="Email" class="text-name" name="email">
                </div>
                <div class="input-name">
                    <i class="fa fa-lock"></i>
                    <input type="password" placeholder="Password" class="text-name" name="password">
                </div>
                <div class="input-name">
                    <i class="fa fa-lock"></i>
                    <input type="password" placeholder="Confirm Password" class="text-name" name="confirm_password">
                </div>
                <div class="input-name">
                    <input type="radio" name="gender" value="Male"> <label>Male</label>
                    <input type="radio" name="gender" value="Female"> <label>Female</label>
                </div>
                <div class="input-name">
                    <select class="country" name="country">
                        <option value="">Select a country</option>
                        <option value="Nepal">Nepal</option>
                        <option value="USA">USA</option>
                        <option value="India">India</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Russia">Russia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Pakistan">Pakistan</option>
                    </select>
                </div>
                <div class="input-name1">
                    <input type="checkbox" name="terms">
                    <label>I accept the Terms and Conditions</label>
                </div>
                <div class="input-name">
                    <input type="submit" class="button" value="Register">
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>
