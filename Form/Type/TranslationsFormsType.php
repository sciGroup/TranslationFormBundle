<?php

namespace A2lix\TranslationFormBundle\Form\Type;

use A2lix\TranslationFormBundle\Form\DataMapper\IndexByTranslationMapper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *
 *
 * @author David ALLIX
 */
class TranslationsFormsType extends AbstractType
{
    private $locales;
    private $required;

    /**
     *
     * @param type $locales
     * @param type $required
     */
    public function __construct($locales, $required)
    {
        $this->locales = $locales;
        $this->required = $required;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setDataMapper(new IndexByTranslationMapper());

        $formOptions = isset($options['form_options']) ? $options['form_options'] : array();
        foreach ($options['locales'] as $locale) {
            $builder->add($locale, $options['form_type'], $formOptions);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'by_reference' => false,
            'required' => $this->required,
            'locales' => $this->locales,
            'form_type' => null,
            'form_options' => null,
        ));
    }

    public function getBlockPrefix()
    {
        return 'a2lix_translationsForms';
    }
}
