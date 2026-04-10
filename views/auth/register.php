<?php $pageTitle = 'Inscription — Marrakech Food Lovers'; ?>
<?php require_once 'views/layouts/header.php'; ?>

<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Rejoignez-nous !</h1>
            <p>Créez votre compte et commencez à partager vos recettes.</p>
        </div>

        <form action="index.php?action=register" method="POST" class="form" novalidate>
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="ChefMarrakchi"
                    value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                    required
                >
            </div>

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
                    placeholder="Minimum 6 caractères"
                    required
                >
            </div>

            <div class="form-group">
                <label for="confirm">Confirmer le mot de passe</label>
                <input
                    type="password"
                    id="confirm"
                    name="confirm"
                    placeholder="Répétez le mot de passe"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary btn-full">Créer mon compte</button>
        </form>

        <p class="auth-switch">
            Déjà un compte ?
            <a href="index.php?action=login">Se connecter</a>
        </p>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>
