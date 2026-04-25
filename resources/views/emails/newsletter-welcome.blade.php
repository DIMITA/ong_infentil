<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Bienvenue</title></head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
<h2 style="color: #1B5E20;">Bienvenue dans notre communauté</h2>
<p>Bonjour {{ $subscriber->name ?? '' }},</p>
<p>Votre abonnement à la newsletter de l'Graines de vie est confirmé. Vous recevrez désormais nos actualités, rapports et appels à l'action.</p>
<p style="font-size: 12px; color: #666;">Pour vous désabonner à tout moment : <a href="{{ $unsubUrl }}">cliquer ici</a></p>
</body>
</html>
