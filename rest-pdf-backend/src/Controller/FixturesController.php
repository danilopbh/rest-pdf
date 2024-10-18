<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;

class FixturesController extends AbstractController{
    #[Route('/api/data/load-fixtures', name: 'load_fixtures', methods: ['POST'])]
    public function loadFixtures(KernelInterface $kernel): JsonResponse {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        //Comando para carregar fixtures
        $input = new ArrayInput([
            'command' => 'doctrine:fixtures:load',
            '--no-interaction' => true,
        ]);

        $output = new BufferedOutput();
        $application->run($input, $output);
        $content = $output->fetch();

        return new JsonResponse(['message' => 'Fixtures carregadas com sucesso!', 'output' => $content]);
    }
}