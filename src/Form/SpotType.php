<?php

namespace App\Form;

use App\Entity\Spot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieu', TextType::class, [
                "label" => "Lieu",
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('ville', TextType::class, [
                "label" => "Ville",
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('longitude', TextType::class, [
                "label" => "Longitude",
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('latitude', TextType::class, [
                "label" => "Latitude",
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('niveauAccessibilite')
            ->add("Sauvegarder", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Spot::class,
        ]);
    }
}
