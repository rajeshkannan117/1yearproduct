<?php
function AES_Encode($plain_text,$key = 'dynamicfrom123')
{
    
    return base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $key, true, str_repeat(chr(0), 16)));
}

function AES_Decode($base64_text,$key = 'dynamicfrom123')
{
    
    return openssl_decrypt(base64_decode($base64_text), "aes-256-cbc", $key, true, str_repeat(chr(0), 16));
}

