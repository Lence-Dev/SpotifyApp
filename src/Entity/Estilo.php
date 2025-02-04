<?php

namespace App\Entity;

use App\Repository\EstiloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstiloRepository::class)]
class Estilo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Cancion>
     */
    #[ORM\OneToMany(targetEntity: Cancion::class, mappedBy: 'genero')]
    private Collection $canciones;

    /**
     * @var Collection<int, Perfil>
     */
    #[ORM\ManyToMany(targetEntity: Perfil::class, mappedBy: 'estiloMusicalPreferido')]
    private Collection $Perfiles;

    public function __construct()
    {
        $this->canciones = new ArrayCollection();
        $this->Perfiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id): ?int
    { 
        return $this->id=$id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Cancion>
     */
    public function getCanciones(): Collection
    {
        return $this->canciones;
    }

    public function addCancione(Cancion $cancione): static
    {
        if (!$this->canciones->contains($cancione)) {
            $this->canciones->add($cancione);
            $cancione->setGenero($this);
        }

        return $this;
    }

    public function removeCancione(Cancion $cancione): static
    {
        if ($this->canciones->removeElement($cancione)) {
            // set the owning side to null (unless already changed)
            if ($cancione->getGenero() === $this) {
                $cancione->setGenero(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Perfil>
     */
    public function getPerfiles(): Collection
    {
        return $this->Perfiles;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', null, ['mapped' => false]);
    }

    public function addPerfile(Perfil $perfile): static
    {
        if (!$this->Perfiles->contains($perfile)) {
            $this->Perfiles->add($perfile);
            $perfile->addEstiloMusicalPreferido($this);
        }

        return $this;
    }

    public function removePerfile(Perfil $perfile): static
    {
        if ($this->Perfiles->removeElement($perfile)) {
            $perfile->removeEstiloMusicalPreferido($this);
        }

        return $this;
    }
}
