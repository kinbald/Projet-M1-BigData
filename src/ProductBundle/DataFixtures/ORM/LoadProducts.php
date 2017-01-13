<?php
namespace ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProductBundle\Entity\ProductEvaluation;
use ProductBundle\Entity\ProductPurchase;
use ProductBundle\Entity\Purchase;
use ProductBundle\Entity\Spirit;
use ProductBundle\Entity\Universe;
use ProductBundle\Entity\Wine;

class LoadProducts extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository("UserBundle:BaseUser")->findOneByUsername('Consumer');
        $userConsumer = $manager->getRepository("UserBundle:UserConsumer")->findOneByUsername('Consumer');

        $userAdmin = new Universe();
        $userAdmin->setName('rouge');
        $userAdmin->setDescription('Bah c\'est rouge quoi');
        $manager->persist($userAdmin);

        $wine = new Wine();
        $wine->setVintage(new \DateTime('2014-05-03 10:00:00'));
        $wine->setColor('Violet');
        $wine->setName('Beau je l\'ai');
        $wine->setDescription('des scripts scions');
        $wine->setVolume(1.5);
        $wine->setPrice(35.40);
        $wine->setStock(230);
        $manager->persist($wine);

        $spiritueux = new Spirit();
        $spiritueux->setAlcoholDegree(43.5);
        $spiritueux->setName('Vodka');
        $spiritueux->setDescription('Lydia aime ça');
        $spiritueux->setVolume(2.35);
        $spiritueux->setPrice(22.65);
        $spiritueux->setStock(20);
        $manager->persist($spiritueux);

        $purchase = new Purchase();
        $purchase->setUser($user);
        $purchase->setAddress('trololololo');
        $purchase->setCity('Hyères');
        $purchase->setPostalCode('83400');
        $purchase->setCountry('FR');
        $purchase->setDone(false);
        $purchase->setDateOrder(new \DateTime('2016-12-03 10:00:00'));
        $manager->persist($purchase);

        $productPurchase = new ProductPurchase();
        $productPurchase->setStock(10);
        $productPurchase->setPurchase($purchase);
        $productPurchase->setProduct($wine);
        $manager->persist($productPurchase);

        $productEvaluation = new ProductEvaluation();
        $productEvaluation->setProduct($wine);
        $productEvaluation->setUser($userConsumer);
        $productEvaluation->setMark(15);
        $productEvaluation->setReview('cété trai bon');
        $manager->persist($productEvaluation);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
