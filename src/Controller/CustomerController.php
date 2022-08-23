<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(CustomerRepository $customerRepository): Response
    {

        $query = $customerRepository->createQueryBuilder('c')
            ->andWhere("JSON_GET_TEXT(c.data, 'purchasedCount') = :purchasedCount")
            ->getQuery();
        // ->getResult();
        $result = $query->execute([
            'purchasedCount' => '77',
        ]);
        dd($query->getDQL(), $result);

        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }
}
