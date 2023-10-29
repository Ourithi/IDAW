<?php require_once('header.html') ?>

    <div class="login-form-container">
        <h2>Créer un compte</h2>
        <form id="login-form">
            <div class="form-group">
                <label for="username">Login:</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre login" required>
            </div>
            <div class="form-group">
                <label for="taille">Taille (cm):</label>
                <input type="number" id="taille" name="taille" placeholder="Entrez votre taille" required>
            </div>
            <div class="form-group">
                <label for="poids">Poids (kg):</label>
                <input type="number" id="poids" name="poids" placeholder="Entrez votre age" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Entrez votre poids" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <select name="genre" id="genre">
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="form-group">
                <label for="activite">Fréquence d'exercice:</label>
                <select name="activite" id="activite">
                    <option value="1">Pas ou peu d'exercice</option>
                    <option value="2">1 à 3 fois par semaine</option>
                    <option value="3">3 à 5 fois par semaine</option>
                    <option value="4">Plus de 5 fois par semaine</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            <div class="form-group">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>
</body>
</html>