<?php

namespace App\Controller;

use App\Entity\CdaSiatu;
use App\Entity\CdaSupp;
use App\Entity\ContribuinteSiatu;
use App\Entity\ContribuinteSupp;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use TCPDF;

class ApiSuppController extends AbstractController
{
    #[Route('/api/supp', name: 'api_supp_post', methods: ['POST'])]
    public function postSuppData(Request $request, EntityManagerInterface $em): JsonResponse
    {
        // Decodificar a requisição JSON
        $data = json_decode($request->getContent(), true);

        // Verificar se o payload contém os dados necessários
        if (!$data || !isset($data['contribuinte']) || !isset($data['certidoes'])) {
            return new JsonResponse(['error' => 'Dados incompletos'], 400);
        }

        // Criar uma nova instância de ContribuinteSupp
        $contribuinte = new ContribuinteSupp();
        $contribuinte->setNome($data['contribuinte']['nome']);
        $contribuinte->setCpf($data['contribuinte']['cpf']);
        $contribuinte->setEndereco($data['contribuinte']['endereco']);

        // Persistir o Contribuinte
        $em->persist($contribuinte);

        // Criar as certidões associadas ao Contribuinte
        foreach ($data['certidoes'] as $certidaoData) {
            $certidao = new CdaSupp();
            $certidao->setDescricao($certidaoData['descricao']);
            $certidao->setDataVencimento(new \DateTime($certidaoData['dataVencimento']));
            $certidao->setValor($certidaoData['valor']);
            $certidao->setContribuinteSupp($contribuinte);

            // Verificar se há conteúdo em base64 para o PDF, caso contrário, gerar o PDF generico
            if (isset($certidaoData['pdfDivida'])) {
                $pdfContent = base64_decode($certidaoData['pdfDivida']);
                //$certidao->setPdfDivida($pdfContent);
            } else {
                //Gerar PDF genérico se não houver um PDF fornecido
                $pdfContent = $this->generateDefaultPdf($certidao);
            }

            //Codificar o PDF como Base64 antes de salvar no banco
            $certidao->setPdfDivida(base64_encode($pdfContent));

            // Persistir cada certidão
            $em->persist($certidao);
        }

        // Aplicar todas as mudanças no banco de dados
        $em->flush();

        return new JsonResponse(['message' => 'Dados salvos com sucesso'], 201);
    }

    private function generateDefaultPdf(CdaSupp $certidao): string
    {
        $pdf = new TCPDF();
        $pdf->AddPage();

        // Definir o conteúdo do PDF com informações padrão ou genéricas
        $html = '
        <h1>Certidão Padrão</h1>
        <p><strong>Descrição:</strong> ' . $certidao->getDescricao() . '</p>
        <p><strong>Valor:</strong> R$ ' . number_format($certidao->getValor(), 2, ',', '.') . '</p>';

        $pdf->writeHTML($html);

        return $pdf->Output('certidao.pdf', 'S');
    }

    #[Route('/export/pdf/{id}', name: 'export_pdf', methods: ['GET'])]
    public function exportPdfAction(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        //Tenta encontrar a certidão pelo ID
        $certidao = $em->getRepository(CdaSupp::class)->find($id);

        if (!$certidao) {
            throw $this->createNotFoundException('Certidão não encontrada.');
        }

        //Chama o método para exportar e salvar o PDF
        return $this->exportPdf($certidao);
    }

    public function exportPdf(CdaSupp $certidao): Response
    {
        //Decodificar o conteúdo Base64 do campo pdfDivida
        $pdfContent = base64_decode($certidao->getPdfDivida());

        //Verificar se o diretório existe, se não, criar
        $directory = '/home/isaac/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true); //Permissões para criar a pasta
        }

        //Definir o nome do arquivo com base no ID ou outro atríbuto
        $filePath = $directory . 'certidão_' . $certidao->getId() . '.pdf';

        //SAlvar o conteúdo binário no arquivo
        file_put_contents($filePath, $pdfContent);

        // Definir cabeçalhos para o download do PDF
        $response = new Response($pdfContent);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="certidao_' . $certidao->getId() . '.pdf"');
        $response->headers->set('Content-Length', strlen($pdfContent));

        //Exibir uma mensagem de sucesso (opcional)
        echo "PDF exportado e salvo em: " . $filePath;

        return $response; //Retorna o pdf como resposta
    }

    #[Route('/api/data', name: 'get_data', methods: ['GET', 'OPTIONS'])]
    public function getData(EntityManagerInterface $entityManager): JsonResponse {
        // Obtenha os dados de cada tabela
        $cdaSiatuData = $entityManager->getRepository(CdaSiatu::class)->findAll();
        $contribuinteSiatuData = $entityManager->getRepository(ContribuinteSiatu::class)->findAll();
        $cdaSuppData = $entityManager->getRepository(CdaSupp::class)->findAll();
        $contribuinteSuppData = $entityManager->getRepository(ContribuinteSupp::class)->findAll();
    
        // Serializar os dados em arrays
        $cdaSiatuArray = array_map(fn($cda) => $this->serializeCda($cda), $cdaSiatuData);
        $contribuinteSiatuArray = array_map(fn($contribuinte) => $this->serializeContribuinte($contribuinte), $contribuinteSiatuData);
        $cdaSuppArray = array_map(fn($cda) => $this->serializeCda($cda), $cdaSuppData);
        $contribuinteSuppArray = array_map(fn($contribuinte) => $this->serializeContribuinte($contribuinte), $contribuinteSuppData);
    
        // Retorne os dados serializados em JSON
        return new JsonResponse([
            'cda_siatu' => $cdaSiatuArray,
            'contribuinte_siatu' => $contribuinteSiatuArray,
            'cda_supp' => $cdaSuppArray,
            'contribuinte_supp' => $contribuinteSuppArray,
        ]);
    }
    
    // Ajuste para aceitar tanto CdaSiatu quanto CdaSupp
    private function serializeCda(CdaSiatu|CdaSupp $cda): array {
        return [
            'id' => $cda->getId(),
            'descricao' => $cda->getDescricao(),
            'dataVencimento' => $cda->getDataVencimento() instanceof \DateTimeInterface ? $cda->getDataVencimento()->format('d-m-Y') : null,
            'valor' => $cda->getValor(),
            'pdfDivida' => $cda->getPdfDivida() ? base64_encode($cda->getPdfDivida()) : null,
        ];
    }
    
    // Função para serializar os dados de ContribuinteSiatu e ContribuinteSupp (mesma estrutura)
    private function serializeContribuinte(ContribuinteSiatu|ContribuinteSupp $contribuinte): array {
        return [
            'id' => $contribuinte->getId(),
            'nome' => $contribuinte->getNome(),
            'cpf' => $contribuinte->getCpf(),
            'endereco' => $contribuinte->getEndereco(),
        ];
    }
}