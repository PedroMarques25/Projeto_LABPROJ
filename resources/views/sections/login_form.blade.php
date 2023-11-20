<section class="py-5">
    <div class="container px-5">
        <!-- Contact form-->
        <div class="bg-light rounded-4 py-5 px-4 px-md-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                <h1 class="fw-bolder">Welcome back</h1>
                <p class="lead fw-normal text-muted mb-0">We have the perfect route for you</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form id="loginForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <!-- Password address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="password" placeholder="******" data-sb-validations="required,email" />
                            <label for="email">Password</label>
                            <div class="invalid-feedback" data-sb-feedback="password:required">Password is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="password:password">Password is not valid.</div>
                        </div>
                        <!-- Submit success message-->
                        <!---->
                        <!-- This is what your users will see when the form-->
                        <!-- has successfully submitted-->
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <!---->
                        <!-- This is what your users will see when there is-->
                        <!-- an error submitting the form-->
                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                        <!-- Submit Button-->
                        <div class="row">
                            <div class="col">
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg disabled" id="submitButton1" type="submit">Login</button>
                                </div>
                            </div>
                            <p class="lead fw-normal text-muted mb-0">
                                ...
                            </p>
                            <div class="col">
                                <a href="/signin">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg disabled" id="submitButton2" type="submit" >Sign in</button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
