<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Confirmer votre abonnement</title></head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
<h2 style="color: #1B5E20;">Confirmez votre abonnement</h2>
<p>Bonjour {{ $subscriber->name ?? 'cher(e) abonné(e)' }},</p>
<p>Merci de votre intérêt pour les actualités de l'ONG Infentil.</p>
<p>Cliquez sur le bouton ci-dessous pour confirmer votre abonnement :</p>
<a href="{{ $confirmUrl }}" style="display:inline-block; padding: 12px 24px; background: #1B5E20; color: white; text-decoration: none; border-radius: 5px; margin: 15px 0;">Confirmer mon abonnement</a>
<p style="font-size: 12px; color: #666;">Si vous n'avez pas demandé cet abonnement, ignorez cet email. <a href="{{ $unsubUrl }}">Se désabonner</a></p>
</body>
</html>
