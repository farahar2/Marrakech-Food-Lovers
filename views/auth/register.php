<?php $pageTitle = 'Inscription — Marrakech Food Lovers'; ?>
<?php require_once 'views/layouts/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="display-4 text-brand mb-3"><i class="bi bi-person-plus-fill"></i></div>
                    <h2 class="fw-bold">Rejoignez-nous !</h2>
                    <p class="text-muted">Créez votre compte et partagez vos recettes.</p>
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

                <form action="index.php?action=register" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label small fw-bold">Nom d'utilisateur</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-control"
                            placeholder="ChefMarrakchi"
                            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                            required
                        >
                    </div>

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

                    <div class="row">
                        <div class="col-md-6 mb-3">
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
                        <div class="col-md-6 mb-4">
                            <label for="confirm" class="form-label small fw-bold">Confirmation</label>
                            <input
                                type="password"
                                id="confirm"
                                name="confirm"
                                class="form-control"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Créer mon compte</button>
                </form>

                <div class="text-center mt-4 pt-3 border-top">
                    <p class="text-muted small mb-0">
                        Déjà un compte ?
                        <a href="index.php?action=login" class="text-brand fw-bold text-decoration-none">Se connecter</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>
