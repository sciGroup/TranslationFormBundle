<?php

namespace A2lix\TranslationFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    A2lix\TranslationFormBundle\Form\EventListener\DefaultTranslationsListener,
    A2lix\TranslationFormBundle\Form\DataMapper\IndexByTranslationMapper;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Regroup by locales, all translations fields
 *
 * @author David ALLIX
 */
class TranslationsType extends AbstractType
{
    private $translationsListener;
    private $locales;
    private $required;

    /**
     *
     * @param \A2lix\TranslationFormBundle\Form\EventListener\DefaultTranslationsListener $translationsListener
     * @param type $locales
     * @param type $required
     */
    public function __construct(DefaultTranslationsListener $translationsListener, $locales, $required)
    {
        $this->translationsListener = $translationsListener;
        $this->locales = $locales;
        $this->required = $required;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setDataMapper(new IndexByTranslationMapper());
        $builder->addEventSubscriber($this->translationsListener);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'by_reference' => false,
            'required' => $this->required,
            'locales' => $this->locales,
            'fields' => array(),
        ));
    }

    public function getBlockPrefix()
    {
        return 'a2lix_translations';
    }
}
