<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarche – Connexion</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="page-center">

<div class="card">
    <div class="logo">🛒</div>
    <h1>Supermarche</h1>
    <p class="subtitle">Connectez-vous pour acceder au systeme</p>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <form action="/login" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nom_utilisateur">Nom d'utilisateur</label>
            <input type="text" name="nom_utilisateur" id="nom_utilisateur" required autofocus>
        </div>

        <div class="form-group">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" required>
        </div>

        <button type="submit">Se connecter</button>
    </form>
</div>

</body>
</html>
