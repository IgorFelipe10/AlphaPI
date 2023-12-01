<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

   

    
    <link rel="icon" type="image/png" href="/img/Logo.png"/>
    <link rel="stylesheet" type="text/css" href="/css/index.css" media="screen"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&family=Poppins:wght@600&family=Space+Mono&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./img/Logo.png" type="image/x-icon">

    <title>Alpha</title>
</head>
    <body>
        <header>
            <img src="/img/Logo.png" width="10%"class="logo">                
            </a>
            <ul class="navbar">
                <li><a href="/" class="active">Inicio</a></li>
                <li><a href="/jogos">Nossos jogos</a></li>
                <li>
                <div class="dropdown">
<button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Categorias
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  @foreach(\App\Models\Categoria::all() as $categoria)
    <li>
 <a class="dropdown-item" href="{{route('categoria.show', $categoria->CATEGORIA_ID)}}"> {{$categoria->CATEGORIA_NOME}}</a>
    </li>
    @endforeach
  </ul>
</div>        
                <li><a href="/promocoes">Promoções</a></li>
            </ul>
            @if(!Auth::check())
            <div class="main">
                <form action="../produto" class="d-flex" role="search" method="GET">
                    <input class="form-control me-2" type="text" id="search" name="search"  aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="ri-search-line"></i></button>
                  </form>

                <a href="../login" class="user"><i class="ri-user-fill"></i>Fazer Login</a>


                <a href="../register" class="bxmenu">Criar conta</a>
                <div class="bx bx-menu" id="menu-icon"></div>
            </div>
            @else

            <div class="main">
                <form action="../produto" class="d-flex" role="search" method="GET">
                    <input class="form-control me-2" type="text" id="search" name="search"  aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="ri-search-line"></i></button>
                  </form>

                  <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Olá, {{Auth::user()->USUARIO_NOME}}
                </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                    <a class="dropdown-item"  href="/endereco">Meus Endereços</a>
                        </li>
                        <li>
                    <a class="dropdown-item"  href="/pedido">Meus Pedidos</a>
                        </li>
                        <li>
                    <a class="dropdown-item" href="{{route('usuarios.show', Auth::user()->USUARIO_ID)}}">Ver perfil</a>
                     </li>


                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="buttonsair"onclick="event.preventDefault();this.closest('form').submit();">Sair</button>
                </form>
                <div class="bx bx-menu" id="menu-icon"></div>
            </div>
</ul>

            @endif
        </header>

        <main>@yield('main')</main>

            <footer>

        <div class="wrapper">
            <div class="footer-box">
             <div class="company-footer">

                <img class="logo-yyt-log" src="/img/Logo.png">
              
            </div>
        </div>

        <div class="footer-box">
            <div class="articles-footer">

                <h3>Formas de pagamento</h3>
                <ul class="footer-list footer-article-list">
                    <li>
                        <img class="cardreey" src="/img/cardpix.png">
                    </li>

                    <li>
                        <img class="cardreey" src="/img/cardvisa.png">
                    </li>

                    <li>
                        <img class="cardreey" src="/img/boleto.jpg">
                    </li>
                </ul>
            </div>
        </div>

            <div class="footer-box">
                <h3>Entre em contato</h3>
                <ul class="footer-list">
                    <li>
                        <a href="#">
                            <i class="ri-facebook-box-fill"></i>
                            <span>Alpha</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ri-instagram-line"></i>
                            <span>@Alpha</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ri-youtube-fill"></i>
                            <span>Alpha Videos</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" >
                        <i class="ri-whatsapp-fill"></i>
                        <span>Alpha WhatsApp</span>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    </footer>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
