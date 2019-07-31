<?php

namespace App\Controller;

use App\Services\ApiServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

/**

 * Class HomeController

 * @package App\Controller

 */


class HomeController extends AbstractController
{
    /**

     * @Route("/", name="home")

     */
    public function index(ApiServices $apiServices)
    {

        $apiServices->index();
        return $this->render('home/index.html.twig');
    }


}
