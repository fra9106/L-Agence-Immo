<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;



class PropertyController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->Repository = $repository;
    }


    /**
     * @Route("/property", name="property.index")
     */
    public function index() : Response
    {
        /*$property = new Property();
        $property->setTitle('Appartement T2')
                 ->setDescription('Joli petit appartement situé près des commerces et près des transport en communs!')
                 ->setSurface(42)
                 ->setRooms(2)
                 ->setBedrooms(2)
                 ->setFloor(3)
                 ->setPrice(170000)
                 ->setHeat(2)
                 ->setCity('Nice nord')
                 ->setAddress('27 rue du Confinement')
                 ->setPostalCode('06100');
        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();*/


        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
        ]);
    }

    /**
     * @Route("/property/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     */

     public function show(Property $property, string $slug): Response
     {
         if($property->getSlug() !== $slug)
         {
            return $this->redirectToRoute('property.show', [
                 'id' => $property->getId(),
                 'slug' =>$property->getSlug()
             ], 301);
         }
         

         return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
         ]);
     }
}
