<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container px-5">
        <a class="navbar-brand" href="/profile">This is my City</a>
        <a class="navbar-brand" href="#top">_</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        @csrf <!-- CSRF protection -->
                        <form action="{{route('my.trips')}}" method="GET">
                            @csrf <!-- CSRF protection -->
                            <button type="submit" class="btn btn-link nav-link">
                                My trips <i class="bi bi-cart4"></i>
                            </button>
                        </form>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="{{route('my-cart')}}" method="GET">
                        @csrf <!-- CSRF protection -->
                        <button type="submit" class="btn btn-link nav-link">
                            My Cart <i class="bi bi-cart4"></i>
                        </button>
                    </form>
                </li>
                <li class="nav-item"><form action="{{route('edit-profile')}}" method="GET">
                        @csrf <!-- CSRF protection -->
                        <button type="submit" class="btn btn-link nav-link">Edit</button>
                    </form>
                </li>
                <li class="nav-item"><form action="{{route('logout')}}" method="POST">
                        @csrf <!-- CSRF protection -->
                        <button type="submit" class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
