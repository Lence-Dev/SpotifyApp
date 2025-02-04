<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Entity\Usuario;
use App\Entity\UsuarioPlaylist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioPlaylistController extends AbstractController
{
    #[Route('/crear/usuarioPlaylist', name: 'app_usuario_playlist')]
    public function crear(EntityManagerInterface $e): JsonResponse
    {
        $usuarioRepository= $e->getRepository(Usuario::class);
        $usuario = $usuarioRepository->findOneByName('Sergio');

        $playlistRepository= $e->getRepository(Playlist::class);
        $playlist = $playlistRepository->findOneByName('Mis canciones');

        $usuarioPlaylist = new UsuarioPlaylist();
        $usuarioPlaylist->setPlaylist($playlist);
        $usuarioPlaylist->setUsuario($usuario);

        $e->persist($usuario,$playlist);
        $e->flush();

        return $this->json([
            'message' => 'Se ha creado con exito usuarioPlaylist!',
            'path' => 'src/Controller/UsuarioPlaylistController.php',
        ]);
    }
}
