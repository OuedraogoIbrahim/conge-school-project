<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réponse à votre demande de congé</title>
    </head>

    <body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; text-align: center;">
        <table align="center" width="600"
            style="margin: 20px auto; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <tr>
                <td style="padding: 20px; text-align: center;">
                    <h1 style="font-size: 24px; color: #333;">Réponse à votre demande de congé</h1>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: left; font-size: 16px; color: #555;">
                    <p>Bonjour {{ $user->nom . ' ' . $user->prenom }},</p>
                    <p>Votre demande de congé du <strong>{{ $demande->date_debut }}</strong> au
                        <strong>{{ $demande->date_fin }}</strong> a été
                        <strong style="color: {{ $statut === 'acceptée' ? '#28a745' : '#dc3545' }};">
                            {{ $statut }}
                        </strong>.
                    </p>

                    @if ($statut === 'refusée')
                        <p>Malheureusement, votre demande n'a pas été acceptée.</p>
                    @else
                        <p>Votre congé est officiellement validé. Bon repos !</p>
                    @endif
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
