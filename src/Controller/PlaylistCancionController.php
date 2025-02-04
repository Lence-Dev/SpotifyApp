<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\Playlist;
use App\Entity\PlaylistCancion;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistCancionController extends AbstractController
{
    #[Route('/playlist/cancion', name: 'app_playlist_cancion')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlaylistCancionController.php',
        ]);
    }

    #[Route('/crear/playlistCancion', name: 'app_crear_playlist_cancion')]
    public function crearPlaylistCancion(EntityManagerInterface $e): JsonResponse
    {
        $cancionRepository = $e->getRepository(Cancion::class);
        $cancion= $cancionRepository->findOneByTitle('Raindrops Keep falling on my head');

        $playlistRepository = $e->getRepository(Playlist::class);
        $playlist= $playlistRepository->findOneByTitle('Mis canciones');
        
        $playlistCancion = new PlaylistCancion();
        $playlistCancion->setCancion($cancion);
        $playlistCancion->setPlaylist($playlist);

        $e->persist($playlistCancion);
        $e->flush();

        return $this->json([
            'message' => 'Has creado con exito !',
            'path' => 'src/Controller/PlaylistCancionController.php',
        ]);
    }

}
