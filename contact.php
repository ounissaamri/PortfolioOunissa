<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et validation des champs du formulaire
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Vérification que les champs ne sont pas vides
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Réponse d'erreur
        http_response_code(400);
        echo "Veuillez remplir tous les champs du formulaire correctement.";
        exit;
    }

    // Adresse e-mail de destination
    $recipient = "amriounissa@gmail.com";

    // Sujet de l'e-mail
    $email_subject = "Nouveau message de $name : $subject";

    // Contenu de l'e-mail
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // En-têtes de l'e-mail
    $email_headers = "From: $name <$email>";

    // Envoi de l'e-mail
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Réponse de succès
        http_response_code(200);
        echo "Votre message a été envoyé. Merci!";
    } else {
        // Réponse d'erreur
        http_response_code(500);
        echo "Oops! Quelque chose s'est mal passé et nous n'avons pas pu envoyer votre message.";
    }
} else {
    // Réponse d'erreur si la méthode de requête n'est pas POST
    http_response_code(403);
    echo "Il y a eu un problème avec votre soumission. Veuillez réessayer.";
}
?>
