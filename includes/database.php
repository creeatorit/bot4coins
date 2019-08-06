<?php

class Banco
{
    private static $dbNome    = 'bot4coins';
    private static $dbHost    = 'localhost:3306';
    private static $dbUsuario = 'root';
    private static $dbSenha   = '12031980';

    private static $cont      = null;

    public function __construct()
            {
                die('A função Init nao é permitido!');
                }

    public static function conectar()
    {
        if(null == self::$cont)
        {
            try
            {
                //self::$options = [
                //    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                //    PDO::ATTR_PERSISTENT => true
                //];

                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbNome, self::$dbUsuario, self::$dbSenha);
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }

    public static function desconectar()
    {
        self::$cont = null;
    }
}

?>

