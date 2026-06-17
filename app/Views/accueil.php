<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarche – Accueil</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="page-center">

<div class="card">
    <div class="logo">🛒</div>
    <h1>Supermarche</h1>
    <p class="subtitle">Selectionnez votre numero de caisse pour commencer</p>

    <div class="user-info">
        Connecte : <strong><?= esc(session()->get('utilisateur')['nom_utilisateur']) ?></strong>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <form action="/select-caisse" method="POST">
        <?= csrf_field() ?>

        <label class="label-block" for="id_caisse">Numero de caisse</label>
        <select class="select-caisse" name="id_caisse" id="id_caisse" required>
            <option value="" disabled selected>-- Choisir une caisse --</option>
            <?php foreach ($caisses as $caisse): ?>
                <option value="<?= esc($caisse['id_caisse']) ?>">
                    <?= esc($caisse['numero_caisse']) ?>
                    <?php if ($caisse['caissier']): ?>
                        — <?= esc($caisse['caissier']) ?>
                    <?php endif; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ouvrir la caisse →</button>
    </form>

    <p class="caisse-count"><?= count($caisses) ?> caisse(s) disponible(s)</p>

    <div class="footer-links">
        <a href="/full-logout">Se deconnecter</a>
    </div>
</div>

</body>
</html>
