<?php
namespace ConcoursBundle\DataFixtures\ORM;

use ConcoursBundle\Entity\Competition;
use ConcoursBundle\Entity\CompetitionWine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCompetitions extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $wine = $manager->getRepository("ProductBundle:Wine")->findOneByColor('Rouge');

        $competition = new Competition();
        $competition->setName('Concours 01');
        $competition->setDescription('Concours vin');
        $competition->setDateCompetition(new \DateTime('2017-04-01 10:00:00'));
        $manager->persist($competition);

        $competitionWine = new CompetitionWine();
        $competitionWine->setCompetition($competition);
        $competitionWine->setPrimeName('Vin de qualité');
        $competitionWine->setWine($wine);
        $manager->persist($competitionWine);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}