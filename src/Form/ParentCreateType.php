<?php

namespace App\Form;

use App\Entity\Parents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;


class ParentCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomFamille', TextType::class, ["required" => true])
            ->add('prenomPere', TextType::class, ["required" => true])
            ->add('nomFamilleMere', TextType::class)
            ->add('prenomMere', TextType::class)
            ->add('totalPaiement', MoneyType::class, ['attr' => ['type' => 'number', 'currency' => 'EUR']])
            ->add('rue', TextType::class, ["required" => true])
            ->add('numero', IntegerType::class, ["required" => true])
            ->add('codePostal', IntegerType::class, ["required" => true])
            ->add('pays', CountryType::class, ["preferred_choices" => "belgium"])

            ->add('gsmPere', IntegerType::class, ["required" => true])
            ->add('gsmMere', IntegerType::class, ["required" => true])
            ->add('telephone', IntegerType::class)
            ->add('email', EmailType::class, ["required" => true])
            ->add('Ajouter', submitType::class)
            // ->add('btnSubmit', submitType::class,['label'=>'GO'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            "data_class" => Parents::class
        ]);
    }
}
