<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Classe;
use App\Entity\Parents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;


class EleveCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('parent', EntityType::class, ['class' => Parents::class, 'choice_label' => 'nomFamille', 'label' => 'Parent'])
            ->add('classe', EntityType::class, ['class' => Classe::class, 'choice_label' => 'nomClasse', 'label' => 'Classe'])
            ->add('prenom', TextType::class, ["required" => true])
            ->add('dateNaissanceAt', BirthdayType::class)
            // ->add('foto', TextType::class)
            ->add('sexe', ChoiceType::class, ['label' => 'Genre', 'choices'  => ['M' => true, 'F' => false]])
            ->add('imageFile', VichImageType::class,[
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,
               
            
            ])

            ->add('Ajouter', submitType::class)

            // ->add('btnSubmit', submitType::class,['label'=>'GO'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            "data_class" => Eleve::class
        ]);
    }
}
