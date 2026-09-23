<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Certificados Gerscol👨‍⚕️</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="bi bi-list"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4 pt-5">
                <img class="imglogo" src="https://gerscol.com/wp-content/uploads/2021/01/logo-blanco-gerscol-centro-de-capacitacion-en-salud.svg" alt="Gerscol Logo" width="500" height="600">
                <ul class="list-unstyled components mb-5">
                    <ul class="navbar-nav ml-auto">
                        <li class="{{ request()->routeIs('contact') ? 'active' : ''}}">
                            <a href="/busqueda">Descargar certificados</a>
                        </li>
                        @auth
                        @if(auth()->user()->is_admin)
                        <li class="{{ request()->routeIs('students') ? 'active' : ''}}">
                            <a href="/students">Gestionar Estudiantes</a>
                        </li>
                        <li class="{{ request()->routeIs('courses.*') ? 'active' : ''}}">
                            <a href="/courses">Gestionar Cursos</a>
                        </li>
                        <li class="{{ request()->routeIs('certificate') ? 'active' : ''}}">
                            <a href="/certificate">Gestionar Certificados</a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </ul>
                @auth
                <button type="submit" form="logout-form" class="btn btn-logout">
                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                    <span>{{ __('Cerrar sesión') }}</span>
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endauth
                <div class="footer">
                    <p> Todos los derechos reservados &copy; <script>document.write(new Date().getFullYear());</script> <i class="icon-heart" aria-hidden="true"></i> Desarrollado Por: <br> <a href="mailto:miiguellagellmc@gmail.com" target="_blank">Miguel Angel</a></p>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
