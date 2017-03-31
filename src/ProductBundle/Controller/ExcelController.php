<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use ProductBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PHPExcel;
use PHPExcel_IOFactory;
use Symfony\Component\HttpFoundation\Response;

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


        //emplacement des colonnes :
        $row = array(
            'IdProduct' => 0,
            'RaisonSociale' => 1,
            'NomExploitation' => 2,
            'Statut' => 3,
            'NomResponsable' => 4,
            'AdresseProducteur' => 5,
            'CodePostal' => 6,
            'Ville' => 7,
            'Pays' => 8,
            'Tel' => 9,
            'Email_prod' =>10,
            'Fax' => 11,
            'Facebook' => 12,
            'Twitter' => 13,
            'Tva' => 14,
            'Mail' => 15,
            'Designation' => 16,
            'NomCommercial' => 17,
            'Description'=> 18,
            'LienOenotourisme' => 19,
            'LienRecette' => 20,
            'PaysProduction' => 21,
            'RegionProduction' => 22,
            'Millesime' => 23,
            'Couleur' => 24,
            'Categorie' => 25,
            'Cepage' => 26,
            'Point' => 27,
            'ContactBois' => 28,
            'ContactLies' => 29,
            'VinDecante' => 30,
            'VinNonFiltre' => 31,
            'DemarcheQualite' => 32,
            'Volume' => 33,
            'Sucre' => 34,
            'Surpression' => 35,
            'VolumeTotal' => 36,
            'CodeMedUnivers' => 37,
            'CodeUnivers' => 38,
            'CodeMedConcours' => 39,
            'CodeConcours' => 40,
            'Quantite' => 41,
            'ValeurVolume' => 42,
            'UniteVolume' => 43,
            'NomConditionnement' => 44,
            'PrixPublic' => 45,
            'PrixPro' => 46,
            'OptionLivraison' => 47,
            'PrixLivraison' => 48,
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

            if(isset($data[$i][$row['CodeMedUnivers']])){ //gestion des univers
                $univers[$i][0] = $data[$i][$row['IdProduct']];
                $univers[$i][1] = $data[$i][$row['CodeMedUnivers']]; // $row['CodeMedUnivers']
                $univers[$i][2] = $data[$i][$row['CodeUnivers']]; // $row['CodeUnivers']
            }

            if(isset($data[$i][$row['CodeMedConcours']])){ //gestion des concours
                $concours[$i][0] = $data[$i][$row['IdProduct']];
                $concours[$i][1] = $data[$i][$row['CodeMedConcours']]; // $row['CodeMedConcours']
                $concours[$i][2] = $data[$i][$row['CodeConcours']]; // $row['CodeConcours']
            }

            if(isset($data[$i][$row['Quantite']])){ //gestion des concours
                $shipments[$i][0] = $data[$i][$row['IdProduct']];
                $shipments[$i][1] = $data[$i][$row['Quantite']];
                $shipments[$i][3] = $data[$i][$row['ValeurVolume']];
                $shipments[$i][4] = $data[$i][$row['UniteVolume']];
                $shipments[$i][5] = $data[$i][$row['NomConditionnement']];
                $shipments[$i][6] = $data[$i][$row['PrixPublic']];
                $shipments[$i][7] = $data[$i][$row['PrixPro']];
                $shipments[$i][8] = $data[$i][$row['OptionLivraison']];
                $shipments[$i][9] = $data[$i][$row['PrixLivraison']];
            }
        }

        foreach ($data_unique as $keyTemp => $arrayTemp) // gestion des producteurs
        {
            $ProducerTempArray = array();
            $ProductTempArray = array();
            array_push($ProducerTempArray, $arrayTemp[$row['RaisonSociale']], $arrayTemp[$row['NomExploitation']], $arrayTemp[$row['Statut']], $arrayTemp[$row['NomResponsable']],
                $arrayTemp[$row['AdresseProducteur']], $arrayTemp[$row['CodePostal']], $arrayTemp[$row['Ville']], $arrayTemp[$row['Pays']],
                $arrayTemp[$row['Tel']], $arrayTemp[$row['Email_prod']], $arrayTemp[$row['Fax']], $arrayTemp[$row['Facebook']], $arrayTemp[$row['Twitter']],
                $arrayTemp[$row['Tva']], $arrayTemp[$row['Mail']]);
            array_push($ProductTempArray, $arrayTemp[$row['Designation']], $arrayTemp[$row['NomCommercial']], $arrayTemp[$row['Description']], $arrayTemp[$row['LienOenotourisme']],
                $arrayTemp[$row['LienRecette']], $arrayTemp[$row['PaysProduction']], $arrayTemp[$row['RegionProduction']], $arrayTemp[$row['Millesime']], $arrayTemp[$row['Couleur']],
                $arrayTemp[$row['Categorie']], $arrayTemp[$row['Cepage']], $arrayTemp[$row['Point']], $arrayTemp[$row['ContactBois']], $arrayTemp[$row['ContactLies']],
                $arrayTemp[$row['VinDecante']], $arrayTemp[$row['VinNonFiltre']], $arrayTemp[$row['DemarcheQualite']], $arrayTemp[$row['Volume']], $arrayTemp[$row['Sucre']],
                $arrayTemp[$row['Surpression']], $arrayTemp[$row['VolumeTotal']]);
            array_push($DataProducer, $ProducerTempArray);
            array_push($DataProduct, $ProductTempArray);
        }

            return $this->render('ProductBundle:excelimport:ExcelImport.html.twig', array(
            'rows' => $data,
            'rows_unique' => $data_unique,
                'univers' => $univers,
                'concours' => $concours,
                'producers' => $DataProducer,
                'products' => $DataProduct,
                'shipments' => $shipments
        ));
    }





}