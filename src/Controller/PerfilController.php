<?php

namespace App\Controller;

use App\Entity\Estilo;
use App\Entity\Perfil;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Json;

final class PerfilController extends AbstractController
{
    #[Route('/crear/perfil', name: 'app_perfil')]
    public function crearPerfil(EntityManagerInterface $e): JsonResponse
    {
        $perfil = new Perfil();
        $perfil->setFoto('foto');
        $perfil->setDescripcion('Una descripcion breve del usuario..');
        
        $e->persist($perfil);
        $e->flush();

        return $this->json([
            'message' => 'Se ha creado tu perfil con exito',
            'path' => 'src/PerfilController.php'
        ]);
    }
}
