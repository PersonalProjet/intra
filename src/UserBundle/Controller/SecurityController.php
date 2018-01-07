<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/", name="login_page")
     */
    public function indexAction()
    {
        $securityContext = $this->container->get('security.authorization_checker');

        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $response = $this->forward('AppBanqueBundle:Home:index');
        } else {
            $response = $this->render('HWIOAuthBundle:Connect:login.html.twig');
        }

        return $response;
    }
}
