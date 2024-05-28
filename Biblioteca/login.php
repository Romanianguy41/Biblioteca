<?php include 'inc_header.php' ?>

<main>
<title>login</title>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center vh-100">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-0">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Accesso</h3>
                                </div>
                                <div class="card-body">
                                    <form action="accesso_ok.php" method="post">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputEmail" type="email" placeholder="Enter your email" />
                                                    <label for="inputEmail">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPass" type="password" placeholder="Enter your password" />
                                                    <label for="inputPass">Password</label>
                                                </div>
                                            </div>
                                            <div class="error-message"></div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary btn-block" value="Accedi">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="registrazione.php">Non sei registrato? Registrati ora</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</main>

<?php include 'inc_footer.php' ?>
