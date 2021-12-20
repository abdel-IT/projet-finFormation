<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Parents;
use App\Entity\NiveauScolaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ClasseCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('niveauScolaire', EntityType::class, ['class' => NiveauScolaire::class, 'choice_label' => 'nomNiveauScolaire', 'label' => 'Niveau Scolaire'])
            ->add('nomClasse', TextType::class, ["required" => true, 'label' => 'Nom De Classe'])
            ->add('Ajouter', submitType::class, ['label' => 'Modifier']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            "data_class" => Classe::class
        ]);
    }
}
