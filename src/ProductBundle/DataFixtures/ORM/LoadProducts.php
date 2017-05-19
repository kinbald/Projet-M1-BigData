<?php
namespace ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ProductBundle\Entity\Continent;
use ProductBundle\Entity\Country;
use ProductBundle\Entity\Delivery;
use ProductBundle\Entity\Pack;
use ProductBundle\Entity\PictureProduct;
use ProductBundle\Entity\PictureUniverse;
use ProductBundle\Entity\ProductEvaluation;
use ProductBundle\Entity\Purchase;
use ProductBundle\Entity\Range;
use ProductBundle\Entity\Spirit;
use ProductBundle\Entity\Universe;
use ProductBundle\Entity\Wine;
use ProductBundle\Entity\Recipe;
use ProductBundle\Entity\GrapeVariety;
use ProductBundle\Entity\ProductConditioning;
use ProductBundle\Entity\ProductPurchase;
use UserBundle\Entity\UserProducer;

class LoadProducts extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository("UserBundle:BaseUser")->findOneByUsername('Consumer');
        $userConsumer = $manager->getRepository("UserBundle:UserConsumer")->findOneByUsername('Consumer');
        $userProducerRepo = $manager->getRepository("UserBundle:UserProducer");


        /*-----------------------LES UNIVERS-------------------------*/
        /*-----------------------------------------------------------*/
        $universe1 = new Universe();
        $universe1->setName('Femmes et vin du monde');
        $universe1->setDescription('Sélection de femmes expertes internationales');
        $manager->persist($universe1);

        $picture = new PictureUniverse();
        $picture->setAlt('Femmes et vin du monde');
        $picture->setUrl('../uploads/Illustrations Univers/univ_femme.jpg');
        $picture->setUniverse($universe1);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe2 = new Universe();
        $universe2->setName('Femmes et vins de France');
        $universe2->setDescription('Sélection de femmes expertes internationales');
        $manager->persist($universe2);

        $picture = new PictureUniverse();
        $picture->setAlt('Femmes et vins de France');
        $picture->setUrl('../uploads/Illustrations Univers/univ_france.jpg');
        $picture->setUniverse($universe2);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe3 = new Universe();
        $universe3->setName('Femmes et spiritueux du monde');
        $universe3->setDescription('Sélection de femmes expertes internationales');
        $manager->persist($universe3);

        $picture = new PictureUniverse();
        $picture->setAlt('Femmes et spiritueux du monde');
        $picture->setUrl('../uploads/Illustrations Univers/univ_monde.jpg');
        $picture->setUniverse($universe3);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe4 = new Universe();
        $universe4->setName('Vins de terroir');
        $universe4->setDescription('Sélection d\'experts internationaux');
        $manager->persist($universe4);

        $picture = new PictureUniverse();
        $picture->setAlt('terroir');
        $picture->setUrl('../uploads/Illustrations Univers/univ_terroir.jpg');
        $picture->setUniverse($universe4);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe5 = new Universe();
        $universe5->setName('Vin de gastronomie');
        $universe5->setDescription('Sélection d\'experts internationaux');
        $manager->persist($universe5);


        $picture = new PictureUniverse();
        $picture->setAlt('gastronomie');
        $picture->setUrl('../uploads/Illustrations Univers/univ_gastronomie.jpg');
        $picture->setUniverse($universe5);
        $manager->persist($picture);

        /*-----------------------------------------------------------*/
        $universe6 = new Universe();
        $universe6->setName('Vin rosés du monde');
        $universe6->setDescription('Sélection d\'experts internationaux');
        $manager->persist($universe6);


        $picture = new PictureUniverse();
        $picture->setAlt('vin rosés');
        $picture->setUrl('../uploads/Illustrations Univers/univ_rose.jpg');
        $picture->setUniverse($universe6);
        $manager->persist($picture);


        /*-----------------------GRAPE VARIETY--------------------*/
        /*--------------------------------------------------------*/

        $grape = new GrapeVariety();
        $grape->setName("Cabernet-sauvignon");
        $manager->persist($grape);

        $grape2 = new GrapeVariety();
        $grape2->setName("Chardonnay");
        $manager->persist($grape2);

        /*-----------------------COUNTRY--------------------*/
        /*--------------------------------------------------------*/

        $country = new Country();
        $country->setName("France");
        $manager->persist($country);

        $country2 = new Country();
        $country2->setName("Espagne");
        $manager->persist($country2);

        /*-----------------------RANGE--------------------*/
        /*--------------------------------------------------------*/

        $range = new Range();
        $range->setName("Premium");
        $range->setImg("/img/product/lauriers.png");
        $manager->persist($range);

        /*-----------------------Recette--------------------*/
        /*--------------------------------------------------------*/

        $recipe = new Recipe();
        $recipe->setName("Royale de foie gras au cognac");
        $recipe->setUrl("http://www.accordeursdegoutsetdesaveurs.com/recettesnovadedi/page3.html");
        $manager->persist($recipe);





        /*-----------------------CONTINENT--------------------*/
        /*--------------------------------------------------------*/

        $continent = new Continent();
        $continent->setName("Europe");
        $manager->persist($continent);

        $continent2 = new Country();
        $continent2->setName("Asie");
        $manager->persist($continent2);

        /*-----------------------LES VINS-------------------------*/
        /*--------------------------------------------------------*/
        $wine1 = new Wine();
        $wine1->setAlcoholDegree(15);
        $wine1->setSugar(2.5);
        $wine1->setOverpressure(4.5);
        $wine1->setVintage(new \DateTime('2007-01-01 10:00:00'));
        $wine1->setColor('Rouge');
        $wine1->setName('Vin Gigondas rouge');
        $wine1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $wine1->setVolume(1.5);
        $wine1->setRegion('Var');
        $grape->addWine($wine1);
        $wine1->setOriginContinent($continent);
        $wine1->setOriginCountry($country) ;
        $wine1->setRange($range);
        $wine1->addUniverse($universe1);
        $wine1->addUniverse($universe3);
        $producer1 = $userProducerRepo->findOneByCompanyName("Vin & co");
        $wine1->setProducer($producer1);

        $manager->persist($wine1);
        $picture = new PictureProduct();
        $picture->setProduct($wine1);
        $picture->setAlt('vin');
        $picture->setUrl('../uploads/Illustration Vins/vin_gigondas_rouge_2007.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine2 = new Wine();
        $wine2->setAlcoholDegree(15);
        $wine2->setSugar(2.5);
        $wine1->setOverpressure(0);
        $wine2->setVintage(new \DateTime('2012-01-01 10:00:00'));
        $wine2->setColor('Rouge');
        $wine2->setName('Vin Montauriol rouge');
        $wine2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $wine2->setVolume(1.5);
        $wine2->setRegion('Var');
        $grape->addWine($wine2);
        $wine2->setOriginContinent($continent);
        $wine2->setOriginCountry($country) ;
        $wine2->setRange($range);
        $wine2->addUniverse($universe1);
        $wine2->addRecipe($recipe);
        $manager->persist($wine2);

        $picture = new PictureProduct();
        $picture->setProduct($wine2);
        $picture->setAlt('vin');
        $picture->setUrl('../uploads/Illustration Vins/Vin_Montauriol.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine3 = new Wine();
        $wine3->setAlcoholDegree(15);
        $wine3->setSugar(2.5);
        $wine3->setVintage(new \DateTime('2015-01-01 10:00:00'));
        $wine3->setColor('Rose');
        $wine3->setName('Vin rosé méditerrannéen');
        $wine3->setDisplayName('Mer Rose');
        $wine3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $wine3->setVolume(0.7);
        $wine3->setRegion('Var');
        $grape->addWine($wine3);
        $wine3->setOriginContinent($continent);
        $wine3->setOriginCountry($country) ;
        $wine3->setRange($range);
        $wine3->addUniverse($universe1);
        $wine3->addRecipe($recipe);
        $manager->persist($wine3);

        $picture = new PictureProduct();
        $picture->setProduct($wine3);
        $picture->setAlt('rose');
        $picture->setUrl('../uploads/Illustration Vins/ocean_rose.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $wine4 = new Wine();
        $wine4->setAlcoholDegree(15);
        $wine4->setSugar(2.5);
        $wine4->setVintage(new \DateTime('2014-01-01 10:00:00'));
        $wine4->setColor('Rose');
        $wine4->setName('Chateau Toulon');
        $wine4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $wine4->setVolume(0.3);
        $wine4->setRegion('Var');
        $grape->addWine($wine4);
        $wine4->setOriginContinent($continent);
        $wine4->setOriginCountry($country) ;
        $wine4->setRange($range);
        $wine4->addUniverse($universe2);
        $manager->persist($wine4);

        $picture = new PictureProduct();
        $picture->setProduct($wine4);
        $picture->setAlt('rose');
        $picture->setUrl('../uploads/Illustration Vins/rose_jeroboam_chateau_les_crostes.jpg');
        $manager->persist($picture);

        /*-------------------LES SPIRITUEUX-----------------------*/
        /*--------------------------------------------------------*/
        $spiritueux1 = new Spirit();
        $spiritueux1->setAlcoholDegree(50);
        $spiritueux1->setSugar(2.5);
        $spiritueux1->setName('Absolute vodka');
        $spiritueux1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $spiritueux1->setVolume(1);
        $spiritueux1->addUniverse($universe5);
        $spiritueux1->addUniverse($universe6);
        $manager->persist($spiritueux1);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux1);
        $picture->setAlt('vodka');
        $picture->setUrl('../uploads/Illustrations Spiritueux/Absolut_vodka_100.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux2 = new Spirit();
        $spiritueux2->setAlcoholDegree(40);
        $spiritueux2->setSugar(2.5);
        $spiritueux2->setName('Canadian Whisky');
        $spiritueux2->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $spiritueux2->setVolume(0.7);
        $spiritueux2->addUniverse($universe5);
        $spiritueux2->addUniverse($universe6);
        $manager->persist($spiritueux2);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux2);
        $picture->setAlt('whisky');
        $picture->setUrl('../uploads/Illustrations Spiritueux/aged_canadian_whisky.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux3 = new Spirit();
        $spiritueux3->setAlcoholDegree(40);
        $spiritueux3->setSugar(2.5);
        $spiritueux3->setName('Belvedere vodka');
        $spiritueux3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $spiritueux3->setVolume(0.7);
        $spiritueux3->addUniverse($universe5);
        $spiritueux3->addUniverse($universe6);
        $manager->persist($spiritueux3);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux3);
        $picture->setAlt('vodka');
        $picture->setUrl('../uploads/Illustrations Spiritueux/belvedere_unfiltered_vodka.jpg 	');
        $manager->persist($picture);
        /*--------------------------------------------------------*/
        $spiritueux4 = new Spirit();
        $spiritueux4->setAlcoholDegree(40);
        $spiritueux4->setSugar(2.5);
        $spiritueux4->setName('Whisky Red Label');
        $spiritueux4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $spiritueux4->setVolume(0.7);
        $spiritueux4->addUniverse($universe5);
        $spiritueux4->addUniverse($universe6);
        $manager->persist($spiritueux4);

        $picture = new PictureProduct();
        $picture->setProduct($spiritueux4);
        $picture->setAlt('whisky');
        $picture->setUrl('../uploads/Illustrations Spiritueux/whisky-red-label.jpg');
        $manager->persist($picture);
        /*--------------------------------------------------------*/

        $purchase5 = new Purchase();
        $purchase5->setUser($user);
        $purchase5->setFirstname($user->getFirstname());
        $purchase5->setLastname($user->getLastname());
        $purchase5->setPhone('0654789654');
        $purchase5->setAddress('Avenue du Port');
        $purchase5->setCity('Hyères');
        $purchase5->setPostalCode('83400');
        $purchase5->setCountry('FR');
        $purchase5->setDone(false);
        $purchase5->setDateOrder(new \DateTime('2016-12-03 10:00:00'));
        $manager->persist($purchase5);

        $productEvaluation = new ProductEvaluation();
        $productEvaluation->setProduct($wine1);
        $productEvaluation->setUser($userConsumer);
        $productEvaluation->setMark(4);
        $productEvaluation->setDate(new \DateTime());
        $productEvaluation->setReview('On aime, dans cette cuvée, cet embonpoint généreux de notes de fleurs et de fruits frais rouges (cerise, fraise, framboise), teintées d’épices et de fumée. La texture soyeuse et sensuelle attise les papilles avec gourmandise. Dégustation octobre 2015.');
        $manager->persist($productEvaluation);
        $productEvaluation = new ProductEvaluation();
        $productEvaluation->setProduct($wine1);
        $productEvaluation->setUser($userConsumer);
        $productEvaluation->setMark(3);
        $productEvaluation->setDate(new \DateTime());
        $productEvaluation->setReview('This wine is one of the best I have ever tasted. 10/10 would have a hangover again.');
        $manager->persist($productEvaluation);
        $productEvaluation = new ProductEvaluation();
        $productEvaluation->setProduct($wine1);
        $productEvaluation->setUser($userConsumer);
        $productEvaluation->setMark(3);
        $productEvaluation->setDate(new \DateTime());
        $productEvaluation->setReview('Vin passable. Je suis très déçu de cette sélection.');
        $manager->persist($productEvaluation);

        /*-----------------------LES RECETTES---------------------*/
        /*--------------------------------------------------------*/

        $recipe = new Recipe();
        $recipe->setName("Boeuf bourguignon");
        $recipe->setUrl("http://lucbor.fr/boeuf%20bourguignon%20de%20Bernard%20Loiseau.pdf");
        $recipe->addProduct($wine1);
        $manager->persist($recipe);

        $recipe2 = new Recipe();
        $recipe2->setName("Gratin dauphinois");
        $recipe2->setUrl("https://cuisine-facile.com/divers/recette-gratin-dauphinois.pdf");
        $recipe->addProduct($wine2);
        $manager->persist($recipe2);

        /*-----------------------LES PURCHASES--------------------*/
        /*--------------------------------------------------------*/
        
        $purchase = new Purchase();
        $purchase->setFirstname($userConsumer->getFirstname());
        $purchase->setLastname($userConsumer->getLastname());
        $purchase->setPhone('0256987456');
        $purchase->setAddress("128 avenue philippe lebon");
        $purchase->setCity("Toulon");
        $purchase->setPostalCode("83000");
        $purchase->setCountry("FR");
        $purchase->setDone(true);
        $purchase->setDateOrder(new \DateTime);
        $purchase->setUser($userConsumer);
        $manager->persist($purchase);

        $purchase2 = new Purchase();
        $purchase2->setAddress("48 impasse vent dames");
        $purchase2->setCity("Istres");
        $purchase2->setPostalCode("13800");
        $purchase2->setCountry("FR");
        $purchase2->setFirstname($userConsumer->getFirstname());
        $purchase2->setLastname($userConsumer->getLastname());
        $purchase2->setPhone('0456857896');
        $purchase2->setDone(false);
        $purchase2->setDateOrder(new \DateTime);
        $purchase2->setUser($userConsumer);
        $manager->persist($purchase2);



        /*-------------------CONDITONNING TYPE--------------------*/
        /*--------------------------------------------------------*/

        $pack = new Pack();
        $pack->setName('Bouteille');
        $pack->setQuantityIn(2);
        $manager->persist($pack);

        $pack1 = new Pack();
        $pack1->setName('Cubi');
        $pack1->setQuantityIn(2);
        $manager->persist($pack1);

        $condition = new ProductConditioning();
        $condition->setName("Cagette");
        $condition->setPubPrice(45);
        $condition->setProPrice(40);
        $condition->setStock(10);
        $condition->setVolumeValue('2');
        $condition->setVolumeUnit('mL');
        $condition->setProduct($wine1);
        $manager->persist($condition);

        //$manager->persist($wine1);
        //$manager->persist($wine2);
        //$manager->persist($wine3);


        $condition2 = new ProductConditioning();
        $condition2->setName("Palette");
        $condition2->setPubPrice(125);
        $condition2->setProPrice(120);
        $condition2->setStock(10);
        $condition2->setVolumeValue('2');
        $condition2->setVolumeUnit('mL');
        $condition2->setProduct($wine2);
        $condition2->setProduct($wine1);
        $manager->persist($condition2);


        $cond1 = new ProductConditioning();
        $cond1->setName('Caisse');
        $cond1->setPubPrice(5);
        $cond1->setProPrice(3);
        $cond1->setStock(10);
        $cond1->setProduct($spiritueux1);
        $cond1->setProduct($spiritueux2);
        $pack2 = new Pack();
        $pack2->setName('back');
        $pack2->setQuantityIn(2);
        $manager->persist($pack2);
        $cond1->setPack($pack2);
        $cond1->setVolumeValue('2');
        $cond1->setVolumeUnit('L');
        $manager->persist($cond1);

        $cond2 = new ProductConditioning();
        $cond2->setName('Fut');
        $cond2->setPubPrice(10);
        $cond2->setProPrice(6);
        $cond2->setStock(20);
        $cond2->setProduct($wine3);
        $cond2->setProduct($wine4);
        $cond2->setVolumeValue('50');
        $cond2->setVolumeUnit('cL');
        $manager->persist($cond2);

        $cond3 = new ProductConditioning();
        $cond3->setName('Sac plastique');
        $cond3->setPubPrice(1);
        $cond3->setProPrice(0.5);
        $cond3->setStock(50);
        $cond3->setProduct($spiritueux1);
        $cond3->setProduct($spiritueux2);
        $cond3->setProduct($spiritueux3);
        $cond3->setProduct($spiritueux4);
        $pack3 = new Pack();
        $pack3->setName('man');
        $pack3->setQuantityIn(2);
        $manager->persist($pack3);
        $cond3->setPack($pack3);
        $cond3->setVolumeValue('200');
        $cond3->setVolumeUnit('mL');
        $manager->persist($cond3);

        $wine1->addConditioningType($condition);
        $wine2->addConditioningType($condition);
        $wine3->addConditioningType($condition);
        $wine1->addConditioningType($condition2);
        $wine2->addConditioningType($cond1);
        $wine3->addConditioningType($cond3);

        /*-------------------PRODUCT PURCHASE---------------------*/
        /*--------------------------------------------------------*/

        $productPurchase = new ProductPurchase();
        $productPurchase->setStock(1200);
        $productPurchase->setConditioningType($condition);
        $productPurchase->setPurchase($purchase);
        $manager->persist($productPurchase);

        $productPurchase = new ProductPurchase();
        $productPurchase->setStock(10);
        $productPurchase->setConditioningType($condition);
        $productPurchase->setPurchase($purchase5);
        $manager->persist($productPurchase);


        $delivery = new Delivery();
        $delivery->setName('Colissimo');
        $delivery->setPrice(12.3);
        $manager->persist($delivery);

        $delivery2 = new Delivery();
        $delivery2->setName('Camion réfrigéré');
        $delivery2->setPrice(32.1);
        $manager->persist($delivery2);

        $condition->addDelivery($delivery);
        $condition2->addDelivery($delivery);

        $cond1->addDelivery($delivery);
        $cond1->addDelivery($delivery2);

        $cond2->addDelivery($delivery);
        $cond2->addDelivery($delivery2);

        $cond3->addDelivery($delivery);


        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
