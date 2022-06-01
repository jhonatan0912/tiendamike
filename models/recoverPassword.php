<?php

class RecoverPassword
{

  public $id;
  public $idCliente;
  public $recoveryToken;
  public $fueUsado;
  public $fechaVencimiento;

  function __construct(
    $id,
    $idCliente,
    $recoveryToken,
    $fueUsado,
    $fechaVencimiento
  ) {
    $this->id = $id;
    $this->idCliente = $idCliente;
    $this->recoveryToken = $recoveryToken;
    $this->fueUsado = $fueUsado;
    $this->fechaVencimiento = $fechaVencimiento;
  }

  static function desdeFila($fila)
  {
    $recoverPassword = new RecoverPassword(
      $fila['id'],
      $fila['idCliente'],
      $fila['recoveryToken'],
      $fila['fueUsado'],
      $fila['fechaVencimiento']
    );
    return $recoverPassword;
  }
  static function desdeRecoverPassword($fila)
  {
    $recoverPassword = RecoverPassword::desdeFila($fila);
    $recoverPassword->id = $fila['id'];
    $recoverPassword->idCliente = $fila['idCliente'];
    $recoverPassword->recoveryToken = $fila['recoveryToken'];
    $recoverPassword->fueUsado = $fila['fueUsado'];
    $recoverPassword->fechaVencimiento = $fila['fechaVencimiento'];
    return $recoverPassword;
  }
}
