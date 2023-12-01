<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/cadastro.css">
    <title>Alpha</title>
    <script>

function semLetra(a){
  var x= a.which || e.keycode;
  if ((x>=48 && x<=57) || (x==44))
  {
    return true;
  }else{
    return false;
  }
}

      
</script>

</head>
<body>

<div>
<header>
    <img src="./img/Logo.png" alt="" class="logo-yyt-log">
</header>
<form method="POST" action="{{ route('register') }}">

    @csrf
    <div class="login">

        <h1>Cadastro</h1>
        <div>
            <label for="nome">Nome</label>
            <input class="inputLogin" type="text" placeholder="Digite seu nome" id="name" name="name" required>
        </div>

        <div>
        
            <label for="nome">Email</label>
            <input class="inputLogin" type="email" id="email" name="email" placeholder="Digite seu email" required> 
        </div>

        <div>

            <label for="senha">Senha</label>
            <input class="inputLogin" type="password" name="password" placeholder="Senha" required>
</div>

        <div>
            <label for="CPF">CPF</label>
            <input class="inputLogin" id="cpf" class="block mt-1 w-full" type="text" minlength="11" maxlength="11" onkeypress="return semLetra(event)" name="cpf"/>
        </div>

        <button class="buttonLogin" >{{ __('Cadastrar') }}</button>

        <p id="texto">Você já tem uma conta? <a href="/login" class="loginHref">Fazer login</a></p>
        </div>
        

    </div>
</div>
</body>
</html>
