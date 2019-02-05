<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\DomCrawler\Crawler;


class ScrappingController extends AbstractController
{
    /**
     * @Route("/scrapping", name="scrapping")
     */
    public function index()
    {
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://www.prenoms.com/prenom/AGATHE.html");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        // close curl resource to free up system resources
        curl_close($ch);

        $crawler = new Crawler($output);
        $texteFete = $crawler->filter('div.illustration > h2')->text();



        return $this->render('scrapping/index.html.twig', [
            'texte_fete' =>$texteFete,
        ]);
    }
}
