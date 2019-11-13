<?php 
  require "navigation.php";
?>

<main>

<section>
        <div>
            <div class="container signup-container">
                <div class="shadow p-3 mb-5 bg-white rounded">
                    <div class="col-sm-6 offset-sm-3 text-center">
                        <h1 class="display-4">Signup</h1>
                        <div>
                            <form action="functional/signup_functional.php" class="form justify-content-center" method="post">
                                <div class="form-group row">
                                    <label>Your Account Name</label>
                                    <input type="text" class="form-control signup-input-sizing" name="acctName" placeholder="Account Name">
                                </div>
                                <div class="form-group row">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="pwd" placeholder="Password">
                                </div>
                                <div class="form-group row">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm-pwd" placeholder="Please confirm your password">
                                </div>
                                <button type="submit" class="btn btn-primary" name="signup">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php 
  require "footer.php";
?>