<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Sector;
use App\Entity\City;
use App\Entity\Prestataire;
use App\Entity\Bex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends AbstractController
{
  /**
   * @Route("/deleteSector/{id}", name="deleteSector")
   */
  public function deleteSector($id,Request $request)
  {
        $sector = $this->getDoctrine()->getRepository(Sector::class)->find($id);

        if (!$sector) {
          $request->getSession()->getFlashBag()->add('message', 'Impossible de supprimer cet élément');
          return $this->redirectToRoute('homeSearch');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($sector);
        $em->flush();
        $request->getSession()->getFlashBag()->add('message','Suppression du secteur : '.$sector->getName());
        return $this->redirectToRoute('homeSearch');
  }

  /**
   * @Route("/deleteCity/{id}", name="deleteCity")
   */
  public function deleteCity($id,Request $request)
  {
        $city = $this->getDoctrine()->getRepository(City::class)->find($id);

        if (!$city) {
          $request->getSession()->getFlashBag()->add('message', 'Impossible de supprimer cet élément');
          return $this->redirectToRoute('homeSearch');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($city);
        $em->flush();
        $request->getSession()->getFlashBag()->add('message','Suppression de la ville : '.$city->getName());
        return $this->redirectToRoute('homeSearch');
  }

  /**
   * @Route("/deleteBex/{id}", name="deleteBex")
   */
  public function deleteBex($id,Request $request)
  {
        $bex = $this->getDoctrine()->getRepository(Bex::class)->find($id);

        if (!$bex) {
          $request->getSession()->getFlashBag()->add('message', 'Impossible de supprimer cet élément');
          return $this->redirectToRoute('homeSearch');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($bex);
        $em->flush();
        $request->getSession()->getFlashBag()->add('message','Suppression du bureau d\'exploitation : '.$bex->getName());
        return $this->redirectToRoute('homeSearch');
  }


  /**
   * @Route("/deletePrestataire/{id}", name="deletePrestataire")
   */
  public function deletePrestataire($id,Request $request)
  {
        $prestataire = $this->getDoctrine()->getRepository(Prestataire::class)->find($id);

        if (!$prestataire) {
          $request->getSession()->getFlashBag()->add('message', 'Impossible de supprimer cet élément');
          return $this->redirectToRoute('homeSearch');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($prestataire);
        $em->flush();
        $request->getSession()->getFlashBag()->add('message','Suppression d\'un prestataire : '.$prestataire->getName());
        return $this->redirectToRoute('homeSearch');
  }
}
