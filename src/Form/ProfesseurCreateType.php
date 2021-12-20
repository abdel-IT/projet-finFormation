<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Parents;
use App\Entity\Professeur;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;


class ProfesseurCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classes', EntityType::class, ['class' => Classe::class,'query_builder' => function (EntityRepository $cl)
             { 
                 return $cl->createQueryBuilder('c') ->orderBy('c.nomClasse', 'ASC');
            },   
            'choice_label' => 'nomClasse','label' => 'Classe','multiple' => true])

            // ->add('classes', EntityType::class, ['class' => Classe::class, 'choice_label' => 'nomClasse', 'label' => 'Classe'])
            ->add('nom', TextType::class, ["required" => true])
            ->add('prenom', TextType::class, ["required" => true])
            ->add('telephone', IntegerType::class,["required" => true])
            ->add('Ajouter', submitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            "data_class" => Professeur::class
        ]);
    }
}
