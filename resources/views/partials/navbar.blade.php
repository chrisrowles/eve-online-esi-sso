<nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-none py-2">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            SAKAGAMI
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto gap-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mail.mailbox') }}">
                        <i class="fas fa-envelope me-1"></i>
                        EVEMail
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                @_esi_authenticated
                    @_esi_corporate_access
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="corporate_management" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-star me-1"></i> {{ session('character.corporation')->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="corporate_management">
                                <a class="dropdown-item nav-item" href="{{ route('corporation.dashboard') }}">Dashboard</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item nav-item" href="{{ route('corporation.applications') }}">Applications</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item nav-item" href="{{ route('corporation.contracts') }}">Contracts</a>
                                <a class="dropdown-item nav-item" href="{{ route('corporation.finances') }}">Finances</a>
                                <a class="dropdown-item nav-item" href="{{ route('corporation.orders') }}">Orders</a>
                            </div>
                        </li>
                    @end_esi_corporate_access
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="esi_auth_menu" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img alt="portrait" class="ms-2 rounded border border-dark" src="{{ session('character.portrait') }}" width="36">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="esi_auth_menu">
                            <span class="dropdown-item nav-item">
                                {{ session('character.name') }}
                            </span>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item nav-item" href="{{ route('esi.sso.logout') }}">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('esi.sso.login') }}">
                            <img class="img-fluid" src="{{ asset('images/eve-sso-login.png') }}" alt="">
                        </a>
                    </li>
                @end_esi_authenticated
                    <li class="nav-item">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="toggle-dark-mode">
                            <label class="form-check-label" for="toggle-dark-mode">
                                <i class="fas fa-moon text-warning"></i>
                            </label>
                        </div>
                    </li>
            </ul>
        </div>
    </div>
</nav>
