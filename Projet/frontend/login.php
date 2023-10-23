<?php require_once('header.html') ?>

    <div class="login-form-container">
        <h2>Login</h2>
        <form id="login-form">
            <div class="form-group">
                <label for="username">Login:</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre login" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
