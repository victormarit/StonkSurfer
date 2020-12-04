<?php

namespace App\Form;

use App\Entity\Consommable;
use App\Entity\Spot;
use App\Entity\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsommableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProduit',TextareaType::class)
            ->add('commentaire',TextareaType::class)
            ->add('note',IntegerType::class)
            ->add('photo',UrlType::class)
            ->add('idType',EntityType::class,[
                'class' => Type::class,
                'choice_label' => 'nomType',
            ])
            ->add('Ajouter',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consommable::class,
        ]);
    }
}
