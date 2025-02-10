<?php

namespace App\Controller;
use App\Entity\Usuario;
use App\Entity\Playlist;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistController extends AbstractController
{
    #[Route('/crear/playlist', name: 'app_playlist')]
    public function crearPlaylist(EntityManagerInterface $e): JsonResponse
    {
        $usuarioRepository= $e->getRepository(Usuario::class);
        $usuario = $usuarioRepository->findOneByName('Sergio');

        $playlist = new Playlist();
        $playlist->setNombre('Mis canciones');
        $playlist->setLikes(77);
        $playlist->setVisibilidad('publica');
        $playlist->setPropietario($usuario);
        
        $e->persist($playlist);
        $e->flush();


        return $this->json([
            'message' => 'Se ha creado la playlist con exito',
            'path' => 'src/PlaylistController.php'
        ]);
    }

    #[Route('/mostrar/playlist', name:'mostrar_playlists')]
    public function mostrarCanciones(EntityManagerInterface $e)
    {
        $playlistRepository = $e->getRepository(Playlist::class);
        $playlists = $playlistRepository->findAll();

        $info=[];
        foreach($playlists as $playlist){
            $info[]=['nombre'=>$playlist->getNombre()];
        }
        return $this->json($info);
    }
}
