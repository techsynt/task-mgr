<?php

namespace App\Form\Type;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Заголовок', 'rows' => '5'],
            ])
            ->add('content', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Текст задачи'],
            ])
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'html5' => false,
                'label' => false,
                'disabled' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Добавить задачу',
                'attr' => ['class' => 'btn-warning'],
            ]);
    }
}
