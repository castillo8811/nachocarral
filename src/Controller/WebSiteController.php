<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebSiteController extends Controller
{
    /**
     * @Route("/", name="web_site")
     */
    public function index()
    {
        $key = 'AIzaSyD3gv2-_RexFuDe2pRtqpiC2jJUq4iWJYM';
        $channel = 'UCfrbrNrh349yOdFJxnilSCA'; //ejemplo: UCL-aihy3UD61TmvCOL9szUw

        $url = "https://www.googleapis.com/youtube/v3/search?key=$key&channelId=$channel&part=snippet,id&order=date&maxResults=3";
        $json = file_get_contents($url);
        $videos = json_decode($json, true);

        return $this->render('web_site/index.html.twig', [
            'controller_name' => 'WebSiteController',
            'videos'=>$videos['items']
        ]);
    }
}
