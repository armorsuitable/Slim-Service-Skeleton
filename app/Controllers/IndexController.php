<?php
/**
 *
 */

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Slim\Views\Twig;


class IndexController extends Controller
{
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->view->render($response,'home.twig');
    }
}