<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;


class CrawlerController extends Controller
{

    /**
     * CrawlerController constructor.
     */
    public function __construct()
    {
    }

    public function index(){
        $client = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
        ));
        $client->setClient($guzzleClient);
        $crawler = $client->request('GET', 'https://www.continente.pt/pt-pt/public/Pages/homepage.aspx');
        //$crawler = $client->click($crawler->selectLink('Sign in')->link());
        $form = $crawler->selectButton('btnLogin')->form();
        $form['username'] = "ines3os@gmail.com";
        $form['password'] = "primadona";
        $crawler = $client->submit($form);


        $crawler->filter('.popupSubTitle')->each(function ($node) {
            dd($node->text());
        });
    }
}
