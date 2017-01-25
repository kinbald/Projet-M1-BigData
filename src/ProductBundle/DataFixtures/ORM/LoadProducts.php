<?php
namespace ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProductBundle\Entity\PictureProduct;
use ProductBundle\Entity\PictureUniverse;
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


        /*-----------------------LES VINS-------------------------*/
        /*--------------------------------------------------------*/
        $wine = new Wine();
        $wine->setVintage(new \DateTime('2007-01-01 10:00:00'));
        $wine->setColor('Rouge');
        $wine->setName('Vin Gigondas rouge');
        $wine->setDescription('c\'est du vin');
        $wine->setVolume(1.5);
        $wine->setPrice(135.40);
        $wine->setStock(30);
        $manager->persist($wine);

        $picture = new PictureProduct();
        $picture->setProduct($wine);
        $picture->setAlt('vin');
        $picture->setUrl('vin_gigondas_rouge_2007.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine = new Wine();
        $wine->setVintage(new \DateTime('2012-01-01 10:00:00'));
        $wine->setColor('Rouge');
        $wine->setName('Vin Montauriol rouge');
        $wine->setDescription('c\'est du vin');
        $wine->setVolume(1.5);
        $wine->setPrice(48.70);
        $wine->setStock(20);
        $manager->persist($wine);

        $picture = new PictureProduct();
        $picture->setProduct($wine);
        $picture->setAlt('vin');
        $picture->setUrl('Vin_Montauriol.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine = new Wine();
        $wine->setVintage(new \DateTime('2015-01-01 10:00:00'));
        $wine->setColor('Rose');
        $wine->setName('Ocean Rose');
        $wine->setDescription('Une cuvée entre Dunes et Océan');
        $wine->setVolume(0.7);
        $wine->setPrice(12.70);
        $wine->setStock(150);
        $manager->persist($wine);

        $picture = new PictureProduct();
        $picture->setProduct($wine);
        $picture->setAlt('rose');
        $picture->setUrl('ocean_rose.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine = new Wine();
        $wine->setVintage(new \DateTime('2014-01-01 10:00:00'));
        $wine->setColor('Rose');
        $wine->setName('Chateau les crostes');
        $wine->setDescription('Côtes de Provence');
        $wine->setVolume(0.3);
        $wine->setPrice(9.56);
        $wine->setStock(110);
        $manager->persist($wine);

        $picture = new PictureProduct();
        $picture->setProduct($wine);
        $picture->setAlt('rose');
        $picture->setUrl('rose_jeroboam_chateau_les_crostes.jpg');
        $manager->persist($picture);

        /*-------------------LES SPIRITUEUX-----------------------*/
        /*--------------------------------------------------------*/
        $spiritueux = new Spirit();
        $spiritueux->setAlcoholDegree(50);
        $spiritueux->setName('Absolute vodka');
        $spiritueux->setDescription('Absolute vodka 100 Country of Sweden');
        $spiritueux->setVolume(1);
        $spiritueux->setPrice(56.20);
        $spiritueux->setStock(60);
        $manager->persist($spiritueux);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux);
        $picture->setAlt('vodka');
        $picture->setUrl('Absolut_vodka_100.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux = new Spirit();
        $spiritueux->setAlcoholDegree(40);
        $spiritueux->setName('Canadian Whisky');
        $spiritueux->setDescription('Canadian Club Classic, aged 12 years whisky');
        $spiritueux->setVolume(0.7);
        $spiritueux->setPrice(43.15);
        $spiritueux->setStock(35);
        $manager->persist($spiritueux);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux);
        $picture->setAlt('whisky');
        $picture->setUrl('aged_canadian_whisky.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux = new Spirit();
        $spiritueux->setAlcoholDegree(40);
        $spiritueux->setName('Belvedere vodka');
        $spiritueux->setDescription('Belvedere vodka, unfiltred');
        $spiritueux->setVolume(0.7);
        $spiritueux->setPrice(35.45);
        $spiritueux->setStock(59);
        $manager->persist($spiritueux);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux);
        $picture->setAlt('vodka');
        $picture->setUrl('belvedere_unfiltered_vodka.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux = new Spirit();
        $spiritueux->setAlcoholDegree(40);
        $spiritueux->setName('Whisky Red Label');
        $spiritueux->setDescription('Old scotch Whisky Red Label Johnnie Walker');
        $spiritueux->setVolume(0.7);
        $spiritueux->setPrice(53.05);
        $spiritueux->setStock(56);
        $manager->persist($spiritueux);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux);
        $picture->setAlt('whisky');
        $picture->setUrl('whisky-red-label.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/

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
        $productEvaluation->setReview('cété trai bon lol');
        $manager->persist($productEvaluation);


        /*-----------------------LES UNIVERS-------------------------*/
        /*-----------------------------------------------------------*/
        $universe = new Universe();
        $universe->setName('vinasse de femelle');
        $universe->setDescription('blabla');
        $manager->persist($universe);

        $picture = new PictureUniverse();
        $picture->setAlt('vin');
        $picture->setUrl('univ_femme.jpg');
        $picture->setUniverse($universe);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe = new Universe();
        $universe->setName('Vin a Gastro');
        $universe->setDescription('blabla');
        $manager->persist($universe);

        $picture = new PictureUniverse();
        $picture->setAlt('vin');
        $picture->setUrl('univ_gastronomie.jpg');
        $picture->setUniverse($universe);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe = new Universe();
        $universe->setName('Vin étranger');
        $universe->setDescription('blabla');
        $manager->persist($universe);

        $picture = new PictureUniverse();
        $picture->setAlt('vin');
        $picture->setUrl('univ_monde.jpg');
        $picture->setUniverse($universe);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe = new Universe();
        $universe->setName('Vin rose');
        $universe->setDescription('blabla');
        $manager->persist($universe);

        $picture = new PictureUniverse();
        $picture->setAlt('vin');
        $picture->setUrl('univ_rose.jpg');
        $picture->setUniverse($universe);
        $manager->persist($picture);





        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
