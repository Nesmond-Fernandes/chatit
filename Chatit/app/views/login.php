<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center vh-100  bg-body-secondary">
        <form action="<?php echo htmlspecialchars('login'); ?>" class=" p-3 w-100" style="max-width:450px"
            method="post">
            <div class="mb-3 text-center">
                <h1><b>Chat !t</b></h1>
                <h4 class="text-body-secondary"><b>Sign In</b></h4>
            </div>

            <!-- Username -->
            <!-- <div class="mb-1 row-cols-1">
                <label for="username" class="col-form-label">Username</label>
                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-username-addon1">@</span>
                        <input minlength="3" maxlength="50" type="text" name="username" id="username"
                            class="form-control border-light-subtle " placeholder="username" aria-label="username"
                            >
                    </div>
                </div>
                <div class="form-text  text-danger fw-semibold text-end" id="helper-text-username"><small><?php echo $usernameErr; ?></small></div>
            </div> -->

            <!-- email -->
            <div class="mb-1 row-cols-1">
                <label for="email" class="col-form-label">Email</label>
                <div class="col-12">
                    <div class="input-group">
                        <input type="email" id="email" name="email" class="form-control border-light-subtle"
                            placeholder="example@example.com" aria-label="email" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="form-text  text-danger fw-semibold text-end" id="helper-text-email"><small><?php echo $emailErr; ?></small></div>

                <!-- <div class="form-text" id="basic-addon4">Example help text goes outside the input group.</div> -->
            </div>

            <!-- Password -->
            <div class="mb-4 row-cols-1">
                <label for="password" class="col-form-label col-auto">Password</label>
                <div class="input-group col-12">
                    <input maxlength="16" type="password" name="password" id="password" placeholder="Password" aria-label="password"
                        class="form-control  border-light-subtle">
                    <button onclick="passwordToggle(this)" class="btn  btn-light text-primary" type="button"
                        id="button-addon2">show</button>
                </div>
                <div class="form-text  text-danger fw-semibold text-end" id="helper-text-password"><small><?php echo $passwordErr; ?></small></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="submit" value="submit"
                class="container-fluid btn btn-primary rounded mb-2">Login</button>
            <p class="text-center">Don't have an account ? <a href="./register"
                    class="link-primary link-underline-opacity-0">Register</a></p>
        </form>
    </div>
    <script>
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