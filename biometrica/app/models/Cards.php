<?php
namespace App\Models;

use \PDO;
use \Core\Components\Db;

final class Cards
{
    private static $table="\"Cards\"";
    public static function checkCard($int)
    {
        try {
            $int=intval($int, 10);
            $db=Db::getInstance();
            $sql=$db->prepare('SELECT * FROM '.self::$table.' WHERE uid=:int');
            $sql->bindParam(':int', $int, PDO::PARAM_INT);
            $sql->execute();
            $res=$sql->fetch(PDO::FETCH_ASSOC);
            //print_r($res);
            if ($res['uid']==$int && $res['uid']!=0) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return null;
        }
    }
    public static function addCard($uid){
        $fix=self::checkCard($uid);
        if($fix==1){
            //echo "hvatit\n";
        }else{
            try {
            
            $db=Db::getInstance();
            $sql=$db->prepare('INSERT INTO '.self::$table.' (uid) VALUES (:uid)');
            $sql->bindParam(':uid', $uid, PDO::PARAM_INT);
            return $sql->execute();  
            } catch (Exception $e) {
                return null;
            }
        }
        return 0; 
    }
}
