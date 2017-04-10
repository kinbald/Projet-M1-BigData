<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Continent;
use ProductBundle\Entity\Country;
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
use PHPExcel;
use PHPExcel_IOFactory;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\ProducerStatus;
use UserBundle\Entity\UserProducer;

/**
 * Lists all product entities
 * @Route("/excel")
 */
class ExcelController extends Controller
{
    /**
     * Display excel imported file
     *
     * @Route("/", name="excel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $inputFileName = 'uploads/excel.xls';
        $data = array();
        $data_copy = array();
        $data_unique = array();

        $DataProducer = array();
        $DataProduct = array();
        $univers = array();
        $concours = array();
        $shipments = array();
        $shipmentsOptions = array();

        $test = '';
        //emplacement des colonnes :
        $row = array(
            'IdProduct' => 0,
            'RaisonSociale' => 1,
            'NomExploitation' => 2,
            'Statut' => 3,
            'NomResponsable' => 4,
            'PrenomResponsable' => 5,
            'AdresseProducteur' => 6,
            'CodePostal' => 7,
            'Ville' => 8,
            'Pays' => 9,
            'Tel' => 10,
            'Email_prod' =>11,
            'Fax' => 12,
            'Facebook' => 13,
            'Twitter' => 14,
            'Tva' => 15,
            'Mail' => 16,
            'Designation' => 17,
            'NomCommercial' => 18,
            'Description'=> 19,
            'LienOenotourisme' => 20,
            'LienRecette' => 21,
            'PaysProduction' => 22,
            'RegionProduction' => 23,
            'Millesime' => 24,
            'Couleur' => 25,
            'Categorie' => 26,
            'Cepage' => 27,
            'Point' => 28,
            'ContactBois' => 29,
            'ContactLies' => 30,
            'VinDecante' => 31,
            'VinNonFiltre' => 32,
            'DemarcheQualite' => 33,
            'Volume' => 34,
            'Sucre' => 35,
            'Surpression' => 36,
            'VolumeTotal' => 37,
            'CodeMedUnivers' => 38,
            'CodeUnivers' => 39,
            'CodeMedConcours' => 40,
            'CodeConcours' => 41,
            'Quantite' => 42,
            'ValeurVolume' => 43,
            'UniteVolume' => 44,
            'NomConditionnement' => 45,
            'PrixPublic' => 46,
            'PrixPro' => 47,
            'OptionLivraison' => 48,
            'PrixLivraison' => 49,
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
                $univers[$i][0] = $data[$i][$row['IdProduct']];
                $univers[$i][1] = $data[$i][$row['CodeMedUnivers']]; // $row['CodeMedUnivers']
                $univers[$i][2] = $data[$i][$row['CodeUnivers']]; // $row['CodeUnivers']
            }
            else{

            }


            if(isset($data[$i][$row['CodeMedConcours']]) && isset($data[$i][$row['CodeMedConcours']])){ //gestion des concours
                $concours[$i][0] = $data[$i][$row['IdProduct']];
                $concours[$i][1] = $data[$i][$row['CodeMedConcours']]; // $row['CodeMedConcours']
                $concours[$i][2] = $data[$i][$row['CodeConcours']]; // $row['CodeConcours']
            }

            if(isset($data[$i][$row['Quantite']])){ //gestion des expéditions
                $shipments[$i][0] = $data[$i][$row['IdProduct']];
                $shipments[$i][1] = $data[$i][$row['Quantite']];
                $shipments[$i][3] = $data[$i][$row['ValeurVolume']];
                $shipments[$i][4] = $data[$i][$row['UniteVolume']];
                $shipments[$i][5] = $data[$i][$row['NomConditionnement']];
                $shipments[$i][6] = $data[$i][$row['PrixPublic']];
                $shipments[$i][7] = $data[$i][$row['PrixPro']];
                $shipments[$i][8] = $i;
                $shipmentsOptions[$i][0] = $data[$i][$row['IdProduct']];
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
                $arrayTemp[$row['NomResponsable']], //3
                $arrayTemp[$row['PrenomResponsable']],//4
                $arrayTemp[$row['AdresseProducteur']], //5
                $arrayTemp[$row['CodePostal']], //6
                $arrayTemp[$row['Ville']], //7
                $arrayTemp[$row['Pays']], //8
                $arrayTemp[$row['Tel']], //9
                $arrayTemp[$row['Email_prod']], //10
                $arrayTemp[$row['Fax']], //11
                $arrayTemp[$row['Facebook']], //12
                $arrayTemp[$row['Twitter']], //13
                $arrayTemp[$row['Tva']], //14
                $arrayTemp[$row['Mail']]);//15


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
                $arrayTemp[$row['IdProduct']]); //21

            array_push($DataProducer, $ProducerTempArray);
            array_push($DataProduct, $ProductTempArray);
        }

        $univers = $this->sanitize_data_univers($univers, $row);
        $shipmentsOptions = $this->sanitize_data_shipoptions($shipmentsOptions, $row);
        $this->insert_product_data($DataProduct);
        $this->insert_producer($DataProducer);


            return $this->render('ProductBundle:excelimport:ExcelImport.html.twig', array(
            'rows' => $data,
            'rows_unique' => $data_unique,
                'univers' => $univers,
                'concours' => $concours,
                'producers' => $DataProducer,
                'products' => $DataProduct,
                'shipments' => $shipments,
                'shipoptions' => $shipmentsOptions,
                'test' => $univers
        ));





    }




    public function sanitize_data_univers(array $univers, array $row)
    {

        foreach ($univers as $keyUnivers => $arrayUnivers) {
            if (!preg_match('/^M\d{4}\-\d+$/', $arrayUnivers[1])) { //Si il y a plusieurs codes médailles dans la case
                $CodeUniversSplitTemp = explode(",", $arrayUnivers[1]); // on les sépare dans un tableau temporaire
                foreach ($CodeUniversSplitTemp as $keySplitUnivers => $ArrayUniverse) { //on insère les lignes splitées dans le tableau de base
                    array_push($univers, array($arrayUnivers[0], $ArrayUniverse, $arrayUnivers[2]));
                }
                unset($univers[$keyUnivers]); // On supprime l'ancienne ligne avec doublon
            }
            else{

            }
        }
        return $univers;
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


            $em = $this->getDoctrine()->getManager();
            $country = $em->getRepository("ProductBundle:Country")->findByName($DataProduct[$keyProductAdd][5]); // On recherche tous les pays existants en BDD
            if (!empty($country)) {
                    $TempCountry = $country[0];
                }
                else{
                    $TempCountry = new Country();
                    $TempCountry->setName($DataProduct[$keyProductAdd][5]);
                    $em->persist($TempCountry);
                    $em->flush($TempCountry);
                }


            $continent = $em->getRepository("ProductBundle:Continent")->findByName('Europe'); // On recherche tous les continents existants en BDD
            if (!empty($continent)) {
                $TempContinent = $continent[0];
            }
                else{
                    $TempContinent= new Continent();
                    $TempContinent->setName('Europe');
                    $em->persist($TempContinent);
                    $em->flush($TempContinent);
                }


            $range = $em->getRepository("ProductBundle:Range")->findByName('Premiumfd'); // On recherche tous les ranges existants en BDD
            if (!empty($range)) {
                $TempRange = $range[0];
            }

            else{
                $TempRange = new Range();
                $TempRange->setName('Premiumfd');
                $TempRange->setImg('Premiumfd');
                $em->persist($TempRange);
                $em->flush($TempRange);
            }


            $Recette->setName($DataProduct[$keyProductAdd][4]);
            $Recette->setUrl($DataProduct[$keyProductAdd][4]);
            $em->persist($Recette);
            $em->flush($Recette);

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
            $product[$keyProductAdd]->setPrice(0); //TEMPORARY
            $product[$keyProductAdd]->setStock(10); //TEMPORARY
            $product[$keyProductAdd]->setOriginCountry($TempCountry);
            $product[$keyProductAdd]->setOriginContinent($TempContinent);
            $product[$keyProductAdd]->setRange($TempRange);


            $em = $this->getDoctrine()->getManager();
            $em->persist($product[$keyProductAdd]);
            $em->flush($product[$keyProductAdd]);
        }

    }


    public function insert_producer(array $DataProducer)
    {

        foreach ($DataProducer as $keyProducerAdd => $ArrayAdd) {

            $TempStatus = new ProducerStatus();
            $em = $this->getDoctrine()->getManager();
            $producer = $em->getRepository("UserBundle:UserProducer")->findByCompanyName($DataProducer[$keyProducerAdd][0]); // On recherche tous les users existants en BDD
            if (!empty($producer)) {
                $TempProducer = $producer[0];
            }

            else {
                $TempProducer[$keyProducerAdd] = new UserProducer();
                $TempProducer[$keyProducerAdd]->setCompanyName($DataProducer[$keyProducerAdd][0]);
                $TempProducer[$keyProducerAdd]->setBusinessName($DataProducer[$keyProducerAdd][1]);

                $status = $em->getRepository("UserBundle:ProducerStatus")->findByName($DataProducer[$keyProducerAdd][2]); // On recherche tous les status d'utilisateurs existants en BDD
                if (!empty($status)) { //Si le status de la ligne excel a été trouvé
                    $TempStatus = $status[0];
                }
                else { //SINON, on ajoute un nouveau status d'utilisateur
                    $TempStatus = new ProducerStatus();
                    $TempStatus->setName($DataProducer[$keyProducerAdd][2]);
                    $em->persist($TempStatus);
                    $em->flush($TempStatus);
                }

                $TempProducer[$keyProducerAdd]->setStatus();
                $TempProducer[$keyProducerAdd]->setFirstname($DataProducer[$keyProducerAdd][3]);
                $TempProducer[$keyProducerAdd]->setLastname($DataProducer[$keyProducerAdd][4]);
                $TempProducer[$keyProducerAdd]->setAddress($DataProducer[$keyProducerAdd][5]);
                $TempProducer[$keyProducerAdd]->setPostalCode($DataProducer[$keyProducerAdd][6]);
                $TempProducer[$keyProducerAdd]->setCity($DataProducer[$keyProducerAdd][7]);
                $TempProducer[$keyProducerAdd]->setCountry($DataProducer[$keyProducerAdd][8]);
                $TempProducer[$keyProducerAdd]->setPhone($DataProducer[$keyProducerAdd][9]);
                $TempProducer[$keyProducerAdd]->setFax($DataProducer[$keyProducerAdd][11]);
                $TempProducer[$keyProducerAdd]->setFacebook($DataProducer[$keyProducerAdd][12]);
                $TempProducer[$keyProducerAdd]->setTwitter($DataProducer[$keyProducerAdd][13]);
                $TempProducer[$keyProducerAdd]->setTvaIC($DataProducer[$keyProducerAdd][14]);
                $TempProducer[$keyProducerAdd]->setBilling($DataProducer[$keyProducerAdd][15]);
                $em->persist($TempProducer[$keyProducerAdd]);
                $em->flush($TempProducer[$keyProducerAdd]);
            }

        }
    }





}