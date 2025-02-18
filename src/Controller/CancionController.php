<?php

namespace App\Controller;
use App\Entity\Cancion;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class CancionController extends AbstractController
{
    #[Route('/crear/cancion', name: 'app_cancion')]
    public function crearCancion(EntityManagerInterface $e): JsonResponse
    {
        $cancion = new Cancion();
        $cancion->setAutor('B.J:Thomas');
        $cancion->setTitulo('Raindrops Keep falling on my head');
        $cancion->setAlbum('Platinum Collection');
        $cancion->setLikes(3);
        $cancion->setDuracion(2);

        $e->persist($cancion);
        $e->flush();

        return $this->json([
            'message' => 'Se ha creado la canción con exito',
            'path' => 'src/CancionController.php'
        ]);;
    }


    #[Route('/mostrar/canciones', name:'mostrar_canciones')]
    public function mostrarCanciones(EntityManagerInterface $e)
    {
        $cancionRepository = $e->getRepository(Cancion::class);
        $canciones = $cancionRepository->findAll();

        $info=[];
        foreach($canciones as $cancion){
            $info[]=[
                'id'=>$cancion->getId(),
                'titulo'=>$cancion->getTitulo(),
                'autor'=>$cancion->getAutor(),
                'foto'=>$cancion->getFoto()
            ];
        }
        return $this->json($info);
    }

    #[Route('buscar/{id}', name:'buscar_cancion')]
    public function buscarCanciones(EntityManagerInterface $e, $id)
    {
        $cancionRepository = $e->getRepository(Cancion::class);
        $cancion=$cancionRepository->find($id);

        $ruta='songs/'.$id.'.mp3';

        return new BinaryFileResponse($ruta);
    }
    
}
