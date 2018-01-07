<?php

namespace App\BanqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBanqueBundle:Home:index.html.twig');
    }
}
