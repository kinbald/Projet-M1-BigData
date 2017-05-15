<?php
/**
 * Created by PhpStorm.
 * User: pfdenys
 * Date: 12/05/17
 * Time: 10:45
 */

namespace AdminBundle\Service;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityManager;
use ConcoursBundle\Entity\CompetitionProduct;
use ProductBundle\Entity\Continent;
use ProductBundle\Entity\Country;
use ProductBundle\Entity\Delivery;
use ProductBundle\Entity\Pack;
use ProductBundle\Entity\ProductConditioning;
use ProductBundle\Entity\Range;
use ProductBundle\Entity\Recipe;
use ProductBundle\Entity\Spirit;
use ProductBundle\Entity\Wine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use ProductBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;
use UserBundle\Entity\ProducerStatus;
use UserBundle\Entity\UserProducer;
use PHPExcel;
use PHPExcel_IOFactory;


class Excel
{
    private $em;

    public function __construct(Router $router, $env, EntityManager $em)
    {
        //initialisation des services
        $this->em = $em;
        $this->router = $router;
    }



    public function sanitize_data_medal(array $medal, array $row)
    {

        foreach ($medal as $keyMedal => $arrayMedal) {
            if (!preg_match('/^d{1}$/', $arrayMedal[1])) { //Si il y a plusieurs codes médailles dans la case
                $CodeMedalSplitTemp = explode(",", $arrayMedal[1]); // on les sépare dans un tableau temporaire
                foreach ($CodeMedalSplitTemp as $keySplitMedal => $ArrayMedal) { //on insère les lignes splitées dans le tableau de base
                    array_push($medal, array($arrayMedal[0], $ArrayMedal, $arrayMedal[2]));
                }
                unset($medal[$keyMedal]); // On supprime l'ancienne ligne avec doublon
            }
            else{

            }
        }
        return $medal;
    }


    public function sanitize_data_shipoptions(array $shipmentsOptions, array $row)
    {
        foreach ($shipmentsOptions as $keyOptions => $arrayOptions) {

            $OptionsSplitTemp = explode(", ", $arrayOptions[1]); // on sépare les options de livraison dans un tableau temporaire
            $PriceSplitTemp = explode("|", $arrayOptions[2]); // on sépare les prix de livraison dans un tableau temporaire
            foreach ($OptionsSplitTemp as $keySplitTemp => $ArrayTemp) { //on insère les lignes splitées dans le tableau de base
                array_push($shipmentsOptions, array($arrayOptions[0], $ArrayTemp, $PriceSplitTemp[$keySplitTemp], $arrayOptions[3]));
            }
            unset($shipmentsOptions[$keyOptions]); // On supprime l'ancienne ligne avec doublon

        }
        return $shipmentsOptions;
    }



    public function insert_product_data(array $DataProduct)
    {

        foreach ($DataProduct as $keyProductAdd => $ArrayAdd) {

            $TempCountry = new Country();
            $TempContinent= new Continent();
            $TempRange = new Range();
            $Recette = new Recipe();


            $country = $this->em->getRepository("ProductBundle:Country")->findByName($DataProduct[$keyProductAdd][5]); // On recherche tous les pays existants en BDD
            if (!empty($country)) {
                $TempCountry = $country[0];
            }
            else{
                $TempCountry = new Country();
                $TempCountry->setName($DataProduct[$keyProductAdd][5]);
                $this->em->persist($TempCountry);
                $this->em->flush();
            }


            $continent = $this->em->getRepository("ProductBundle:Continent")->findByName('Europe'); // On recherche tous les continents existants en BDD
            if (!empty($continent)) {
                $TempContinent = $continent[0];
            }
            else{
                $TempContinent= new Continent();
                $TempContinent->setName('Europe');
                $this->em->persist($TempContinent);
                $this->em->flush();
            }


            $range = $this->em->getRepository("ProductBundle:Range")->findByName('Premiumfd'); // On recherche tous les ranges existants en BDD
            if (!empty($range)) {
                $TempRange = $range[0];
            }
            else{
                $TempRange = new Range();
                $TempRange->setName('Premiumfd');
                $TempRange->setImg('Premiumfd');
                $this->em->persist($TempRange);
                $this->em->flush();
            }


            $Recette->setName($DataProduct[$keyProductAdd][4]);
            $Recette->setUrl($DataProduct[$keyProductAdd][4]);
            $this->em->persist($Recette);
            $this->em->flush();

            preg_match('/^([A-Z])\-[0-9]{4}$/', $DataProduct[$keyProductAdd][21], $matches); //on différencie les vins et les spiritueux
            switch ($matches[1]) //Suivant le type de produit, on crée une entité et des paramètres différents
            {
                case 'V': //si c'est un vin
                    $product[$keyProductAdd] = new Wine();
                    $product[$keyProductAdd]->setRegion($DataProduct[$keyProductAdd][6]);
                    $date = date_create_from_format('Y', $DataProduct[$keyProductAdd][7]);
                    $product[$keyProductAdd]->setVintage($date);
                    $product[$keyProductAdd]->setColor($DataProduct[$keyProductAdd][8]);
                    $product[$keyProductAdd]->setContactBois($DataProduct[$keyProductAdd][12]);
                    $product[$keyProductAdd]->setContactLies($DataProduct[$keyProductAdd][13]);
                    $product[$keyProductAdd]->setADecanter($DataProduct[$keyProductAdd][14]);
                    $product[$keyProductAdd]->setNonFiltre($DataProduct[$keyProductAdd][15]);
                    $product[$keyProductAdd]->setDemarcheQualite($DataProduct[$keyProductAdd][16]);
                    $product[$keyProductAdd]->setOverpressure($DataProduct[$keyProductAdd][19]);
                    break;
                case 'S': //si c'est un spiritueux
                    $product[$keyProductAdd] = new Spirit();
                    break;
            }

            $product[$keyProductAdd]->setName($DataProduct[$keyProductAdd][0]);
            $product[$keyProductAdd]->setDisplayName($DataProduct[$keyProductAdd][1]);
            $product[$keyProductAdd]->setDescription($DataProduct[$keyProductAdd][2]);
            $product[$keyProductAdd]->addRecipe($Recette);
            $product[$keyProductAdd]->setAlcoholDegree($DataProduct[$keyProductAdd][17]);
            $product[$keyProductAdd]->setSugar($DataProduct[$keyProductAdd][18]);
            $product[$keyProductAdd]->setVolume($DataProduct[$keyProductAdd][20]);

            $product[$keyProductAdd]->setOriginCountry($TempCountry);
            $product[$keyProductAdd]->setOriginContinent($TempContinent);
            $product[$keyProductAdd]->setRange($TempRange);
            $producer = $this->em->getRepository("UserBundle:UserProducer")->findOneByCompanyName($DataProduct[$keyProductAdd][22]);
            $product[$keyProductAdd]->setProducer($producer);


            $this->em->persist($product[$keyProductAdd]);
            $this->em->flush();
        }

    }


    public function insert_producer(array $DataProducer){

        foreach ($DataProducer as $keyProducerAdd => $ArrayAdd) {

            $TempStatus = new ProducerStatus();
            $producer = $this->em->getRepository("UserBundle:UserProducer")->findByCompanyName($DataProducer[$keyProducerAdd][0]); // On recherche tous les users existants en BDD
            if (!empty($producer)) {
                $TempProducer = $producer[0];
            }

            else {
                $TempProducer = new UserProducer();
                $TempProducer->setCompanyName($DataProducer[$keyProducerAdd][0]);
                $TempProducer->setBusinessName($DataProducer[$keyProducerAdd][1]);

                $status = $this->em->getRepository("UserBundle:ProducerStatus")->findByName($DataProducer[$keyProducerAdd][2]); //
                if (!empty($status)) { //Si le status de la ligne excel a été trouvé
                    $TempStatus = $status[0];
                }
                else { //SINON, on ajoute un nouveau status d'utilisateur
                    $TempStatus = new ProducerStatus();
                    $TempStatus->setName($DataProducer[$keyProducerAdd][2]);
                    $this->em->persist($TempStatus);
                    $this->em->flush();
                }
                $TempProducer->setSiret($DataProducer[$keyProducerAdd][3]);
                $username = strtolower($DataProducer[$keyProducerAdd][5]) .'.'. strtolower($DataProducer[$keyProducerAdd][4]); //creation du login en prenom.nom
                $TempProducer->setUsername($username);
                $TempProducer->setEmail($DataProducer[$keyProducerAdd][12]);
                $TempProducer->setPassword('*');
                $TempProducer->setStatus($TempStatus);
                $TempProducer->setFirstname($DataProducer[$keyProducerAdd][4]);
                $TempProducer->setLastname($DataProducer[$keyProducerAdd][5]);
                $TempProducer->setAddress($DataProducer[$keyProducerAdd][6]);
                $TempProducer->setPostalCode($DataProducer[$keyProducerAdd][7]);
                $TempProducer->setCity($DataProducer[$keyProducerAdd][8]);
                $TempProducer->setCountry($DataProducer[$keyProducerAdd][9]);
                $TempProducer->setPhone($DataProducer[$keyProducerAdd][10]);
                $TempProducer->setFax($DataProducer[$keyProducerAdd][11]);
                $TempProducer->setFacebook($DataProducer[$keyProducerAdd][13]);
                $TempProducer->setTwitter($DataProducer[$keyProducerAdd][14]);
                $TempProducer->setTvaIC($DataProducer[$keyProducerAdd][15]);
                $TempProducer->setBilling($DataProducer[$keyProducerAdd][16]);
                $this->em->persist($TempProducer);
                $this->em->flush();
            }

        }
    }


    public function insert_medal(array $medal){

        foreach ($medal as $keyMedal => $ArrayMedal) { //Pour chaque ligne du tableau de médailles
            $medalTemp = $this->em->getRepository("ConcoursBundle:Medal")->findOneById($medal[$keyMedal][1]); // on récupère la médaille associée à l'ID du tableau
            if ($medalTemp == NULL) {
                throw new Exception('Id de médaille introuvable');
            }
            else{
                $competitionProduct = $medalTemp->getCompetition(); // On récupère la compétition associée à cete médaille
                if ($competitionProduct == NULL) {
                    throw new Exception('Pas de compétition associée à la médaille');
                }
                else {
                    $product = $this->em->getRepository("ProductBundle:Product")->findOneByName($medal[$keyMedal][0]); //On récupére le produit associé à la médaille
                    $universe = $this->em->getRepository("ProductBundle:Universe")->findOneById($medal[$keyMedal][2]); //On récupère l'univers associé à la médaille et au produit
                    if ($universe == NULL) {
                        throw new Exception('Pas de compétition associée à la médaille');
                    }
                    else {
                        $product->addUniverse($universe); //On associe le produit a l'univers
                        $this->em->persist($product);
                        //throw new Exception('Erreur colonne code Univers : Un produit est déjà associé à un univers');
                    }
                    $competitionProduct->setProduct($product); // On associe le produit à la médaille
                    $this->em->persist($competitionProduct);
                    $this->em->flush();
                }
            }
        }
    }


    public function insert_conditionning(array $conditioning, array $shipmentsOptions){

        foreach ($conditioning as $keyConditioning => $ArrayConditioning) { //Pour chaque ligne du tableau des shipments
            $TempCond = new ProductConditioning();
            $TempCond->setName($conditioning[$keyConditioning][5]);
            $TempCond->setPubPrice($conditioning[$keyConditioning][8]);
            $TempCond->setProPrice($conditioning[$keyConditioning][9]);
            $TempCond->setVolumeValue($conditioning[$keyConditioning][3]);
            $TempCond->setVolumeUnit($conditioning[$keyConditioning][4]);
            $TempCond->setStock($conditioning[$keyConditioning][1]);
            $product = $this->em->getRepository("ProductBundle:Product")->findOneByName($conditioning[$keyConditioning][0]);
            $TempCond->setProduct($product);
            $this->em->persist($TempCond);

            if($conditioning[$keyConditioning][6] != null){ // Si la colonne du pack est non vide, on crée un nouveau pack
                $newPack = new Pack();
                $newPack->setName($conditioning[$keyConditioning][6]);
                $newPack->setQuantityIn($conditioning[$keyConditioning][7]);
                $this->em->persist($newPack);
                $this->em->flush();

                $TempCond->setPack($newPack); //On l'ajoute au shipment
                $this->em->flush();
            }
            else { }

            foreach ($shipmentsOptions as $keyShipment => $ArrayShipment) { //On parcourt le tableau des modes de livraison

                if ($conditioning[$keyConditioning][10] == $shipmentsOptions[$keyShipment][3]){ //Pour chacun des modes de livraison liés au product conditionning
                    $TempShip = new Delivery();
                    $TempShip = $this->insert_delivery($shipmentsOptions[$keyShipment]);
                    $TempShip->addConditioningType($TempCond); //On ajoute le mode de livraison au type de conditionnement
                    $this->em->persist($TempCond); //On insère définitivement le mode de conditionnement
                    $this->em->flush();
                }
            }

        }
    }

    public function insert_delivery(array $shipmentsOption){ //fonction d'insertion des modes de livraisons
        $TempShip = new Delivery();
        $TempShip->setName($shipmentsOption[1]);
        $TempShip->setPrice($shipmentsOption[2]);
        $this->em->persist($TempShip);
        $this->em->flush();
        return $TempShip;
    }

    public function insert($path){
        $inputFileName = $path;
        $inputFileName = substr($inputFileName, 1);
        $data = array();
        $data_copy = array();
        $data_unique = array();

        $DataProducer = array();
        $DataProduct = array();
        $medal = array();
        $conditioning = array();
        $shipmentsOptions = array();
        $ErrorArray = array();

        $test = '';
        //emplacement des colonnes :
        $row = array(
            'IdProduct' => 0,
            'RaisonSociale' => 1,
            'NomExploitation' => 2,
            'Siret' => 3,
            'Statut' => 4,
            'NomResponsable' => 5,
            'PrenomResponsable' => 6,
            'AdresseProducteur' => 7,
            'CodePostal' => 8,
            'Ville' => 9,
            'Pays' => 10,
            'Tel' => 11,
            'Email_prod' =>12,
            'Fax' => 13,
            'Facebook' => 14,
            'Twitter' => 15,
            'Tva' => 16,
            'Mail' => 17,
            'Designation' => 18,
            'NomCommercial' => 19,
            'Description'=> 20,
            'LienOenotourisme' => 21,
            'LienRecette' => 22,
            'PaysProduction' => 23,
            'RegionProduction' => 24,
            'Millesime' => 25,
            'Couleur' => 26,
            'Categorie' => 27,
            'Cepage' => 28,
            'Point' => 29,
            'ContactBois' => 30,
            'ContactLies' => 31,
            'VinDecante' => 32,
            'VinNonFiltre' => 33,
            'DemarcheQualite' => 34,
            'Volume' => 35,
            'Sucre' => 36,
            'Surpression' => 37,
            'VolumeTotal' => 38,
            'CodeMedUnivers' => 39,
            'CodeUnivers' => 40,
            'Quantite' => 41,
            'ValeurVolume' => 42,
            'UniteVolume' => 43,
            'NomConditionnement' => 44,
            'NomPack' => 45,
            'QuantitePack' =>46,
            'PrixPublic' => 47,
            'PrixPro' => 48,
            'OptionLivraison' => 49,
            'PrixLivraison' => 50,
        );



        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($rown = 1; $rown <= $highestRow; $rown++) { //fonction de lecture du tableau et de la variable le contenant
            $rowData = $sheet->rangeToArray('A' . $rown . ':' . $highestColumn . $rown,
                null, true, false);
            $data[$rown] = $rowData[0];
        }

        $data_copy = $data;
        $nbElements = count($data_copy);
        for($i=5;$i<=$nbElements;$i++) //fonction pour prendre la première ligne associée à chaque produit
        {
            if(!isset($data_unique[$data_copy[$i][0]]))
            {
                $data_unique[$data_copy[$i][0]] = $data_copy[$i];
            }
            else
            {
                unset($data_copy[$i]);
            }


            if (isset($data[$i][$row['CodeMedUnivers']]) &&  isset($data[$i][$row['CodeUnivers']])) {
                $medal[$i][0] = $data[$i][$row['Designation']];
                $medal[$i][1] = $data[$i][$row['CodeMedUnivers']]; // $row['CodeMedUnivers']
                $medal[$i][2] = $data[$i][$row['CodeUnivers']]; // $row['CodeUnivers']
            }
            else{

            }


            if(isset($data[$i][$row['Quantite']])){ //gestion des expéditions
                $conditioning[$i][0] = $data[$i][$row['Designation']];
                $conditioning[$i][1] = $data[$i][$row['Quantite']];
                $conditioning[$i][3] = $data[$i][$row['ValeurVolume']];
                $conditioning[$i][4] = $data[$i][$row['UniteVolume']];
                $conditioning[$i][5] = $data[$i][$row['NomConditionnement']];
                $conditioning[$i][6] = $data[$i][$row['NomPack']];
                $conditioning[$i][7] = $data[$i][$row['QuantitePack']];
                $conditioning[$i][8] = $data[$i][$row['PrixPublic']];
                $conditioning[$i][9] = $data[$i][$row['PrixPro']];
                $conditioning[$i][10] = $i;
                $shipmentsOptions[$i][0] = $data[$i][$row['Designation']];
                $shipmentsOptions[$i][1]= $data[$i][$row['OptionLivraison']];
                $shipmentsOptions[$i][2] = $data[$i][$row['PrixLivraison']];
                $shipmentsOptions[$i][3] = $i;
            }

        }

        foreach ($data_unique as $keyTemp => $arrayTemp) // gestion des producteurs
        {
            $ProducerTempArray = array();
            $ProductTempArray = array();
            array_push($ProducerTempArray,
                $arrayTemp[$row['RaisonSociale']], //0
                $arrayTemp[$row['NomExploitation']], //1
                $arrayTemp[$row['Statut']], //2
                $arrayTemp[$row['Siret']], //3
                $arrayTemp[$row['NomResponsable']], //4
                $arrayTemp[$row['PrenomResponsable']],//5
                $arrayTemp[$row['AdresseProducteur']], //6
                $arrayTemp[$row['CodePostal']], //7
                $arrayTemp[$row['Ville']], //8
                $arrayTemp[$row['Pays']], //9
                $arrayTemp[$row['Tel']], //10
                $arrayTemp[$row['Email_prod']], //11
                $arrayTemp[$row['Fax']], //12
                $arrayTemp[$row['Facebook']], //13
                $arrayTemp[$row['Twitter']], //14
                $arrayTemp[$row['Tva']], //15
                $arrayTemp[$row['Mail']]);//16


            array_push($ProductTempArray,
                $arrayTemp[$row['Designation']], //0
                $arrayTemp[$row['NomCommercial']], //1
                $arrayTemp[$row['Description']], //2
                $arrayTemp[$row['LienOenotourisme']],  //3
                $arrayTemp[$row['LienRecette']], //4
                $arrayTemp[$row['PaysProduction']], //5
                $arrayTemp[$row['RegionProduction']],//6
                $arrayTemp[$row['Millesime']] , //7
                $arrayTemp[$row['Couleur']], //8
                $arrayTemp[$row['Categorie']], //9
                $arrayTemp[$row['Cepage']], //10
                $arrayTemp[$row['Point']], //11
                $arrayTemp[$row['ContactBois']], //12
                $arrayTemp[$row['ContactLies']], //13
                $arrayTemp[$row['VinDecante']], //14
                $arrayTemp[$row['VinNonFiltre']], //15
                $arrayTemp[$row['DemarcheQualite']], //16
                $arrayTemp[$row['Volume']], //17
                $arrayTemp[$row['Sucre']], //18
                $arrayTemp[$row['Surpression']], //19
                $arrayTemp[$row['VolumeTotal']],// 20
                $arrayTemp[$row['IdProduct']],//21
                $arrayTemp[$row['RaisonSociale']]); //22

            array_push($DataProducer, $ProducerTempArray);
            array_push($DataProduct, $ProductTempArray);
        }



        $this->em->getConnection()->beginTransaction(); //on démarre la transaction
        try {
            $medal = $this->sanitize_data_medal($medal, $row);
            $shipmentsOptions = $this->sanitize_data_shipoptions($shipmentsOptions, $row);
            $this->insert_producer($DataProducer);
            $this->insert_product_data($DataProduct);
            $this->insert_medal($medal);
            $this->insert_conditionning($conditioning,$shipmentsOptions);
            $this->em->getConnection()->commit();
        }
        catch (\Exception $e) {
            $this->em->getConnection()->rollBack();
            $errors = $e;  //$e->getMessage();
            return array('Error' => $errors);
        }


        return array(
            'rows' => $data,
            'rows_unique' => $data_unique,
            'medal' => $medal,
            'producers' => $DataProducer,
            'products' => $DataProduct,
            'shipments' => $conditioning,
            'shipoptions' => $shipmentsOptions,
            'test' => $medal,
            'ErrorArray' =>$ErrorArray
        );


    }




}

