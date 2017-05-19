<?php
namespace MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MediaBundle\Entity\Files;

class LoadFiles extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $file1 = new Files();
        $file1->setName('Test');
        $file1->setUrl('../uploads/Publications Médias/13501807_1095236350544707_7347099321284115997_n.jpg');
        $file1->setDate(date_create(date("Y-m-d H:i:s")));
        $manager->persist($file1);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
