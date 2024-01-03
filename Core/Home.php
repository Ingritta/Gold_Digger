<?php

namespace App\Contollers;

use \Core\View;

class Home extends \Core\Controller{
    public function indexAction() {
        View::renderTemplate('Home/index.html');
    }
}