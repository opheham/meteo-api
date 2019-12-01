<?php //src/Controller/HomepageController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Homepage controller
 * 
 * @author Olivier Fillol <fillol.olivier@gmail.com>
 * @version 1.0.0
 */
class HomepageController extends AbstractController
{
    /**
     * Homepage controller
     * 
     * @Route(
     *      "/",
     *      name="homepage"
     * )
     */
    public function homepage()
    {
        return $this-> render('homepage.html.twig');
    }
}