<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label'=>'Titre :'])
            ->add('description', null, ['label' => 'Description :'])
            ->add('surface',null, ['label'=>'Surface habitable :']) 
            ->add('rooms', null, ['label'=>'Nombre de pièces :'])
            ->add('bedrooms', null, ['label'=>'Nombre de chambres :'])
            ->add('floor', null, ['label'=>'Étage :'])
            ->add('price',null, ['label'=>'Prix :']) 
            ->add('heat', null, ['label'=>'Chauffage :'])
            ->add('city', null, ['label'=>'Ville :'])
            ->add('address', null, ['label'=>'Adresse :'])
            ->add('postal_code',null, ['label'=>'Code postal :']) 
            ->add('sold', null, ['label'=>'Solde :'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
