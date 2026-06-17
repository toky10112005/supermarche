<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarché – Accueil</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.1);
            padding: 40px 36px;
            width: 100%;
            max-width: 440px;
            text-align: center;
        }

        .logo { font-size: 2.5rem; margin-bottom: 8px; }

        h1 {
            font-size: 1.5rem;
            color: #222;
            margin-bottom: 4px;
        }

        .subtitle {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 28px;
        }

        .user-info {
            background: #f0f2f5;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 20px;
            font-size: 0.88rem;
            color: #555;
        }

        label {
            display: block;
            text-align: left;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        select {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #333;
            background: #f9f9f9;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23666' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            cursor: pointer;
            transition: border-color 0.2s;
            margin-bottom: 20px;
        }

        select:focus {
            outline: none;
            border-color: #0f3460;
            background-color: #fff;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #0f3460;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover { background: #1a4a8a; }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #ffbdbd;
            color: #c0392b;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 0.88rem;
        }

        .footer-links {
            margin-top: 20px;
            font-size: 0.85rem;
        }

        .footer-links a {
            color: #c0392b;
            text-decoration: none;
        }

        .footer-links a:hover { text-decoration: underline; }

        .caisse-count {
            margin-top: 16px;
            color: #aaa;
            font-size: 0.82rem;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="logo">🛒</div>
    <h1>Supermarché</h1>
    <p class="subtitle">Sélectionnez votre numéro de caisse pour commencer</p>

    <div class="user-info">
        Connecté : <strong><?= esc(session()->get('utilisateur')['nom_utilisateur']) ?></strong>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <form action="/select-caisse" method="POST">
        <?= csrf_field() ?>

        <label for="id_caisse">Numéro de caisse</label>
        <select name="id_caisse" id="id_caisse" required>
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
        <a href="/full-logout">Se déconnecter</a>
    </div>
</div>

</body>
</html>
