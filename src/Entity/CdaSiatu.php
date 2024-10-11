<?php

namespace App\Entity;

use App\Repository\CdaSiatuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CdaSiatuRepository::class)]
class CdaSiatu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $valor = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private $pdfDivida = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataVencimento = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ContribuinteSiatu $contribuinte_siatu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    public function getPdfDivida()
    {
        return $this->pdfDivida;
    }

    public function setPdfDivida($pdfDivida): static
    {
        $this->pdfDivida = $pdfDivida;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getDataVencimento(): ?\DateTimeInterface
    {
        return $this->dataVencimento;
    }

    public function setDataVencimento(\DateTimeInterface $dataVencimento): static
    {
        $this->dataVencimento = $dataVencimento;

        return $this;
    }

    public function getContribuinteSiatu(): ?ContribuinteSiatu
    {
        return $this->contribuinte_siatu;
    }

    public function setContribuinteSiatu(?ContribuinteSiatu $contribuinte_siatu): static
    {
        $this->contribuinte_siatu = $contribuinte_siatu;

        return $this;
    }
}
