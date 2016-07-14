<?php

namespace A2lix\TranslationFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Translations fields
 *
 * @author David ALLIX
 */
class TranslationsFieldsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['fields'] as $fieldName => $fieldConfig) {
            $fieldType = $fieldConfig['field_type'];
            unset($fieldConfig['field_type']);

            $builder->add($fieldName, $fieldType, $fieldConfig);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'fields' => array(),
            'translation_class' => null
        ));
    }

    public function getBlockPrefix()
    {
        return 'a2lix_translationsFields';
    }
}
