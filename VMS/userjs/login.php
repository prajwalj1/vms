<!--  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
  
          <div class="rens" id="vsms">
            
                <h4>Vechile Service Management System</h4>
                <div class="button-container">
                    <button class="au" onclick="showLoginPanel()">User</button>
                    <button class="au" onclick="showAdminPanel()">Admin</button>
                </div>
             </div>
                
    
             <div id="whole">
        <div class="login">
            <h1 class="headline">Welcome to the User Pannel</h1>
        </div>
        <form id="dynamicForm" action="#" method="POST">

            <div class="infos">
            <button class="cancel-btn" onclick="hideLoginPanel()">&#10005;</button>

                <b style="font-family:arial">EMAIL:</b>  <input class="text" type="email" placeholder="Email" name="email" required> 
                <b style="font-family:arial">PASSWORD:</b><input class="password" type="password" placeholder="Password" name="password" autocomplete="current-password" required > 
                <button class="btn" name="button">Sign In</button>
                <input type="hidden" name="is_admin" id="isAdmin" value="0">
                <a class="forgot" href="forget.php">forgot Password?</a>
            </div>
            <div class="sesss">
           
        <p>If you don’t have an account, you can create one by clicking the link below:</p>
        <a href="registerform.php">Create an Account</a> 
            </div>
        </form>









        <script src="script.js"></script>
    </div>
</body>
</html>  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Service Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Main Panel -->
    <div class="rens" id="vsms">
        <h4>Vehicle Service Management System</h4>
        <div class="button-container">
            <button class="au" onclick="showLoginPanel()">User</button>
            <button class="au" onclick="showAdminPanel()">Admin</button>
        </div>
    </div>

    <!-- Login Form -->
    <div id="whole">
        <div class="login">
            <h1 class="headline">Welcome to the User Panel</h1>
        </div>
        <form id="dynamicForm" action="#" method="POST">
            <div class="infos">
                <button class="cancel-btn" onclick="hideLoginPanel(event)">&#10005; </button>
                <b style="font-family:arial">EMAIL:</b>
                <input class="text" type="email" placeholder="Email" name="email" required>
                <b style="font-family:arial">PASSWORD:</b>
                <input class="password" type="password" placeholder="Password" name="password" autocomplete="current-password" required>
                <button class="btn" name="button">Sign In</button>
                <input type="hidden" name="is_admin" id="isAdmin" value="0"> <!-- Hidden field to track panel type -->
                <a class="forgot" href="forget.php">Forgot Password?</a>
            </div>
            <div class="sesss">
                <p>If you don’t have an account, you can create one by clicking the link below:</p>
                <a href="registerform.php">Create an Account</a>
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
