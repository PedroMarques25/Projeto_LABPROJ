<section class="py-5">
    <div class="container px-5">
        <!-- Contact form-->
        <div class="bg-light rounded-4 py-5 px-4 px-md-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                <h1 class="fw-bolder">Welcome!</h1>
                <p class="lead fw-normal text-muted mb-0">We have the perfect route for you</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form id="loginForm" method="POST" action="{{ route('signin') }}">
                        @csrf
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" name="name" type="text" placeholder="name" data-sb-validations="required,name" />
                            <label for="name">Name</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">An name is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="name:name">Name is not valid.</div>
                        </div>
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <!-- Password address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password" name="password" type="password" placeholder="******" required />
                            <label for="password">Password</label>
                            <div class="invalid-feedback" data-sb-feedback="password:required">Password is required.</div>
                            <!-- Add other validation error messages as needed -->
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="******" required />
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="invalid-feedback" data-sb-feedback="password_confirmation:required">Password confirmation is required.</div>
                            <!-- Add other validation error messages as needed -->
                        </div>
                        <!-- Submit Button-->
                        <div class="row">
                            <div class="col">
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" id="submitButton1" type="submit">Create account</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
