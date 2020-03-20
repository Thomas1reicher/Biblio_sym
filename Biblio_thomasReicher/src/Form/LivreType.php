<?php


namespace App\Form;


use App\Entity\Livre;

use App\Form\BlobType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'titre',
                'required' => true,
            ])
            ->add('auteur', TextType::class, [
                'label' => 'auteur',
                'required' => true,
            ])
            ->add('synopsis', TextareaType::class, [
                'label' => 'synopsis',
                'required' => true,
            ])
            ->add('image', TextType::class, [
                'label' => 'image',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
