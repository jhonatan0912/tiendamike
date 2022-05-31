<?php

use GuzzleHttp\Client;

require_once __DIR__ . '/../vendor/autoload.php';
class OauthTools
{
  /** 
   * Funcion para validar token y proveedor
   */
  public static function validarToken($token, $proveedor)
  {
    if ($proveedor == 'google') {
      return OauthTools::validarTokenGoogle($token);
    } else if ($proveedor == 'facebook') {
      return OauthTools::validarTokenFacebook($token);
    } else {
      return null;
    }
  }
  /**
   * Funcion para validar tokens con google
   */
  public static function validarTokenGoogle($token)
  {
    $client = new Client([
      'base_uri' => 'https://oauth2.googleapis.com',
    ]);
    $response = $client->request('GET', "/tokeninfo?id_token=$token");
    return $response;
  }
  /**
   * Funcion para validar tokens con facebook
   */
  public static function validarTokenFacebook($token)
  {
    $client = new Client([
      'base_uri' => 'https://graph.facebook.com',
    ]);
    $response = $client->request('GET', "/me?access_token=$token");
    return $response;
  }
}
