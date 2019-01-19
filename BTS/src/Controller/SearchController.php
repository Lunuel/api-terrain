<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Sector;
use App\Entity\City;
use App\Entity\Prestataire;
use App\Entity\Bex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class SearchController extends AbstractController
{
  /**
   * @Route("/homeSearch", name="homeSearch")
   */
    public function home(Request $request)
    {
      if ($request->get('search')) {
        $search = $request->get('search');
        $city = explode(" | ", $search);
        $resultSearch = $this->getDoctrine()->getRepository(City::class)->findBySearch($city[0]);
      }
      else {
        $resultSearch = '';
      }

    	$sectors = $this->getDoctrine()->getRepository(Sector::class)->findAll();
    	$cities = $this->getDoctrine()->getRepository(City::class)->findAll();
      $prestataires = $this->getDoctrine()->getRepository(Prestataire::class)->findAll();
      $bexs = $this->getDoctrine()->getRepository(Bex::class)->findAll();

        return $this->render('search/index.html.twig', [
            'sectors' => $sectors,
            'cities' => $cities,
            'bexs' => $bexs,
            'prestataires' => $prestataires,
            'search' => $resultSearch,
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request)
    {
      if ($request->get('search')) {
        $search = $request->get('search');
        $city = explode(" | ", $search);
        $resultSearch = $this->getDoctrine()->getRepository(City::class)->findBySearch($city[0]);
      }
      else {
        $resultSearch = '';
      }
        return $this->render('search/search.html.twig', [
            'search' => $resultSearch,
        ]);
    }


    /**
     * @Route("/listCities", name="listeCities")
     */
    public function listCities(Request $request)
    {
        $list = $this->getDoctrine()->getManager()->getRepository(City::class)->findNames();

        $response = new Response(json_encode($list));
        $response -> headers -> set('Content-Type', 'application/json');
        return $response;
    }

}
