<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    private CallApiService $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }


    #[Route('/departement/{departement}', name: 'departement')]
    public function index(string $departement): Response
    {
        $formatedDepartement = strtolower($this->stripAccents($departement));
        //dd($this->callApiService->getDepartementData($formatedDepartement));
        return $this->render('departement/index.html.twig', [
            'data' => $this->callApiService->getDepartementData($formatedDepartement),
        ]);
    }

    private function stripAccents($str)
    {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
}
