<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Form\CityType;
use App\Form\SectorType;
use App\Form\PrestataireType;
use App\Form\BexType;

use App\Entity\Sector;
use App\Entity\City;
use App\Entity\Prestataire;
use App\Entity\Bex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormulaireController extends AbstractController
{
  /**
   * @Route("/newCity/", name="newCity")
   */
  public function newCity(Request $request)
  {
        $city = new City();
        $formCity = $this->createForm(CityType::class, $city);

        $formCity->handleRequest($request);

        if ($formCity->isSubmitted() && $formCity->isValid()) {
          $em = $this->getDoctrine()->getManager();

          $cityExist = $this->getDoctrine()->getRepository(City::class)->findByName($city->getName());

          if ($cityExist) {
            $request->getSession()->getFlashBag()->add('message', 'La ville existe déjà');
            return $this->redirectToRoute('homeSearch');
          }
          $em->persist($city);
          $em->flush();

          $request->getSession()->getFlashBag()->add('message', 'Ajout de la ville : '.$city->getName());
          return $this->redirectToRoute('homeSearch');
        }
        return $this->render('form/form.html.twig', [
            'form' => $formCity->createView(),
            'action' => 'newCity',
            'title' => 'Ajouter une Ville',
        ]);

  }


  /**
   * @Route("/newSector/", name="newSector")
   */
  public function newSector(Request $request)
  {
    $sector = new Sector();
    $formSector  = $this->createForm(SectorType::class, $sector);

    $formSector->handleRequest($request);

    if ($formSector->isSubmitted() && $formSector->isValid()) {
        $em = $this->getDoctrine()->getManager();

        $sectorExist = $this->getDoctrine()->getRepository(Sector::class)->findByName($sector->getName());

        if ($sectorExist) {
          $request->getSession()->getFlashBag()->add('message', 'Le secteur existe déjà');
          return $this->redirectToRoute('homeSearch');
        }

        $em->persist($sector);
        $em->flush();

        $request->getSession()->getFlashBag()->add('message', 'Ajout du secteur : '.$sector->getName());
        return $this->redirectToRoute('homeSearch');
      }
      return $this->render('form/form.html.twig', [
            'form' => $formSector->createView(),
            'action' => 'newSector',
            'title' => 'Ajouter un Secteur',
        ]);

  }

  /**
   * @Route("/newBex/", name="newBex")
   */
  public function newBex(Request $request)
  {
    $bex = new Bex();
    $formBex  = $this->createForm(BexType::class, $bex);

    $formBex->handleRequest($request);

    if ($formBex->isSubmitted() && $formBex->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $bexExist = $this->getDoctrine()->getRepository(Bex::class)->findByName($bex->getName());

        if ($bexExist) {
          $request->getSession()->getFlashBag()->add('message', 'Le bureau d\'exploitation existe déjà');
          return $this->redirectToRoute('homeSearch');
        }

        $em->persist($bex);
        $em->flush();

        $request->getSession()->getFlashBag()->add('message', 'Ajout du bureau d\'exploitation : '.$bex->getName());
        return $this->redirectToRoute('homeSearch');
      }
      return $this->render('form/form.html.twig', [
            'form' => $formBex->createView(),
            'action' => 'newBex',
            'title' => 'Ajouter un Bureau d\'Exploitation',
        ]);

  }

  /**
   * @Route("/newPrestataire/", name="newPrestataire")
   */
  public function newPrestataire(Request $request)
  {
    $prestataire = new Prestataire();
    $formPrestataire  = $this->createForm(PrestataireType::class, $prestataire);

    $formPrestataire->handleRequest($request);

    if ($formPrestataire->isSubmitted() && $formPrestataire->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $prestataireExist = $this->getDoctrine()->getRepository(Prestataire::class)->findByName($prestataire->getName());

        if ($prestataireExist) {
          $request->getSession()->getFlashBag()->add('message', 'Le prestataire existe déjà');
          return $this->redirectToRoute('homeSearch');
        }

        $em->persist($prestataire);
        $em->flush();

        $request->getSession()->getFlashBag()->add('message', 'Ajout d\'un prestataire : '.$prestataire->getName());
        return $this->redirectToRoute('homeSearch');
      }
      return $this->render('form/form.html.twig', [
            'form' => $formPrestataire->createView(),
            'action' => 'newPrestataire',
            'title' => 'Ajouter un Prestataire',
        ]);

  }

}
