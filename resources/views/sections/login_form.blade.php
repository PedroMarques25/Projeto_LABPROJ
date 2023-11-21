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
                    <form id="loginForm" method="POST" action="{{ route('user.login') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email_login" name="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <!-- Password input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password_login" name="password" type="password" placeholder="******" data-sb-validations="required" />
                            <label for="password">Password</label>
                            <div class="invalid-feedback" data-sb-feedback="password:required">Password is required.</div>
                        </div>
                        <!-- Submit Button-->
                        <div class="row">
                            <div class="col">
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" id="submitButton1" type="submit">Login</button>
                                </div>
                            </div>
                            <p class="lead fw-normal text-muted mb-0">
                                ...
                            </p>
                            <div class="col">
                                <a href="/signin">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg" id="submitButton2" type="submit" >Sign in</button>
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
