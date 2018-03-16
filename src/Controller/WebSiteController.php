<?php

namespace App\Controller;

use Swift_Mailer;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/contacto", name="web_site_contacto")
     */
    public function contacto(Request $request,Swift_Mailer $mailer)
    {
        if($request->isMethod('POST')){
            $name=$request->get('name');
            $email=$request->get('email');
            $message=$request->get('message');
            $message = (new \Swift_Message('Contacto!'))
                ->setFrom('castillo8811@gmail.com')
                ->setTo('castillo8811@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        array('name' => $name,'email'=>$email,'message'=>$message)
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

        }

        return $this->render('web_site/contacto.html.twig', [
            'controller_name' => 'WebSiteController',
        ]);
    }
}
