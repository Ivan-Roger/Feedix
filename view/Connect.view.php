<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Feedix - Connexion</title>
    <link rel="stylesheet" href="../view/style.css"/>
  </head>
  <body>
    <header>
      <h1>Feedix - Connexion</h1>
    </header>
    <section>
      <a href="..">Home</a><br/>
      <?php if (isset($data['error'])) echo("<p>".$data['error']."</p>") ?>
      <article>
        <h2>Connexion</h2>
        <form action="seConnecter.ctrl.php" method="POST">
          <input name="action" type="hidden" value="connect">
          <input required name="user" type="text" placeholder="Utilisateur"/>
          <input required name="pass" type="password" placeholder="Mot de passe"/>
          <input type="submit" value="Connexion"/>
        </form>
      </article>
      <article>
        <h2>Inscription</h2>
        <form action="seConnecter.ctrl.php" method="POST" onsubmit="return validate();">
          <p id="connectInfo"></p>
          <input name="action" type="hidden" value="signIn">
          <input required name="user" type="text" placeholder="Utilisateur"/>
          <input required name="pass" type="password" placeholder="Mot de passe"/>
          <input required name="pass2" type="password" placeholder="Confirmation mot de passe"/>
          <input type="submit" value="Inscription"/>
        </form>
      </article>
    </section>
    <footer>
      <hr/>
      <p>Made by Ivan ROGER and Maxime GERMAIN<br/>2015</p>
    </footer>
  </body>
</html>
