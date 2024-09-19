
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center vh-100 bg-body-secondary ">
        <form action="<?php echo htmlspecialchars('register'); ?>" class=" p-3 w-100" style="max-width:450px"
            method="post">
            <div class="mb-3 text-center container-md">
                <h1><b>Chat !t</b></h1>
                <h4 class="text-body-secondary"><b>Sign Up</b></h4>
            </div>

            <!-- Username -->
            <div class="mb-2 row-cols-1">
                <label for="username" class="col-form-label">Username</label>
                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-username-addon1">@</span>
                        <input type="text" name="username" id="username" class="form-control border-light-subtle"
                            placeholder="username" aria-label="username">
                    </div>
                </div>
                <div class="form-text text-danger fw-semibold text-end" id="helper-text-username"><small><?php echo $usernameErr; ?></small></div>
            </div>

            <!-- First Name -->
            <div class="row">
                <div class="col-md-6">
                    <label for="fName" class="form-label">First Name</label>
                    <!-- input [First Name]-->
                    <input type="text" placeholder="First Name" class="form-control border-light-subtle" name="fName"
                        id="fName">
                    <!-- helper Text -->
                    <div class="form-text text-danger fw-semibold text-end" id="helper-text-fname"><small><?php echo $fNameErr; ?></small></div>
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <!-- input [Last Name]-->
                    <label for="lName" class="form-label">Last Name</label>
                    <input type="text" placeholder="Last Name" class="form-control border-light-subtle" name="lName"
                        id="lName">
                    <!-- helper Text -->
                    <div class="form-text text-danger fw-semibold text-end" id="helper-text-lname"><small><?php echo $lNameErr; ?></small></div>
                </div>
            </div>
            <!-- email -->
            <div class="mb-2 row-cols-1">
                <label for="email" class="col-form-label">Email</label>
                <div class="col-12">
                    <div class="input-group">
                        <input type="email" id="email" name="email" class="form-control border-light-subtle"
                            placeholder="example@example.com" aria-label="email" aria-describedby="basic-addon1">
                        <!-- <span class="input-group-text" id="basic-email-addon1">@gmail.com</span> -->
                    </div>
                </div>
                <!-- <div class="form-text" id="basic-addon4">Example help text goes outside the input group.</div> -->
                <div class="form-text  text-danger fw-semibold text-end" id="helper-text-email"><small><?php echo $emailErr; ?></small></div>
            </div>

            <!-- Password -->
            <div class="mb-1 row-cols-1">
                <label for="password" class="col-form-label col-auto">Password</label>
                <div class="input-group col-12">
                    <input type="password" name="password" id="password" placeholder="Password" aria-label="password"
                        class="form-control border-light-subtle">
                    <button onclick="passwordToggle(this)" class="btn  btn-light text-primary" type="button"
                        id="button-addon2">show</button>
                </div>
                <div class="form-text  text-danger fw-semibold text-end" id="helper-text-password"><small><?php echo $passwordErr; ?></small></div>
            </div>


            <!-- Confirm Password -->
            <div class="mb-5     row-cols-1">
                <label for="cpassword" class="col-form-label col-auto">Confirm Password</label>
                <div class="col-12"><input type="password" placeholder="Confirm Password" name="cpassword"
                        id="cpassword" class="form-control border-light-subtle"></div>
                <div class="form-text  text-danger fw-semibold text-end" id="helper-text-cpassword"><small><?php echo $cpasswordErr; ?></small></div>

            </div>

            <!-- Submit Button -->
            <button type="submit" name="submit" value="submit"
                class="container-fluid btn btn-primary rounded mb-2">Register</button>
            <p class="text-center">Already have an account ? <a href="./login"
                    class="link-primary link-underline-opacity-0">Login</a></p>
        </form>
    </div>
    <script type="text/javascript">
        function passwordToggle(label) {
            const passwordEle = document.getElementById('password');
            console.log(label);
            if (passwordEle.type == 'password') {
                passwordEle.type = 'text';
                label.innerText = 'hide';
            } else {
                passwordEle.type = 'password';
                label.innerText = 'show';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>