<?php

namespace App\Presenters;

use Nette;
use App\Forms;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /** @var  Forms\TranslatorFormFactory @inject */
    public $translatorFactory;

    /**
     * Create component of translator form
     *
     * @return Nette\Application\UI\Form
     */
    public function createComponentTranslatorForm()
    {
        return $this->translatorFactory->create();
    }
}
