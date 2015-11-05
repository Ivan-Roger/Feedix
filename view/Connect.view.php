<?php if(!isset($data)) header("Location".".."); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Connexion</title>
    <link href="../data/css/bootstrap.css" rel="stylesheet">
  </head>
  <style type="text/css">
     [class*="col"] { margin-bottom: 20px; }
     body { margin-top: 10px;
            margin:0
            padding:0;
          }

      header {
        background-color: #00C0F0;
      }
      header h1 {
        color: white;
        text-align: center;
        font-weight:bold;
        text-shadow:
      #000000 1px 1px,
      #000000 -1px 1px,
      #000000 -1px -1px,
      #000000 1px -1px;
        font-size: 70px;
      }
      footer p {
        text-align: center;
      }
  </style>
  <body>
    <header class="page-header">
      <h1>Feedix - Connexion</h1>
      <nav class="navbar">
        <div class="col-lg-4 col-lg-offset-8">
          <a class="btn btn-primary btn-lg" href="..">Home</a>
        </div>
      </nav>
    </header>
    <section>
      <?php if (isset($data['error'])) echo("<p class='alert alert-danger'>".$data['error']."</p>") ?>
      <article class="col-lg-6">
        <h2>Connexion</h2>
        <form action="seConnecter.ctrl.php" method="POST" class="form-horizontal">
          <input name="action" type="hidden" value="connect">
          <div class="form-group">
            <label for="login-user" class="col-sm-2 control-label">Utilisateur</label>
            <div class="col-sm-6"><input type="text" required id="login-user" name="user" class="form-control"></div>
          </div>
          <div class="form-group">
            <label for="login-password" class="col-sm-2 control-label">Mot de passe</label>
            <div class="col-sm-6"><input type="password" required id="login-password" name="pass" class="form-control"></div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
              <input class="btn btn-info" type="submit" value="Connexion"/>
            </div>
          </div>
        </form>
      </article>
      <article class="col-lg-6">
        <h2>Inscription</h2>
        <form action="seConnecter.ctrl.php" method="POST" class="form-horizontal">
          <p id="connectInfo"></p>
          <input name="action" type="hidden" value="signIn">
          <div class="form-group">
            <label for="signIn-user" class="col-sm-2 control-label">Utilisateur</label>
            <div class="col-sm-6"><input type="text" required id="signIn-user" name="user" class="form-control"></div>
          </div>
          <div class="form-group">
            <label for="signIn-password" class="col-sm-2 control-label">Mot de passe</label>
            <div class="col-sm-6"><input type="password" required id="signIn-password" name="pass" class="form-control"></div>
          </div>
          <div class="form-group">
            <label for="signIn-password" class="col-sm-2 control-label">Confirmation</label>
            <div class="col-sm-6"><input type="password" required id="signIn-password" name="pass2" class="form-control"></div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
              <input class="btn btn-info" type="submit" value="Inscription"/>
            </div>
          </div>
        </form>
      </article>
    </section>
    <footer>
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
