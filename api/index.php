<?php
/**
 * ahjav/index.php
 * Created by: Nathan
 * Date: 22/05/14
 */

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>AHJAV API Documentation</title>
</head>
<body>
<section>
    <h1>Documentation de l'API</h1>
    <div>
        <h3>Récupération des vins:</h3>
        <ul>
            <li><strong>URL: </strong>/api/vin/{id}</li>
            <li><strong>Method: </strong>GET</li>
            <li><strong>JSON Format: </strong>
                <p>
                    <pre>
[
    {
        "id":"1",
        "nom":"Vin",
        "couleur":"Rouge",
        "millesime":"2012",
        "region":"Bordeaux",
        "caracteristiques":"Belle robe",
        "met":"Viande rouge",
        "met_url":"http://www.ahjav.fr.ht/web/assets/img/media/theimage.jpg",
        "prix":"12.00",
        "caviste":"LeNomDuCaviste"
    },
    ...
]
                    </pre>
                </p>
            </li>
        </ul>
    </div>
    <div>
        <h3>Récupération des partenaires: </h3>
        <ul>
            <li><strong>URL: </strong>/api/partenaire/{id}</li>
            <li><strong>Method: </strong>GET</li>
            <li><strong>JSON Format: </strong>
                <p>
                    <pre>
[
    {
        "id":"1",
        "nom":"Partenaire",
        "url":"http://www.thewebsite.com",
        "address":"110 rue du vin",
        "lat":"90.0000000000",
        "lng":"678654.0000000000",
        "promos":
        [
            {
                "id":"1",
                "nom":"PromoName",
                "categorie":"Réduction",
                "image":" -url vers image représentant un code barre (facultatif, peut etre vide)- ",
                "partenaire_id":"1"
            },
            ...
        ],
        "image":"http://www.ahjav.fr.ht/web/assets/img/media/lelogodupartenaire.png"
    },
    ...
]
                    </pre>
                </p>
            </li>
        </ul>
    </div>
    <div>
        <h3>Récupération des promotions: </h3>
        <ul>
            <li><strong>URL: </strong>/api/partenaire/{id}/promotions</li>
            <li><strong>Method: </strong>GET</li>
            <li><strong>JSON Format:</strong> Voir la section "promos" du JSON des partenaires</li>
        </ul>
    </div>
    <div>
        <h3>Récupération des anecdotes: </h3>
        <ul>
            <li><strong>URL: </strong>/api/anecdote</li>
            <li><strong>Method: </strong>GET</li>
            <li><strong>JSON Format:</strong>
                <p>
                    <pre>
[
    {
        "id":"1",
        "titre":"leTitre",
        "texte":"leTexte"
    },
    ...
]
                    </pre>
                </p>
            </li>
        </ul>
    </div>
    <div>
        <h3>Réupération des actualités: </h3>
        <ul>
            <li><strong>URL: </strong>/api/actualites</li>
            <li><strong>Method: </strong>GET</li>
            <li><strong>JSON Format:</strong>
                <p>
                    <pre>
[
    {
        "id":"1",
        "titre":"leTitre",
        "texte":"leTexte",
        "image":"http://www.ahjav.fr.ht/web/assets/img/media/actu-image.png"
    },
    ...
]
                    </pre>
                </p>
            </li>
        </ul>
    </div>
    <div>
        <h3>Récupération de 10 questions aléatoires: </h3>
        <ul>
            <li><strong>URL: </strong>/api/questions</li>
            <li><strong>Method: </strong>GET</li>
            <li><strong>JSON Format:</strong>
                <p>
                    <pre>
[
    {
        "id":"1",
        "theme":"Kamoulox",
        "question":"Quel est le muscle",
        "good_answer":"Dany Briand",
        "false_answer_1":"ObiWan Kenobi",
        "false_answer_2":"La réponse D",
        "explanation":"C'est pourtant clair"
    },
    ...
]
                    </pre>
                </p>
            </li>
        </ul>
    </div>
    <div>
        <h3>Récupération des sponsors: </h3>
        <ul>
            <li><strong>URL: </strong>/api/sponsors</li>
            <li><strong>Method: </strong>GET</li>
            <li><strong>JSON Format:</strong>
                <p>
                    <pre>
[
    {
        "id":"1",
        "nom":"Sponsor",
        "logo_url":"http://www.ahjav.fr.ht/web/assets/img/media/sponsor-image.png",
        "website":"http://www.website.com"
    }
]
                    </pre>
                </p>
            </li>
        </ul>
    </div>
</section>
</body>
</html>