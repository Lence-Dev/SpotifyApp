<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\Usuario;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioController extends AbstractController
{
    #[Route('/crear/usuario', name: 'app_usuario')]
    public function crearUsuario(EntityManagerInterface $e): Response
    {
        $perfilRepository = $e->getRepository(Perfil::class);
        $perfil= $perfilRepository->find(''); //LO TENGO QUE HACER
        $usuario = new Usuario();
        $usuario->setNombre('Sergio');
        $usuario->setPassword('contraseña1234');
        $usuario->setEmail('sergio@gmail.com');
        $usuario->setFechaNacimiento(new DateTime('1920-02-12'));
        $usuario->setPerfil($perfil);

        $e->persist($usuario);
        $e->flush();

        return $this->json([
            'message' => 'Se ha creado un usuario con exito',
            'path' => 'src/UsuarioController.php'
        ]);
    }
}
