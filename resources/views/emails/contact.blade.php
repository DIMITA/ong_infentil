<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Contact</title></head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
<h2 style="color: #1B5E20;">Nouveau message de contact</h2>
<table style="width:100%; border-collapse: collapse;">
<tr><td style="padding: 8px; font-weight: bold;">Nom :</td><td>{{ $data['name'] }}</td></tr>
<tr><td style="padding: 8px; font-weight: bold;">Email :</td><td>{{ $data['email'] }}</td></tr>
<tr><td style="padding: 8px; font-weight: bold;">Sujet :</td><td>{{ $data['subject'] }}</td></tr>
</table>
<div style="margin-top: 20px; padding: 15px; background: #f5f5f5; border-radius: 5px;">
<strong>Message :</strong><br><br>
{{ $data['message'] }}
</div>
</body>
</html>
