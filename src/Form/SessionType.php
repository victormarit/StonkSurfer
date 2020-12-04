<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Sport;
use App\Entity\Spot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idSport',EntityType::class,[
                'class' => Sport::class,
                'choice_label' => 'nomPratique',
            ])
            ->add('idSpot',EntityType::class,[
                'class' => Spot::class,
                'choice_label' => 'lieu',
            ])
            ->add('dureeSession', TimeType::class)

            ->add('commentaire',TextareaType::class)
            ->add('public')
            ->add('notePerformance',IntegerType::class)
            ->add('noteEcologique',IntegerType::class)
            ->add('noteEstimationAPI',IntegerType::class)
            ->add('noteInfrastructure',IntegerType::class)
            ->add('dateSessionDebut',DateTimeType::class)
            ->add('Valider',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
