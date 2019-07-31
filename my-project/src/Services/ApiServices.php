<?php


namespace App\Services;


use App\Entity\Champ;
use App\Repository\ChampRepository;
use App\Repository\InformationsRepository;
use App\Repository\RoleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpClient\HttpClient;

class ApiServices
{

    /**
     * @var ChampRepository
     */
    private $champRepository;
    /**
     * @var InformationsRepository
     */
    private $informationsRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ChampRepository $champRepository,
                                InformationsRepository $informationsRepository,
                                RoleRepository $roleRepository, ObjectManager $objectManager)
    {
        $this->champRepository = $champRepository;
        $this->informationsRepository = $informationsRepository;
        $this->roleRepository = $roleRepository;
        $this->objectManager = $objectManager;

    }

    public function index()
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'http://ddragon.leagueoflegends.com/cdn/9.3.1/data/fr_FR/champion.json');

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();

        foreach ($content['data'] as $apichampion) {

            if (!$this->champRepository->findByName($apichampion['name'])) {
                $champ = new Champ;
                $champ->setName($apichampion['name']);
                $champ->setTitle($apichampion['title']);
                $champ->setDescription($apichampion['blurb']);
                $champ->setRessource($apichampion['partype']);
                $this->objectManager->persist($champ);
                $this->objectManager->flush();
            }


            // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        }

    }
}