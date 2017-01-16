<?php
namespace ContractBundle\DataFixtures\ORM;

use ContractBundle\Entity\OptionSubscription;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ContractBundle\Entity\Option;

class LoadContract extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository("UserBundle:UserProducer")->findOneByCompanyName('Bitonnet de poisson & co');

        $option = new Option();
        $option->setName('option test');
        $option->setDescription('Bah c\'est une option quoi');
        $option->setPrice(50.45);

        $optionSubscription = new OptionSubscription();
        $optionSubscription->setDateSubscription(new \DateTime('2017-01-01 10:00:00'));
        $optionSubscription->setOption($option);
        $optionSubscription->setUser($user);

        $manager->persist($option);
        $manager->persist($optionSubscription);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
