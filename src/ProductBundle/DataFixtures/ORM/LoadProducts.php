<?php
namespace ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProductBundle\Entity\PictureProduct;
use ProductBundle\Entity\PictureUniverse;
use ProductBundle\Entity\ProductEvaluation;
use ProductBundle\Entity\Purchase;
use ProductBundle\Entity\Spirit;
use ProductBundle\Entity\Universe;
use ProductBundle\Entity\Wine;
use ProductBundle\Entity\Recipe;
use ProductBundle\Entity\GrapeVariety;
use ProductBundle\Entity\ConditioningType;
use ProductBundle\Entity\ProductPurchase;

class LoadProducts extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository("UserBundle:BaseUser")->findOneByUsername('Consumer');
        $userConsumer = $manager->getRepository("UserBundle:UserConsumer")->findOneByUsername('Consumer');

        /*-------------------LES CONDITIONNEMENTS--------------------*/
        /*-----------------------------------------------------------*/
        $cond1 = new ConditioningType();
        $cond1->setName('Caisse');
        $cond1->setPrice(5);
        $manager->persist($cond1);

        $cond2 = new ConditioningType();
        $cond2->setName('Fût');
        $cond2->setPrice(10);
        $manager->persist($cond2);

        $cond3 = new ConditioningType();
        $cond3->setName('Sac plastique');
        $cond3->setPrice(1);
        $manager->persist($cond3);


        /*-----------------------LES UNIVERS-------------------------*/
        /*-----------------------------------------------------------*/
        $universe1 = new Universe();
        $universe1->setName('Femmes et vin du monde');
        $universe1->setDescription('Sélection de femmes expertes internationales');
        $manager->persist($universe1);

        $picture = new PictureUniverse();
        $picture->setAlt('Femmes et vin du monde');
        $picture->setUrl('univ_femme.jpg');
        $picture->setUniverse($universe1);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe2 = new Universe();
        $universe2->setName('Femmes et vin de France');
        $universe2->setDescription('Sélection de femmes expertes internationales');
        $manager->persist($universe2);

        $picture = new PictureUniverse();
        $picture->setAlt('Femmes et vin de France');
        $picture->setUrl('univ_france.jpg');
        $picture->setUniverse($universe2);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe3 = new Universe();
        $universe3->setName('Femmes et spiritueux du monde');
        $universe3->setDescription('Sélection de femmes expertes internationales');
        $manager->persist($universe3);

        $picture = new PictureUniverse();
        $picture->setAlt('Femmes et spiritueux du monde');
        $picture->setUrl('univ_monde.jpg');
        $picture->setUniverse($universe3);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe4 = new Universe();
        $universe4->setName('Vins de terroir');
        $universe4->setDescription('Sélection d\'experts internationaux');
        $manager->persist($universe4);

        $picture = new PictureUniverse();
        $picture->setAlt('terroir');
        $picture->setUrl('univ_terroir.jpg');
        $picture->setUniverse($universe4);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe5 = new Universe();
        $universe5->setName('Vin de gastronomie');
        $universe5->setDescription('Sélection d\'experts internationaux');
        $manager->persist($universe5);


        $picture = new PictureUniverse();
        $picture->setAlt('gastronomie');
        $picture->setUrl('univ_gastronomie.jpg');
        $picture->setUniverse($universe5);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe6 = new Universe();
        $universe6->setName('Vin rosés du monde');
        $universe6->setDescription('Sélection d\'experts internationaux');
        $manager->persist($universe6);


        $picture = new PictureUniverse();
        $picture->setAlt('vin rosés');
        $picture->setUrl('univ_rose.jpg');
        $picture->setUniverse($universe6);
        $manager->persist($picture);


        /*-----------------------LES VINS-------------------------*/
        /*--------------------------------------------------------*/
        $wine1 = new Wine();
        $wine1->setVintage(new \DateTime('2007-01-01 10:00:00'));
        $wine1->setColor('Rouge');
        $wine1->setName('Vin Gigondas rouge');
        $wine1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $wine1->setVolume(1.5);
        $wine1->setPrice(135.40);
        $wine1->setStock(30);
        $wine1->addUniverse($universe1);
        $wine1->addUniverse($universe3);
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
        $wine2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $wine2->setVolume(1.5);
        $wine2->setPrice(48.70);
        $wine2->setStock(20);
        $wine2->addUniverse($universe1);
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
        $wine3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $wine3->setVolume(0.7);
        $wine3->setPrice(12.70);
        $wine3->setStock(150);
        $wine3->addUniverse($universe1);
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
        $wine4->setName('Chateau Toulon');
        $wine4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $wine4->setVolume(0.3);
        $wine4->setPrice(9.56);
        $wine4->setStock(110);
        $wine4->addUniverse($universe2);
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
        $spiritueux1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $spiritueux1->setVolume(1);
        $spiritueux1->setPrice(56.20);
        $spiritueux1->setStock(60);
        $spiritueux1->addUniverse($universe5);
        $spiritueux1->addUniverse($universe6);
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
        $spiritueux2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $spiritueux2->setVolume(0.7);
        $spiritueux2->setPrice(43.15);
        $spiritueux2->setStock(35);
        $spiritueux2->addUniverse($universe5);
        $spiritueux2->addUniverse($universe6);
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
        $spiritueux3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $spiritueux3->setVolume(0.7);
        $spiritueux3->setPrice(35.45);
        $spiritueux3->setStock(59);
        $spiritueux3->addUniverse($universe5);
        $spiritueux3->addUniverse($universe6);
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
        $spiritueux4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $spiritueux4->setVolume(0.7);
        $spiritueux4->setPrice(53.05);
        $spiritueux4->setStock(56);
        $spiritueux4->addUniverse($universe5);
        $spiritueux4->addUniverse($universe6);
        $manager->persist($spiritueux4);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux4);
        $picture->setAlt('whisky');
        $picture->setUrl('whisky-red-label.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/

        $purchase5 = new Purchase();
        $purchase5->setUser($user);
        $purchase5->setAddress('Avenue du Port');
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
        $productPurchase->setConditioningType($cond1);
        $manager->persist($productPurchase);

        $productEvaluation = new ProductEvaluation();
        $productEvaluation->setProduct($wine1);
        $productEvaluation->setUser($userConsumer);
        $productEvaluation->setMark(15);
        $productEvaluation->setReview('Vin de très bonne qualité, je le recommande');
        $manager->persist($productEvaluation);

        /*-----------------------LES RECETTES---------------------*/
        /*--------------------------------------------------------*/

        $recipe = new Recipe();
        $recipe->setName("Boeuf bourguignon");
        $recipe->setUrl("http://lucbor.fr/boeuf%20bourguignon%20de%20Bernard%20Loiseau.pdf");
        $manager->persist($recipe);

        $recipe2 = new Recipe();
        $recipe2->setName("Gratin dauphinois");
        $recipe2->setUrl("https://cuisine-facile.com/divers/recette-gratin-dauphinois.pdf");
        $manager->persist($recipe2);

        /*-----------------------LES PURCHASES--------------------*/
        /*--------------------------------------------------------*/
        
        $purchase = new Purchase();
        $purchase->setAddress("128 avenue philippe lebon");
        $purchase->setCity("Toulon");
        $purchase->setPostalCode("83000");
        $purchase->setCountry("France");
        $purchase->setDone(true);
        $purchase->setDateOrder(new \DateTime);
        $purchase->setUser($userConsumer);
        $manager->persist($purchase);

        $purchase2 = new Purchase();
        $purchase2->setAddress("48 impasse vent dames");
        $purchase2->setCity("Istres");
        $purchase2->setPostalCode("13800");
        $purchase2->setCountry("France");
        $purchase2->setDone(false);
        $purchase2->setDateOrder(new \DateTime);
        $purchase2->setUser($userConsumer);
        $manager->persist($purchase2);

        /*-----------------------GRAPE VARIETY--------------------*/
        /*--------------------------------------------------------*/

        $grape = new GrapeVariety();
        $grape->setName("Cabernet-sauvignon");
        $manager->persist($grape);

        $grape2 = new GrapeVariety();
        $grape2->setName("Chardonnay");
        $manager->persist($grape2);

        /*-------------------CONDITONNING TYPE--------------------*/
        /*--------------------------------------------------------*/
        
        $condition = new ConditioningType();
        $condition->setName("Caisse");
        $condition->setPrice(45);
        $manager->persist($condition);
        
        $condition2 = new ConditioningType();
        $condition2->setName("Palette");
        $condition2->setPrice(125);
        $manager->persist($condition2);

        /*-------------------PRODUCT PURCHASE---------------------*/
        /*--------------------------------------------------------*/
        
        $propur = new ProductPurchase();
        $propur->setStock(1200);
        $propur->setConditioningType($condition);
        $propur->setProduct($wine3);
        $propur->setPurchase($purchase);
        $manager->persist($propur);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
