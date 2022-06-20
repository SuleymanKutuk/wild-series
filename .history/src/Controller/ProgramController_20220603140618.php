<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Program;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProgramController extends AbstractController
{

    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs,
        ]);
    }

    #[Route('/program/{id}', requirements: ['page' => '\d+'], methods: ['GET'], name: 'program_show')]
    public function show(int $id, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response

    {
        $program = $programRepository->findOneBy(['id' => $id]);
        $seasons = $program->getSeasons();

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        }
        if (!$seasons) {
            throw $this->createNotFoundException(
                'No season with id : ' . $seasons . ' found in seasons\'s table.'
            );
        }

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons
        ]);
    }

    #[Route('program/‘{programId}/seasons/{seasonId}', methods: ['GET'], name: 'program_season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository)
    {
        $program = $programRepository->findOneBy(['id' => $programId]);

        $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        $episodes = $episodeRepository->findBy(['season' => $season]);

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes
        ]);
    }

    #[Route('/program/{programId}/season/{seasonId}/episode/{episodeId}', methods: ['GET'], name: 'program_episode_show')]
    #[ParamConverter('program', options: ['mapping' => ['programId' => 'id']])]
    #[ParamConverter('season', options: ['mapping' => ['seasonId' => 'id']])]
    #[ParamConverter('episode', options: ['mapping' => ['episodeId' => 'id']])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {

        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode


        ]);
    }
}