<?

include_once 'clients.class.php';

$usuario = new Usuarios();

echo json_encode($usuario->buscarUsuario($_GET['term']));

?>