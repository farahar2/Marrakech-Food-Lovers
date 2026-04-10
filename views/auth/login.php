<?php $pageTitle = 'Connexion — Marrakech Food Lovers'; ?>
<?php require_once 'views/layouts/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="display-4 text-brand mb-3"><i class="bi bi-person-circle"></i></div>
                    <h2 class="fw-bold">Bon retour !</h2>
                    <p class="text-muted">Connectez-vous pour gérer vos recettes.</p>
                </div>

                <!-- ── Flash message ──────────────────────────────────────── -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger border-0 small mb-4">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="index.php?action=login" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-bold">Adresse email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="vous@exemple.com"
                            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label small fw-bold">Mot de passe</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Se connecter</button>
                </form>

                <div class="text-center mt-4 pt-3 border-top">
                    <p class="text-muted small mb-0">
                        Pas encore de compte ?
                        <a href="index.php?action=register" class="text-brand fw-bold text-decoration-none">Créer un compte</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>
