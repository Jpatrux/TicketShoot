<?php

namespace App\Form;

use App\Entity\Sceances;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SceancesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tirsReussis')
            ->add('tirsTentes')
            ->add('positionTerrain')
            ->add('dateSceance')
            ->add('pourcentageReussite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sceances::class,
        ]);
    }
}
