<?php

namespace App\Controller;
use App\Entity\Estilo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class EstiloController extends AbstractController
{
    #[Route('/crear/estilo', name: 'app_estilo')]
    public function crearEstilo(EntityManagerInterface $e): JsonResponse
    {
        $estilo = new Estilo();
        $estilo->setNombre('Country');
        $estilo->setDescripcion('Musica Country Rebuena');

        $e->persist($estilo);
        $e->flush();

        return $this->json([
            'message' => 'Se ha creado tu estilo con exito',
            'path' => 'src/EstiloController.php'
        ]);
    }
    
}
