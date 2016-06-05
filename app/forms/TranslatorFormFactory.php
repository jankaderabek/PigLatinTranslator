<?php
/**
 * Created by PhpStorm.
 * User: Honza
 * Date: 05.06.2016
 * Time: 14:10
 */

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use App\Models;

class TranslatorFormFactory
{
    /**
     * @var  Models\PigLatinTranslator
     */
    public $pigTranslator;

    public function __construct(Models\PigLatinTranslator $translator)
    {
        $this->pigTranslator = $translator;
    }

    /**
     * @return Form
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

    public function onSuccess(Form $form, $values)
    {
        $translated = $this->pigTranslator->ToPigLatin($values->input);

        $form['output']->setValue($translated);
    }
}
