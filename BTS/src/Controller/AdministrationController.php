<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Sector;
use App\Entity\City;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Form\CityType;
use App\Form\SectorType;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function index(Request $request)
    {

    	$sector = new Sector();
    	$formSector  = $this->createForm(SectorType::class, $sector);

    	$city = new City();
    	$formCity = $this->createForm(CityType::class, $city);

    	$formCity->handleRequest($request);
    	$formSector->handleRequest($request);

    	if ($formSector->isSubmitted() && $formSector->isValid()) {
          $em = $this->getDoctrine()->getManager();

          $sectorExist = $this->getDoctrine()->getRepository(Sector::class)->findByName($sector->getName());

          if ($sectorExist) {
          	$request->getSession()->getFlashBag()->add('message', 'Le secteur existe déjà');
          	return $this->redirectToRoute('search');
          }

          $em->persist($sector);
          $em->flush();

          $request->getSession()->getFlashBag()->add('message', 'Ajout du secteur : '.$sector->getName());
          return $this->redirectToRoute('search');
      	}

      	if ($formCity->isSubmitted() && $formCity->isValid()) {
          $em = $this->getDoctrine()->getManager();

          $cityExist = $this->getDoctrine()->getRepository(City::class)->findByName($city->getName());

          if ($cityExist) {
          	$request->getSession()->getFlashBag()->add('message', 'La ville existe déjà');
          	return $this->redirectToRoute('search');
          }
          $em->persist($city);
          $em->flush();

          $request->getSession()->getFlashBag()->add('message', 'Ajout de la ville : '.$city->getName());
          return $this->redirectToRoute('search');
      	}

        return $this->render('administration/index.html.twig', [
            'formSector' => $formSector->createView(),
            'formCity' => $formCity->createView(),
        ]);
    }
    

    /**
     * @Route("/newSector", name="newSector")
     */
    public function newSector(Request $request)
    {
    	$sector = new Sector();
    	$form = $this->createForm(SectorType::class, $sector);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($sector);
          $em->flush();

          $request->getSession()->getFlashBag()->add('message', 'Ajout d\'un secteur');
          return $this->redirectToRoute('search');
      	}

        return $this->render('form/sector.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newCity", name="newCity")
     */
    public function newCity(Request $request)
    {
    	$city = new City();
    	$form = $this->createForm(CityType::class, $city);

        return $this->render('form/sector.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
