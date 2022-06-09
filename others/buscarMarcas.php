<?php
require_once __DIR__ . '/../controllers/variedadesAdapter.php';
require_once __DIR__ . '/../tools/httpTools.php';
if (isset($_GET['buscador-marcas'])) {
  $marcaBuscada = $_GET['buscador-marcas'];

  $res = VariedadAdapter::searcher($marcaBuscada);
  if ($res->idVariedad == 1) {
    HttpTools::redireccionar('/views/carta/adidas.php');
  } elseif ($res->idVariedad == 2) {
    HttpTools::redireccionar('/views/carta/nike.php');
  } elseif ($res->idVariedad == 3) {
    HttpTools::redireccionar('/views/carta/puma.php');
  } elseif ($res->idVariedad == 4 || $marcaBuscada == "new atletic") {
    HttpTools::redireccionar('/views/carta/newAthletic.php');
  } elseif ($res->idVariedad == 5) {
    HttpTools::redireccionar('/views/carta/newBalance.php');
  } elseif ($res->idVariedad == 6) {
    HttpTools::redireccionar('/views/carta/reebok.php');
  } elseif ($res->idVariedad == 7) {
    HttpTools::redireccionar('/views/carta/vans.php');
  } elseif ($res->idVariedad == 8 || $marcaBuscada == "irun") {
    HttpTools::redireccionar('/views/carta/irun.php');
  } elseif ($res->idVariedad == 9) {
    HttpTools::redireccionar('/views/carta/dc.php');
  } else {
    HttpTools::redireccionar('/views/carta/catalogo.php');
  }
} else {
  HttpTools::redireccionar('/views/carta/catalogo.php');
}
