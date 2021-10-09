<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RacesRepository;

use App\Entity\Pets;
use App\Form\PetsType;

class PetsController extends AbstractController
{
    public function __construct(RacesRepository $racesRepository)
    {
        $this->racesRepository = $racesRepository;
    }
    
    /**
     * @Route("/pets", name="pets")
     */
    public function index(): Response
    {
        return $this->render('pets/index.html.twig');
    }

    /**
     * @Route("/pets/register_pet", name="pets.register.pet")
     */
    public function regiterPetAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pets = new Pets();
        $form = $this->createForm(PetsType::class, $pets);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $pets->setRace($race = $this->racesRepository->find($request->request->get("pets")["race"]));
            $em->persist($pets);
            $em->flush();

            return $this->redirectToRoute("dashboard");
        }

        return $this->render('pets/create.html.twig',[
            "form" => $form->createView()
        ]);
    }
}
