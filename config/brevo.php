<?php
return [
    'api_key' => env('BREVO_API_KEY', ''),
    'list_id' => env('BREVO_LIST_ID', 1),
    'double_optin' => true,
    'from_email' => env('MAIL_FROM_ADDRESS', 'contact@ong-infentil.org'),
    'from_name' => env('APP_NAME', 'ONG Infentil'),
];
