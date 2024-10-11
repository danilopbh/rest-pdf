<?php

namespace App\DataFixtures;

use App\Entity\CdaSiatu;
use App\Entity\ContribuinteSiatu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use TCPDF;

class LoadContribuinteSiatu extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pt_BR'); // Para gerar dados no formato brasileiro

        for ($i = 0; $i < 20; $i++) {
            // Criar um Contribuinte
            $contribuinte = new ContribuinteSiatu();
            $contribuinte->setNome($faker->name);
            $contribuinte->setCpf($faker->cpf(false));
            $contribuinte->setEndereco($faker->address);

            // Criar Certidões de Dívida para o Contribuinte
            for ($j = 0; $j < 3; $j++) {
                $certidao = new CdaSiatu();
                $certidao->setDescricao($faker->sentence . ' - ' . $j);
                $certidao->setDataVencimento($faker->dateTimeBetween('now', '+1 years')); // Data de vencimento correta
                $certidao->setValor($faker->randomFloat(2, 500, 10000));

                $certidao->setContribuinteSiatu($contribuinte); // Estabelecer a relação

                // Gerar o PDF com TCPDF
                $pdfContent = $this->generatePdf($certidao);

                // Codificar o conteúdo PDF em Base64
                $base64Pdf = base64_encode($pdfContent);

                // Verificar a string Base64 gerada
                dump($base64Pdf); // ou use var_dump($base64Pdf) para garantir que o conteúdo está correto

                $certidao->setPdfDivida($base64Pdf); // Armazenar o PDF codificado em Base64

                // Persistir o CdaSiatu
                $manager->persist($certidao);
            }

            $manager->persist($contribuinte);
        }

        // Persistir todos os dados no banco de dados
        $manager->flush();
    }

    private function generatePdf(CdaSiatu $certidao): string
    {
        // Criar uma nova instância do TCPDF
        $pdf = new TCPDF();

        // Definir as propriedades do PDF usando a constante correta
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema Automático');
        $pdf->SetTitle('Certidão de Dívida');
        $pdf->SetSubject('Certidão de Dívida Ativa');
        $pdf->SetKeywords('Certidão, Dívida, PDF, Sistema');

        // Adicionar uma página ao PDF
        $pdf->AddPage();

        // Definir conteúdo do PDF
        $html = '
        <h1>Certidão de Dívida Ativa</h1>
        <p><strong>Contribuinte:</strong> ' . $certidao->getContribuinteSiatu()->getNome() . '</p>
        <p><strong>CPF:</strong> ' . $certidao->getContribuinteSiatu()->getCpf() . '</p>
        <p><strong>Descrição:</strong> ' . $certidao->getDescricao() . '</p>
        <p><strong>Data de Vencimento:</strong> ' . $certidao->getDataVencimento()->format('d/m/Y') . '</p>
        <p><strong>Valor:</strong> R$ ' . number_format($certidao->getValor(), 2, ',', '.') . '</p>';

        // Escrever o HTML no PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Fechar o PDF e obter o conteúdo como string binária
        return $pdf->Output('certidao.pdf', 'S'); // 'S' indica que o conteúdo será retornado como string
    }
}