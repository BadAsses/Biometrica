<?php
namespace Core\Components;

use \PDO;

/**
 * Клас DB - компонент для взаємодіїї з БД.
 *
 * Створює екземпляр підключення до бази даних.(pdo_mysql)
 */
final class Db
{
    /** @var PDO|null Містить екземпляр підключення до бази даних(PDO) */
    private static $instance=null;
    /**
     * Створює екземпляр підключення до бази даних(PDO)
     * @see Db::$instance Призначає $instance
     * @return void
     */
    private function __construct()
    {
        /** @var string Шлях до файлу конфігурації бд */
        $paramsPath=CONFIG.'/db_params.php';
        $params=include_once($paramsPath);
        $dsn="pgsql:host={$params['host']};dbname={$params['dbname']}";
        $db=new PDO($dsn, $params['user'], $params['password'], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
        //$db->exec("set names utf8");
        //$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        self::$instance=$db;
    }
    /** @deprecated Не використовується */
    private function __clone()
    {
    }
    /**
     * Повертає екземпляр підключення до БД(PDO)
     * @return PDO
     */
    public static function getInstance()
    {
        if (self::$instance==null) {
            $instance=new Db();
        }
        return self::$instance;
    }
}
