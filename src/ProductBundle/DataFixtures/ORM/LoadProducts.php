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
        $wine1 = new Wine();
        $wine1->setVintage(new \DateTime('2007-01-01 10:00:00'));
        $wine1->setColor('Rouge');
        $wine1->setName('Vin Gigondas rouge');
        $wine1->setDescription('c\'est du vin');
        $wine1->setVolume(1.5);
        $wine1->setPrice(135.40);
        $wine1->setStock(30);
        $manager->persist($wine1);

        $picture = new PictureProduct();
        $picture->setProduct($wine1);
        $picture->setAlt('vin');
        $picture->setUrl('vin_gigondas_rouge_2007.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine2 = new Wine();
        $wine2->setVintage(new \DateTime('2012-01-01 10:00:00'));
        $wine2->setColor('Rouge');
        $wine2->setName('Vin Montauriol rouge');
        $wine2->setDescription('c\'est du vin');
        $wine2->setVolume(1.5);
        $wine2->setPrice(48.70);
        $wine2->setStock(20);
        $manager->persist($wine2);

        $picture = new PictureProduct();
        $picture->setProduct($wine2);
        $picture->setAlt('vin');
        $picture->setUrl('Vin_Montauriol.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine3 = new Wine();
        $wine3->setVintage(new \DateTime('2015-01-01 10:00:00'));
        $wine3->setColor('Rose');
        $wine3->setName('Ocean Rose');
        $wine3->setDescription('Une cuvée entre Dunes et Océan');
        $wine3->setVolume(0.7);
        $wine3->setPrice(12.70);
        $wine3->setStock(150);
        $manager->persist($wine3);

        $picture = new PictureProduct();
        $picture->setProduct($wine3);
        $picture->setAlt('rose');
        $picture->setUrl('ocean_rose.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine4 = new Wine();
        $wine4->setVintage(new \DateTime('2014-01-01 10:00:00'));
        $wine4->setColor('Rose');
        $wine4->setName('Chateau les crostes');
        $wine4->setDescription('Côtes de Provence');
        $wine4->setVolume(0.3);
        $wine4->setPrice(9.56);
        $wine4->setStock(110);
        $manager->persist($wine4);

        $picture = new PictureProduct();
        $picture->setProduct($wine4);
        $picture->setAlt('rose');
        $picture->setUrl('rose_jeroboam_chateau_les_crostes.jpg');
        $manager->persist($picture);

        /*-------------------LES SPIRITUEUX-----------------------*/
        /*--------------------------------------------------------*/
        $spiritueux1 = new Spirit();
        $spiritueux1->setAlcoholDegree(50);
        $spiritueux1->setName('Absolute vodka');
        $spiritueux1->setDescription('Absolute vodka 100 Country of Sweden');
        $spiritueux1->setVolume(1);
        $spiritueux1->setPrice(56.20);
        $spiritueux1->setStock(60);
        $manager->persist($spiritueux1);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux1);
        $picture->setAlt('vodka');
        $picture->setUrl('Absolut_vodka_100.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux2 = new Spirit();
        $spiritueux2->setAlcoholDegree(40);
        $spiritueux2->setName('Canadian Whisky');
        $spiritueux2->setDescription('Canadian Club Classic, aged 12 years whisky');
        $spiritueux2->setVolume(0.7);
        $spiritueux2->setPrice(43.15);
        $spiritueux2->setStock(35);
        $manager->persist($spiritueux2);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux2);
        $picture->setAlt('whisky');
        $picture->setUrl('aged_canadian_whisky.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux3 = new Spirit();
        $spiritueux3->setAlcoholDegree(40);
        $spiritueux3->setName('Belvedere vodka');
        $spiritueux3->setDescription('Belvedere vodka, unfiltred');
        $spiritueux3->setVolume(0.7);
        $spiritueux3->setPrice(35.45);
        $spiritueux3->setStock(59);
        $manager->persist($spiritueux3);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux3);
        $picture->setAlt('vodka');
        $picture->setUrl('belvedere_unfiltered_vodka.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux4 = new Spirit();
        $spiritueux4->setAlcoholDegree(40);
        $spiritueux4->setName('Whisky Red Label');
        $spiritueux4->setDescription('Old scotch Whisky Red Label Johnnie Walker');
        $spiritueux4->setVolume(0.7);
        $spiritueux4->setPrice(53.05);
        $spiritueux4->setStock(56);
        $manager->persist($spiritueux4);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux4);
        $picture->setAlt('whisky');
        $picture->setUrl('whisky-red-label.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/

        $purchase5 = new Purchase();
        $purchase5->setUser($user);
        $purchase5->setAddress('trololololo');
        $purchase5->setCity('Hyères');
        $purchase5->setPostalCode('83400');
        $purchase5->setCountry('FR');
        $purchase5->setDone(false);
        $purchase5->setDateOrder(new \DateTime('2016-12-03 10:00:00'));
        $manager->persist($purchase5);

        $productPurchase = new ProductPurchase();
        $productPurchase->setStock(10);
        $productPurchase->setPurchase($purchase5);
        $productPurchase->setProduct($wine1);
        $manager->persist($productPurchase);

        $productEvaluation = new ProductEvaluation();
        $productEvaluation->setProduct($wine1);
        $productEvaluation->setUser($userConsumer);
        $productEvaluation->setMark(15);
        $productEvaluation->setReview('cété trai bon lol');
        $manager->persist($productEvaluation);


        /*-----------------------LES UNIVERS-------------------------*/
        /*-----------------------------------------------------------*/
        $universe = new Universe();
        $universe->setName('Vins de femmes');
        $universe->setDescription('Vin pour femmes');
        $universe->addProduct($wine1);
        $universe->addProduct($wine2);
        $universe->addProduct($wine3);
        $manager->persist($universe);

        $picture = new PictureUniverse();
        $picture->setAlt('vin');
        $picture->setUrl('univ_femme.jpg');
        $picture->setUniverse($universe);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe = new Universe();
        $universe->setName('Vins gastronomiques');
        $universe->setDescription('Vins pour associaition à des mets');
        $universe->addProduct($wine4);
        $manager->persist($universe);

        $picture = new PictureUniverse();
        $picture->setAlt('vin');
        $picture->setUrl('univ_gastronomie.jpg');
        $picture->setUniverse($universe);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe = new Universe();
        $universe->setName('Vins du monde');
        $universe->setDescription('Vins orginaux de tout pays');
        $universe->addProduct($wine1);
        $manager->persist($universe);

        $picture = new PictureUniverse();
        $picture->setAlt('vin');
        $picture->setUrl('univ_monde.jpg');
        $picture->setUniverse($universe);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe = new Universe();
        $universe->setName('Vins rosés');
        $universe->setDescription('Vins rosés');
        $manager->persist($universe);

        $picture = new PictureUniverse();
        $picture->setAlt('vin');
        $picture->setUrl('univ_rose.jpg');
        $picture->setUniverse($universe);
        $manager->persist($picture);

         /*-----------------------------------------------------------*/
         $universe = new Universe();
         $universe->setName('Spiritueux');
         $universe->setDescription('Spiritueux');

        $universe->addProduct($spiritueux1);
        $universe->addProduct($spiritueux2);
        $universe->addProduct($spiritueux3);
        $universe->addProduct($spiritueux4);
        $manager->persist($universe);


         $picture = new PictureUniverse();
         $picture->setAlt('spiritueux');
         $picture->setUrl('univ_spiritueux.jpg');
         $picture->setUniverse($universe);
         $manager->persist($picture);












        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
