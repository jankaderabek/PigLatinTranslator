<?php
/**
 * Created by PhpStorm.
 * User: Jan Kaderabek
 * Date: 05.06.2016
 * Time: 14:10
 */

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Models;

/**
 * Factory for translator form
 *
 * @package App\Forms
 */
class TranslatorFormFactory
{
    /** @var  Models\PigLatinTranslator */
    public $pigTranslator;

    /**
     * TranslatorFormFactory constructor.
     *
     * @param Models\PigLatinTranslator $translator
     */
    public function __construct(Models\PigLatinTranslator $translator)
    {
        $this->pigTranslator = $translator;
    }

    /**
     * @return Form Translator form
     */
    public function create()
    {
        $form = new Form;

        $form->addTextArea('input', 'English:')
            ->setRequired(true);
        $form->addTextArea('output', 'PigLatin:');
        $form->addSubmit('send', 'Přeložit');

        $form->onSuccess[] = [$this, 'onSuccess'];
        
        return $form;
    }

    /**
     * @param Form $form Processed form
     * @param $values
     */
    public function onSuccess(Form $form, $values)
    {
        $translated = $this->pigTranslator->ToPigLatin($values->input);

        $form['output']->setValue($translated);
    }
}
