<?php
namespace Core\Controllers;

/** Обробник помилок роутінгу */
class ErrorController
{
    /**
     * @param int $error error code
     */
    public function actionIndex($error = 404)
    {
        if ($error==404) {
            require_once(ROOT.'/core/controllers/404.php');
        }
    }
}
