<!DOCTYPE html>
<html>
<head>
    <title>ESonnette.com</title>
</head>
<body style="text-align: center;">
    <h1>Quelqu'un vient de sonner !</h1>
        <p>Cher résident, <br>
        <br>
        Nous souhaitons vous informer qu'une personne a récemment sonné à votre porte. <br>
        Voici les détails de la visite : <br>
        <br>
        <b>Dénomination :</b> {{ $details['denomination'] }} <br>
        <b>Numéro de téléphone :</b> {{ $details['telephone'] }} <br>
        <b>Date :</b> {{ $details['date'] }} <br>
        <br>
        Cordialement, <br>
        L'équipe de ESonnette.com
    </p>
</body>
</html>