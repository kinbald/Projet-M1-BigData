<?php
/**
 * Created by PhpStorm.
 * User: cam2
 * Date: 06/03/17
 * Time: 14:40
 */

namespace ProductBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\DateTime;


class UpdateReservationTableCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('reservation:update-table')

            // the short description shown while running "php bin/console list"
            ->setDescription('Update table reservation : checking if some reservations are out-dated and delete them if they are.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to update reservation table.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $TTLReservation = 30;   //en minutes
        $datetime=new \DateTime();
        $datetime->sub(new \DateInterval('PT'.$TTLReservation.'M'));

        $reservationRepository = $this->getContainer()->get('doctrine')->getManager()->getRepository('ProductBundle:Reservation');
        $reservationRepository->deleteOldReservations($datetime);
    }
}