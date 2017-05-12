<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\News;
use AppBundle\Entity\NewsAttachment;
use AppBundle\Entity\Parameters;
use AppBundle\Entity\Partner;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadApp extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $news = new News();
        $news2 = new News();
        $newsattachment = new NewsAttachment();
        $partner = new Partner();
        $partner2 = new Partner();

        $news->setTitle("Nouveau concours ouvert !");
        $news->setAuthor("Pierre-G Olibé");
        $news->setDatePublication(new \DateTime());
        $news->setNewsText("Le nouveau concours concerne les femmes et  les vins du monde. C'est notre concours le plus attendu, alors n'attendez pas pour vous inscrire !");
        $manager->persist($news);

        $news2->setTitle("Ouverture du site");
        $news2->setAuthor("Juju Cassagne");
        $news2->setDatePublication(new \DateTime());
        $news2->setNewsText("Même si ce n'est qu'un test, j'espère que tout cela va vous plaire");
        $manager->persist($news2);

        $newsattachment->setTitle("Photo femmes vins monde");
        $newsattachment->setNews($news);
        $newsattachment->setType("Photo");
        $newsattachment->setUrl("https://www.mon-viti.com/sites/mon-viti.com/files/styles/short_teaser/public/logo_femmes_et_vins_du_monde_concours_international.jpg?itok=d5wmqE0j");
        $manager->persist($newsattachment);

        $partner->setUrl("http://www.google.fr");
        $partner->setDescription("Le célèbre moteur de recherche Google !");
        $partner->setImageUrl("https://www.grapheine.com/wp-content/uploads/2015/09/nouveau-logo-google.gif");
        $partner->setLevel("");
        $partner->setName("Google");
        $manager->persist($partner);

        $partner2->setUrl("http://www.yahoo.fr");
        $partner2->setDescription("L'autre moteur de recherche (il manque Bing!!)");
        $partner2->setImageUrl("http://www.underconsideration.com/brandnew/archives/yahoo_logo_detail.png");
        $partner2->setLevel("");
        $partner2->setName("Yahoo!");
        $manager->persist($partner2);

        $parameters = new Parameters();
        $parameters->setName('TVA');
        $parameters->setValue('19.6');
        $manager->persist($parameters);

        $mail = new Parameters();
        $mail->setName('mail');
        $mail->setValue('laGrosseLeCoz@vinasse.com');
        $manager->persist($mail);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
