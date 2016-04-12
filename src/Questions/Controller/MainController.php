<?php

namespace Questions\Controller;

use Questions\Model\Category;
use Vendor\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $model = new Category();
        $categories = $model->getList();
        return $this->render('index.php', ['categories' => $categories]);
    }
}