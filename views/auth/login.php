<?php $pageTitle = 'Connexion — Marrakech Food Lovers'; ?>
<?php require_once 'views/layouts/header.php'; ?>

<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Bon retour !</h1>
            <p>Connectez-vous pour accéder à vos recettes.</p>
        </div>

        <form action="index.php?action=login" method="POST" class="form" novalidate>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="vous@exemple.com"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary btn-full">Se connecter</button>
        </form>

        <p class="auth-switch">
            Pas encore de compte ?
            <a href="index.php?action=register">Créer un compte</a>
        </p>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>
