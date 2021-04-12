<?php

namespace App\Controller;

use App\Entity\ExchangeRate;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;

class ExchangeRateController extends AbstractFOSRestController
{
    public function index(Request $request)
    {
        $code = $request->query->get('code');
        $repository = $this->getDoctrine()->getRepository(ExchangeRate::class);
        $exchangeRates = $code ? $repository->findBy(['code' => $code]) : $repository->findAll();

        return $this->handleView($this->view($exchangeRates));
    }
}
