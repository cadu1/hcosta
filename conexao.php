<?php
/*
 * Constantes de parâmetros para configuração da conexão
 */
define('HOST', 'localhost');
define('DBNAME', 'hcosta');
define('CHARSET', 'utf8');
define('USER', 'postgres');
define('PASSWORD', 'postgre');

class conexao {
    
    /*
     * Atributo estático de conexão
     */
    private static $pdo;

    // /*
    //  * Escondendo o construtor da classe
    //  */
    // private function __construct() {
    //     //
    // }

    /*
     * Método privado para verificar se a extensão PDO do banco de dados escolhido
     * está habilitada
     */
    private static function verificaExtensao() {
        if(!extension_loaded('pdo_pgsql')) {
            echo "<h1>Extensão {$extensao} não habilitada!</h1>";
            exit();
        }
    }

    /*
     * Método estático para retornar uma conexão válida
     * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão
     */
    public static function getInstance() {

        self::verificaExtensao();

        if (!isset(self::$pdo)) {
            try {
                $opcoes = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
                self::$pdo = new \PDO("pgsql:host=" . HOST . "; dbname=" . DBNAME . ";", USER, PASSWORD, $opcoes);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "Erro: " . $e->getMessage();
            }
        }
        return self::$pdo;
    }

    public static function isConectado(){
        if(self::$pdo){
            return true;
        } else {
            return false;
        }
    }
}