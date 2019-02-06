<?php
namespace App\Lp\CmsBundle\Controller;

use App\Lp\Framework\LpController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CmsController extends LpController
{
    /**
     * @Route("/{slug}", name="cms")
     */
    public function match()
    {
        return $this->render('root/index.html.twig', [
            'controller_name' => 'CmsController',
        ]);
    }
}
