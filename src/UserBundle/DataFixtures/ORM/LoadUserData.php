<?php
namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\UserConsumer;
use UserBundle\Entity\UserMedia;
use UserBundle\Entity\UserProducer;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userConsumer = new UserConsumer();
        $userConsumer->setUsername('Consumer');
        $userConsumer->setUsernameCanonical('Consumer');
        $userConsumer->setEmail('chiquetcamille@gmail.com');
        $userConsumer->setEmailCanonical('chiquetcamille@gmail.com');
        $userConsumer->setEnabled(true);
        $userConsumer->setPassword('$2y$12$VtTfiZZ68ThnssIEc8vkp.pkCL9YGAKB85Zk/8Up0MW9rxyRk2MLe');
        $userConsumer->setFirstname('Camille');
        $userConsumer->setLastname('Chiquet');
        $userConsumer->setSex('Male');
        $userConsumer->setBirthDate(new \DateTime('1995-10-29 10:00:00'));
        $manager->persist($userConsumer);

        $userProducer = new UserProducer();
        $userProducer->setUsername('Producer');
        $userProducer->setUsernameCanonical('Producer');
        $userProducer->setEmail('tatatoto@gmail.com');
        $userProducer->setEmailCanonical('tatatoto@gmail.com');
        $userProducer->setEnabled(true);
        $userProducer->setPassword('$2y$12$sNM3lJ9oRrOZB2cUSBKoHODtXZMt8mB826dS5rE.2ppPg9TXby9BO');
        $userProducer->setFirstname('fish');
        $userProducer->setLastname('dick');
        $userProducer->setSiret('168435135');
        $userProducer->setCompanyName('Bitonnet de poisson & co');
        $userProducer->setAddress('25 Avenue Mescouilles');
        $userProducer->setCity('Au miel');
        $userProducer->setPostalCode('6969');
        $manager->persist($userProducer);

        $userMedia = new UserMedia();
        $userMedia->setUsername('media');
        $userMedia->setUsernameCanonical('media');
        $userMedia->setEmail('mediaMedia@gmail.com');
        $userMedia->setEmailCanonical('mediaMedia@gmail.com');
        $userMedia->setEnabled(false);
        $userMedia->setPassword('$2y$12$VtTfiZZ68ThnssIEc8vkp.pkCL9YGAKB85Zk/8Up0MWg85t2h3drf');
        $userMedia->setFirstname('Journaliste');
        $userMedia->setLastname('chépakoimaitre');
        $userMedia->setCompanyName('Le Bon Pinnard');
        $userMedia->setIdPresse('168464358');
        $userMedia->setUrlBlog('LeBonPinnard.com');
        $manager->persist($userMedia);

        $userMedia = new UserMedia();
        $userMedia->setUsername('media2');
        $userMedia->setUsernameCanonical('media2');
        $userMedia->setEmail('vziuregLvnzougvb@gmail.com');
        $userMedia->setEmailCanonical('vziuregLvnzougvb@gmail.com');
        $userMedia->setEnabled(false);
        $userMedia->setPassword('$2y$12$VtTfiZZ68ThnssIEc8vkp.pkCL9YGAKB85Zk/8Ur3MWg85t2h3drf');
        $userMedia->setFirstname('vsqfgljn');
        $userMedia->setLastname('vlziehglz');
        $userMedia->setCompanyName('Magazine sur du vin');
        $userMedia->setIdPresse('168464360');
        $userMedia->setUrlBlog('blablalbaalbalbla.com');
        $manager->persist($userMedia);

        $userMedia = new UserMedia();
        $userMedia->setUsername('media3');
        $userMedia->setUsernameCanonical('media3');
        $userMedia->setEmail('zlvhleivjelivj@gmail.com');
        $userMedia->setEmailCanonical('zlvhleivjelivj@gmail.com');
        $userMedia->setEnabled(false);
        $userMedia->setPassword('$2y$12$VtTfiZZ68ThnssIEc8vkp.pkCL9YGAKB85Zk/8Ur3Mjgk8t2h3drf');
        $userMedia->setFirstname('vepojtgo');
        $userMedia->setLastname('erfcvek');
        $userMedia->setCompanyName('un autre magazine');
        $userMedia->setIdPresse('134864785');
        $userMedia->setUrlBlog('blablavzelijla.com');
        $manager->persist($userMedia);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
