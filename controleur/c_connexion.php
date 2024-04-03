<?php
if (!isset($_POST['cmdAction'])) {
    $action = 'demanderConnexion';
} else {
    // par défaut
    $action = $_POST['cmdAction'];
}
switch ($action) {
    case 'demanderConnexion': {
            require './vue/v_connexion.php';
            break;
        }

    case 'validerConnexion': {
            // vérifier si l'utilisateur existe avec ce mot de passe
            $utilisateur = $db->getUnMembre($_POST["txtLogin"], $_POST["hdMdp"]);
            // si l'utilisateur n'existe pas
            // positionner le message d'erreur $erreur
            echo $utilisateur;
            if ($utilisateur == null) {
                $erreur = "Identifiant ou mot de passe incorrecte";
            }
            require './vue/v_connexion.php';
            return;
            // inclure la vue correspondant au formulaire d'authentification

            //  } else {
            // créer trois variables de session pour id utilisateur, nom et prénom
            //  $_SESSION['idUtilisateur'] = $utilisateur->idPersonne;

            // redirection du navigateur vers la page d'accueil
            //  header('Location: index.php');
            exit;
        }
        break;
}
// }
