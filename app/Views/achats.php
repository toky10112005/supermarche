<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie des achats – <?= esc($caisse['numero_caisse']) ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="topbar">
    <div class="brand"> Supermarche</div>

    <div class="caisse-badge">
        <?= esc($caisse['numero_caisse']) ?>
        <?php if ($caisse['caissier']): ?>
            · <?= esc($caisse['caissier']) ?>
        <?php endif; ?>
    </div>

    <div class="topbar-actions">
        <a href="/logout" class="btn-link">Changer de caisse</a>
        <a href="/full-logout" class="btn-link">Deconnexion</a>
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
                        <option value="" disabled selected>-- Selectionner --</option>
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
                    <label for="quantite">Quantite</label>
                    <input type="number" name="quantite" id="quantite" min="1" value="1" required>
                </div>

                <button type="submit" class="btn-add">Enregistrer l'achat</button>
            </form>

            <form action="/achats/cloturer" method="POST" onsubmit="return confirm('Cloturer cet achat ? La liste sera videe pour le prochain client.');">
                <?= csrf_field() ?>
                <button type="submit" class="btn-cloturer">Cloturer achat</button>
            </form>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">Achats en cours – <?= esc($caisse['numero_caisse']) ?></div>
        <div class="panel-body no-padding">
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
                                <th>Qte</th>
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
                                    <td class="text-date"><?= esc($achat['date_achat']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="tfoot-row">
                                <td colspan="4" class="text-right">TOTAL</td>
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
