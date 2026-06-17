<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie des achats – <?= esc($caisse['numero_caisse']) ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
        }

        .topbar {
            background: #0f3460;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .topbar .brand {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .topbar .caisse-badge {
            background: rgba(255,255,255,0.15);
            border-radius: 20px;
            padding: 5px 16px;
            font-size: 0.88rem;
            font-weight: 600;
        }

        .topbar-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .topbar .btn-link {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            color: #fff;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.82rem;
            text-decoration: none;
            transition: background 0.2s;
        }

        .topbar .btn-link:hover { background: rgba(255,255,255,0.25); }

        .container {
            max-width: 1000px;
            margin: 24px auto;
            padding: 0 16px;
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 20px;
        }

        .panel {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .panel-header {
            background: #0f3460;
            color: #fff;
            padding: 14px 18px;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .panel-body { padding: 18px; }

        .form-group { margin-bottom: 14px; }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #444;
            margin-bottom: 5px;
            font-size: 0.88rem;
        }

        .form-group select,
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 0.92rem;
            color: #333;
            background: #f9f9f9;
            transition: border-color 0.2s;
        }

        .form-group select:focus,
        .form-group input:focus {
            outline: none;
            border-color: #0f3460;
            background: #fff;
        }

        .btn-add {
            width: 100%;
            padding: 11px;
            background: #0f3460;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-add:hover { background: #1a4a8a; }

        .btn-cloturer {
            width: 100%;
            padding: 11px;
            background: #c0392b;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }

        .btn-cloturer:hover { background: #a93226; }

        .alert {
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 14px;
            font-size: 0.86rem;
            font-weight: 500;
        }

        .alert-success { background: #edfdf4; border: 1px solid #a3e6c0; color: #1a7a4a; }
        .alert-error   { background: #fff0f0; border: 1px solid #ffbdbd; color: #c0392b; }

        .table-wrapper { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88rem;
        }

        thead th {
            background: #f0f2f5;
            color: #555;
            padding: 10px 14px;
            text-align: left;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e8e8e8;
        }

        tbody td {
            padding: 11px 14px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #fafbff; }

        .amount { font-weight: 600; color: #0f3460; }

        .tfoot-row td {
            padding: 12px 14px;
            border-top: 2px solid #e0e0e0;
            font-weight: 700;
            font-size: 0.95rem;
            color: #0f3460;
        }

        .empty-state {
            text-align: center;
            padding: 32px 16px;
            color: #aaa;
            font-size: 0.88rem;
        }

        .badge-qty {
            display: inline-block;
            background: #e8f0ff;
            color: #0f3460;
            border-radius: 4px;
            padding: 2px 8px;
            font-weight: 600;
            font-size: 0.82rem;
        }

        @media (max-width: 760px) {
            .container { grid-template-columns: 1fr; }
            .topbar { justify-content: center; text-align: center; }
        }
    </style>
</head>
<body>

<div class="topbar">
    <div class="brand">🛒 Supermarché</div>

    <div class="caisse-badge">
        <?= esc($caisse['numero_caisse']) ?>
        <?php if ($caisse['caissier']): ?>
            · <?= esc($caisse['caissier']) ?>
        <?php endif; ?>
    </div>

    <div class="topbar-actions">
        <a href="/logout" class="btn-link">Changer de caisse</a>
        <a href="/full-logout" class="btn-link">Déconnexion</a>
    </div>
</div>

<div class="container">

    <div class="panel">
        <div class="panel-header">Ajouter un achat</div>
        <div class="panel-body">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <form action="/achats/add" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="id_produit">Produit</label>
                    <select name="id_produit" id="id_produit" required>
                        <option value="" disabled selected>-- Sélectionner --</option>
                        <?php foreach ($produits as $p): ?>
                            <option value="<?= esc($p['id_produit']) ?>">
                                <?= esc($p['designation']) ?>
                                (<?= number_format($p['prix'], 0, ',', ' ') ?> Ar)
                                — stock : <?= esc($p['quantite_stock']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="number" name="quantite" id="quantite" min="1" value="1" required>
                </div>

                <button type="submit" class="btn-add">Enregistrer l'achat</button>
            </form>

            <form action="/achats/cloturer" method="POST" onsubmit="return confirm('Clôturer cet achat ? La liste sera vidée pour le prochain client.');">
                <?= csrf_field() ?>
                <button type="submit" class="btn-cloturer">Clôturer achat</button>
            </form>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">Achats en cours – <?= esc($caisse['numero_caisse']) ?></div>
        <div class="panel-body" style="padding:0;">
            <?php if (empty($achats)): ?>
                <div class="empty-state">Aucun achat en cours.</div>
            <?php else: ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produit</th>
                                <th>Prix unit.</th>
                                <th>Qté</th>
                                <th>Total</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($achats as $i => $achat): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($achat['designation']) ?></td>
                                    <td><?= number_format($achat['prix'], 0, ',', ' ') ?> Ar</td>
                                    <td><span class="badge-qty"><?= esc($achat['quantite']) ?></span></td>
                                    <td class="amount"><?= number_format($achat['total'], 0, ',', ' ') ?> Ar</td>
                                    <td style="color:#888;font-size:0.8rem;"><?= esc($achat['date_achat']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="tfoot-row">
                                <td colspan="4" style="text-align:right;">TOTAL</td>
                                <td><?= number_format($totalGeneral, 0, ',', ' ') ?> Ar</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>
