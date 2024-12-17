



<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>VSMS | Forget Password</title>
    </head>
    <link rel="stylesheet" href="forget.css">
    <script>
    function hideLoginPanel() {
            window.history.back(); // This will take the user to the previous page in the browser's history
        } 
    

    </script>

    <body class="account-pages">

        <!-- Begin page -->
        <div class="accountbg" style="background: url('save.png');background-size: cover;background-position: center;"></div>

        <div class="wrapper-page account-page-full">

            <div class="card">
            <button class="cancel-btn" onclick="hideLoginPanel()">&#10005;</button>
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box p-5">
                            <h3 class="text-uppercase text-center pb-4">
                                    <span>VSMS | Recover Password</span>
                             
                            </h3>

                            <form action="resetpasword.php" name="login" method="post">

                                <div class="form-group m-b-20 row">
                                    <div class="col-12">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="email" name="email" required="" placeholder="Registered Email">
                                    </div>
                                </div>

                                  <div class="form-group m-b-20 row">
                                    <div class="col-12">
                                        <label for="emailaddress">Last Name</label>
                                        <input class="form-control" type="text" id="lastname" name="lastname" required="" placeholder="Enter Your Last Name">
                                    </div>
                                </div>

                                <div class="form-group row text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" type="submit" name="submit">Reset</button>
                                    </div>
                                </div>

                            </form>

                            <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">Don't have an account? <a href="registerform.php" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="account-copyright">Copyright © 2020</p>
            </div>

        </div>

    </body>
</html>
