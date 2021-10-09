<?php

namespace App\Form;

use App\Entity\Pets;
use App\Entity\Races;
use App\Repository\RacesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PetsType extends AbstractType
{
    public function __construct(RacesRepository $racesRepository)
    {
        $this->racesRepository = $racesRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $custom_choise = [];

        foreach ($this->racesRepository->getRaces() as $key => $value) {
            $custom_choise[$value["name"]] = $value["id"];
        }

        $builder
            ->add('name')
            ->add('birth_date')
            ->add('owner_name')
            ->add('description')
            ->add('race', ChoiceType::class, [
                'required' => true,
                'choices' => $custom_choise
                ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pets::class,
        ]);
    }
}
