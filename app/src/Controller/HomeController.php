<?php

declare(strict_types=1);

namespace App\Controller;

use App\Composite\DropDownComposition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function home(DropDownComposition $dropDownComposition): Response
    {
        return $this->render(
            'home/index.twig',
            [
                'places' => $dropDownComposition->getDropDownAttributes(),
            ]
        );
    }
}
