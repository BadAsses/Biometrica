<?php
namespace App\Controllers;

use \App\Models\Cards;

class MainController
{
    public function actionIndex()
    {
        if($_POST){
            $res=Cards::checkCard($_POST["value"]);
           if ($res==null) {
               $res=0;
           }
           $this->makeResponse("authCard", $res);
       }
        else{
            echo "index";
        }
        return true;
    }
    public function actionValidate($int)
    {
            $res=Cards::checkCard($int);
            if ($res==null) {
                $res=0;
            }
            echo "<result> ".$res." </result>";
        // }
       
        return true;
    }
    public function actionAdd()
    {
        if($_POST){
            $res=Cards::addCard($_POST["value"]);
           if ($res==null) {
               $res=0;
           }
           $this->makeResponse("addCard", $res);
       }
        else{
            echo "index";
        }
        return true;

    }

    public function makeResponse($action,$res){
        if($_POST){
            echo "<p id=\"device\"> ".$_POST["id"]." </p>\n";
            echo "<p id=\"type\"> ".$action." </p>\n";
            echo "<p id=\"input\"> ".$_POST["value"]." </p>\n";
            echo "<p id=\"result\"> ".$res." </p>\n";
        }
    }

    public function actionTest(){
        require_once(APP."/views/main/test.php");
        return true;     
    }
}
