<?php

namespace App\Form;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Sector;
use App\Entity\Bex;
use App\Entity\Prestataire;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',     TextType::class, ['label' => "Nom de la ville",])
            ->add('codePostal',     TextType::class, ['label' => "Code Postal",])
            ->add('sector',   EntityType::class, [
                'class'        => Sector::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'label' => "Choisir un secteur",
            ])
            ->add('bex',   EntityType::class, [
                'class'        => Bex::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'label' => "Choisir un bureau d'exploitation",
            ])
            ->add('prestataires',   EntityType::class, [
                'class'        => Prestataire::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded'     => true,
                'label' => "Choisir un prestataire",
            ])

            ->add('Ajouter',  SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
