<?php
/**
 * Get a random quote from the Buddha API and translate it to French
 * BRUTALISM DEV by PetitCitron (https://github.com/PetitCitron/citations_bouddha)
 * @return string
 */
function get_buddha_quote($html=true) {
    // URL de l'API
    $url = "https://buddha-api.com/api/random";

    // Initialiser une session cURL
    $ch = curl_init();

    // Définir les options cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Exécuter la requête cURL
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return "Erreur lors de la récupération de la citation.";
    }

    // Fermer la session cURL
    curl_close($ch);

    // Décoder la réponse JSON
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Erreur lors du décodage de la réponse JSON.";
    }

    // Extraire la citation
    $quote = $data['text'] ?? 'Citation non disponible';
    $author = $data['byName'] ?? 'Auteur inconnu';

    $quote = str_replace(';', '', $quote);
    // Traduire la citation en français
    if ($html) {
        return "<h1>" . str_replace(';', '', translate_to_french("$quote")) . "</h1>" . " - $author";
    }
    return  translate_to_french("$quote") . " - $author";
}

function translate_to_french($text) {
    // URL de l'API de traduction (ici, j'utilise l'API de Google Translate)
    $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=fr&dt=t&q=" . urlencode($text);

    // Initialiser une session cURL
    $ch = curl_init();

    // Définir les options cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Exécuter la requête cURL
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return "Erreur lors de la traduction.";
    }

    // Fermer la session cURL
    curl_close($ch);

    // Décoder la réponse JSON
    $responseArray = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Erreur lors du décodage de la réponse JSON.";
    }

    // Extraire la traduction
    $translated_text = $responseArray[0][0][0] ?? 'Traduction non disponible';

    return $translated_text;
}
if (php_sapi_name() == 'cli') {
    // Code à exécuter si le script est lancé depuis la ligne de commande
    echo get_buddha_quote(false) . "\n";
} else {
    header('Content-Type: text/html; charset=utf-8');
    // Afficher la citation traduite si accédé via un navigateur
    echo '<html>';
    echo '<head><meta charset="utf-8"><meta lang="fr">';
    echo '<title>Citation Bouddha</title>';
    echo '</head>';
    echo '<body>';
    echo  get_buddha_quote();
    if (!isset($_GET['no_creds']) || $_GET['no_creds'] !== 'true') {
        echo "<br><br><small>src : https://buddha-api.com/ | traduction : Google Translate | by <a href='https://github.com/PetitCitron/citations_bouddha'>GitHub Repo</a></small>";
        echo "<br><small>enlever cette ligne ? <a href='citations.php?no_creds=true'>cliquez ici</a></small>";
    }
    echo '</body>';
    echo '</html>';
}
?>