<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarché – Connexion</title>
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
            max-width: 400px;
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

        .form-group {
            margin-bottom: 16px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #333;
            background: #f9f9f9;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0f3460;
            background: #fff;
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
            margin-top: 4px;
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
    </style>
</head>
<body>

<div class="card">
    <div class="logo">🛒</div>
    <h1>Supermarché</h1>
    <p class="subtitle">Connectez-vous pour accéder au système</p>

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
