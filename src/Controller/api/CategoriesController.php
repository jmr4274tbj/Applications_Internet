<?php

namespace App\Controller\Api;

use App\Controller\Api\AppController;

class CategoriesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index', 'view', 'add', 'edit', 'delete']);
    }

}
