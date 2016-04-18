<?php

/**
 *  Main controller
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Controller;

use Questions\Model\Category;
use Vendor\Controller;

class MainController extends Controller
{
    /**
     * Get main site page
     *
     * @return \Vendor\Response\Response
     */
    public function indexAction()
    {
        $categories = (new Category())->getList();
        return $this->render('index.php', ['categories' => $categories]);
    }
}