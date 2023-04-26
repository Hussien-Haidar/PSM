<?php
if (!function_exists('encrypt'))   {
function encrypt($string)
  {
   $method = "AES-256-CBC";
    $iv = "2234567817654322";
    $key = "6sF4SBAVIIBUl45duxa9OAo11vTkms21";
    if ( $encrypted = openssl_encrypt ( $string, $method, $key, 0, $iv ) )
    {
      return $encrypted;
    }
    else
    {
      return "";
    }
  }
}
if (!function_exists('decrypt'))   {
function decrypt($encryptedText) {
    $method = "AES-256-CBC";
    $iv = "2234567817654322";
    $key = "6sF4SBAVIIBUl45duxa9OAo11vTkms21";
    
    if ( $decrypted = openssl_decrypt ( $encryptedText, $method, $key, 0, $iv ) )
    {
      return $decrypted;
    }
    else
    {
      return "";
    }
}
}
?>