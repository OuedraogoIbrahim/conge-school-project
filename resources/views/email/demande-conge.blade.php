<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Demande de Congé</title>
    </head>

    <body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; text-align: center;">
        <table align="center" width="600"
            style="margin: 20px auto; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <tr>
                <td style="padding: 20px; text-align: center;">
                    <h1 style="font-size: 24px; color: #333;">Demande de Congé ou d'Absence</h1>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: left; font-size: 16px; color: #555;">
                    <p>Bonjour ,</p>
                    <p>Vous avez reçu une demande de congé ou d'absence de la part de
                        {{ $user->nom . ' ' . $user->prenom }}. Voici les
                        détails de la demande :</p>
                    <ul style="list-style: none; padding: 0; line-height: 1.6;">
                        <li><strong>Nom :</strong> {{ $user->nom }}</li>
                        <li><strong>Prénom :</strong> {{ $user->prenom }}</li>
                        <li><strong>Date de début :</strong> {{ $demande->date_debut }}</li>
                        <li><strong>Date de fin :</strong> {{ $demande->date_fin }}</li>
                        <li><strong>Motif :</strong> {{ $demande->motif }}</li>
                        <li><strong>Type de demande :</strong> {{ $demande->type_conge }}</li>
                    </ul>
                    <p>Veuillez cliquer sur l'un des boutons ci-dessous pour accepter ou refuser cette demande.</p>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: center;">
                    <a href={{ route('demande.accepter', $demande) }}
                        style="display: inline-block; margin: 10px 10px; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: bold;">Accepter
                        la demande</a>
                    <a href={{ route('demande.refuser', $demande) }}
                        style="display: inline-block; margin: 10px 10px; padding: 10px 20px; background-color: #dc3545; color: #fff; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: bold;">Refuser
                        la demande</a>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align: center; font-size: 14px; color: #999;">
                    Ceci est un message automatique, veuillez ne pas y répondre.
                </td>
            </tr>
        </table>
    </body>

</html>
