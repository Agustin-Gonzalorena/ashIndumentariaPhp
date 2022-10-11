<!DOCTYPE html>
<html lang="en">

<head>
  <base href="{BASE_URL}">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <title>TUDAI - TodoList</title>
</head>

<body>
  <header>
    <div class="logo">
      <a href="home">
        <h1>Ash Indumentaria</h1>
      </a>
    </div>
    <div class="container_nav">
      <nav id="nav_mio" class="navbar navbar-expand-lg bg-light">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="home">INICIO</a></li>
            <li class="nav-item"><a class="nav-link" href="allProducts">PRODUCTOS</a></li>
            <li class="nav-item"><a class="nav-link" href="about">QUIENES SOMOS</a></li>
            {if isset($smarty.session.USER_ID)}
              <li class="nav-item"><a class="nav-link" href="adminPage">ADMIN PAGE</a></li>
            {/if}
          </ul>
        </div>
    </div>
    </nav>
    </div>
    <div class="mirror">
      {if !isset($smarty.session.USER_ID)}
        <a href="login">
          <p>Login</p>
        </a>
      {else}
        <a href="logout">
          <p>Logout</p>
        </a>
      {/if}

    </div>
  </header>

  <div class="majorContainer">
<div class="oneContainer">