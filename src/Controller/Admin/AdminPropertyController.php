<?php

namespace App\Controller\Admin;


use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/admin", name="admin.property.index")
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin_property/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/{id}", name="admin.property.edit", methods="GET|POST")
     * @Route("/admin/new", name="admin.property.new")
     */
   public function editform(Request $request, Property $property = null, EntityManagerInterface $em)
    {
    if(!$property){
        $property = new Property();
    
    }
    $form = $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
        $property->setCreatedAt(new\DateTime);

        $em->persist($property);
        $em->flush();
        
        //$this->addFlash('success', 'Affaire modifié !');
        
        return $this->redirectToRoute('property.show', [
            'id' => $property->getId(),
            'slug' =>$property->getSlug()
        ], 301);

        
    }


        return $this->render('admin_property/edit.html.twig',[
        'property' => $property,
        'form' => $form->createView(),
        'editMode' => $property->getId( )!==null
        ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     */
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'. $property->getId(), $request->get('_token')))
            {
                $this->em->remove($property);
                $this->em->flush(); 
            }
            
            return $this->redirectToRoute('admin.property.index');
        
        
        
    }

}