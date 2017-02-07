<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
$app = new \Slim\App;
//$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

function getDB()
{
    $dbhost = "pajaros.com";
    $dbname = "pajaros";
    $dbuser = "pajaros";
    $dbpass = "root";

    //Resolviendo problema de codificacion utf-8
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 

    $mysql_conn_string = "mysql:host=$dbhost;dbname=$dbname";
    $dbConnection = new PDO($mysql_conn_string,$dbuser,$dbpass,$options);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConnection;
}

    $app->get('/', function (Request $request, Response $response) {
        $response->write('Bienvenido');
        return $response;
    });

    /* Return all pajaros */
    $app->get('/all', function (Request $request, Response $response) {
    
    try{

        $db = getDB();
        $sth = $db->prepare("SELECT id, titulo, pajaro, veces FROM avistamientos");
        $sth->execute();
        $pajaros = $sth->fetchAll(PDO::FETCH_ASSOC);

        if($pajaros)
        {
            $response = $response->withJson($pajaros);
            $db = null; //cerramos la conexion con la BD
        }else{
            return $response->withJson(['message'=>'Not results found','code'=>'404']);
        }

    }catch(PDOException $e)
    {
        $response->withJson(['error'=>['texto'=>$e->getMessage()]]);
    }

     return $response;
});

    /* Return one pajaro by id */
    $app->get('/one/{id}', function (Request $request, Response $response, $args) {
    
    try{

        $db = getDB();
        $sth = $db->prepare("SELECT * FROM avistamientos WHERE id = :id");
        $sth->bindParam(":id", $args['id'], PDO::PARAM_INT);
        $sth->execute();
        $pajaros = $sth->fetchAll(PDO::FETCH_ASSOC);

        if($pajaros)
        {
            $response = $response->withJson(['data'=>$pajaros]);
            $db = null; //cerramos la conexion con la BD
        }else{
            return $response->withJson(['message'=>'Not results found','code'=>'404']);
        }

    }catch(PDOException $e)
    {
        $response->withJson(['error'=>['texto'=>$e->getMessage()]]);
    }

     return $response;
});

    /* Update pajaro with put */
    $app->put('/updateVeces', function ($request, $response) {
    
    try{
        $data = $request->getParams();
        $db = getDB();
        $sth = $db->prepare("UPDATE avistamientos SET veces=?, lastview=? WHERE id=?");
        $sth->execute(array($data['veces'], $data['lastview'], $data['id']));
       
        $response = $response->withJson(['message'=>'Update success','code'=>'200']);

    }catch(PDOException $e)
    {
        $response->withJson(['error'=>['texto'=>$e->getMessage()]]);
    }

     return $response;
});

    /* Update pajaro with put */
    $app->put('/update', function ($request, $response) {
    
    try{
        $data = $request->getParams();
        $db = getDB();
        $sth = $db->prepare("UPDATE avistamientos SET titulo=?, pajaro=? WHERE id=?");
        $sth->execute(array($data['titulo'], $data['pajaro'], $data['id']));
       
        $response = $response->withJson(['message'=>'Update success','code'=>'200']);

    }catch(PDOException $e)
    {
        $response->withJson(['error'=>['texto'=>$e->getMessage()]]);
    }

     return $response;
});

    /* Create new pajaro */
    $app->post('/update', function ($request, $response) {
    
    try{
        $data = $request->getParams();
        $db = getDB();
        $sth = $db->prepare("INSERT INTO avistamientos (titulo, pajaro, lastview, veces, latitud, longitud)
                            VALUES(?,?,?,?,?,?)");
        $sth->execute(array($data['titulo'], $data['pajaro'], $data['lastview'], $data['veces'],$data['latitud'],$data['longitud']));
       
        $response = $response->withJson(['message'=>'Update success','code'=>'200']);

    }catch(PDOException $e)
    {
        $response->withJson(['error'=>['texto'=>$e->getMessage()]]);
    }

     return $response;
});

/* Kill pajaro x_x */
    $app->delete('/delete/{id}', function ($request, $response, $args) {
    
    try{
        $db = getDB();
        $sth = $db->prepare("DELETE FROM avistamientos WHERE id=:id");
        $sth->bindParam(":id", $args['id'], PDO::PARAM_INT);
        $sth->execute();
       
        $response = $response->withJson(['message'=>'Delete success','code'=>'200']);

    }catch(PDOException $e)
    {
        $response->withJson(['error'=>['texto'=>$e->getMessage()]]);
    }

     return $response;
});

$app->run();
