<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription à un événement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Participation à un événement</h3>
        </div>
        <div class="card-body">
            <form action="submit.php" method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone :</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" required>
                </div>

                <div class="mb-3">
                    <label for="evenement" class="form-label">Événement :</label>
                    <select class="form-select" id="evenement" name="evenement" required>
                        <option value="">-- Choisir un événement --</option>
                        <option value="Conférence IA">Conférence IA</option>
                        <option value="Atelier DevOps">Atelier DevOps</option>
                        <option value="Séminaire Cloud">Séminaire Cloud</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">S'inscrire</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
