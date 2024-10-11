<?php
namespace App\Controller;

use App\Entity\CdaSiatu;
use App\Entity\CdaSupp;
use App\Entity\ContribuinteSiatu;
use App\Entity\ContribuinteSupp;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DataCopyController extends AbstractController {
    #[Route('/api/sync-data', name: 'sync-data', methods: ['POST'])]
    public function copyData(EntityManagerInterface $em): JsonResponse {
        // Obter os registros da tabela ContribuinteSiatu
        $contribuintesSiatu = $em->getRepository(ContribuinteSiatu::class)->findAll();

        foreach ($contribuintesSiatu as $contribuinteSiatu) {
            // Criar uma nova instância de ContribuinteSupp e copiar os dados
            $contribuinteSupp = new ContribuinteSupp();
            $contribuinteSupp->setNome($contribuinteSiatu->getNome());
            $contribuinteSupp->setCpf($contribuinteSiatu->getCpf());
            $contribuinteSupp->setEndereco($contribuinteSiatu->getEndereco());

            // Persistir o novo ContribuinteSupp
            $em->persist($contribuinteSupp);

            // Obter as Certidões associadas ao ContribuinteSiatu
            $certidoesSiatu = $em->getRepository(CdaSiatu::class)->findBy(['contribuinte_siatu' => $contribuinteSiatu]);

            foreach ($certidoesSiatu as $certidaoSiatu) {
                // Criar uma nova instância de CdaSupp e copiar os dados
                $certidaoSupp = new CdaSupp();
                $certidaoSupp->setDescricao($certidaoSiatu->getDescricao());
                $certidaoSupp->setDataVencimento($certidaoSiatu->getDataVencimento());
                $certidaoSupp->setValor($certidaoSiatu->getValor());
                $certidaoSupp->setContribuinteSupp($contribuinteSupp); // Associar o novo ContribuinteSupp

                // Copiar o PDF se existir
                if ($certidaoSiatu->getPdfDivida()) {
                    $certidaoSupp->setPdfDivida($certidaoSiatu->getPdfDivida());
                }

                // Persistir o novo CdaSupp
                $em->persist($certidaoSupp);
            }
        }

        // Aplicar as mudanças no banco de dados
        $em->flush();

        return new JsonResponse(['message' => 'Dados sincronizados com sucesso!'], 201);
    }
}