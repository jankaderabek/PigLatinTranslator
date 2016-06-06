<?php

namespace Tests;

use Nette;
use Tester;
use Tester\Assert;
use App\Models;

$container = require __DIR__ . '/bootstrap.php';

class PigTranslatorTest extends Tester\TestCase
{
    private $container;
    private $translator;

    function __construct(Nette\DI\Container $container)
    {
        $this->container = $container;
        $this->translator = $this->container->createInstance(Models\PigLatinTranslator::class);
    }

    function testToPigLatin()
    {
        Assert::same('appleay', $this->translator->ToPigLatin("apple"));

        Assert::same('eastbay', $this->translator->ToPigLatin("beast"));
        Assert::same('estionquay', $this->translator->ToPigLatin("question"));
        Assert::same('arstay', $this->translator->ToPigLatin("star"));
        Assert::same('eethray', $this->translator->ToPigLatin("three"));

        Assert::same('ytray', $this->translator->ToPigLatin("try"));
        Assert::same('ellowyay', $this->translator->ToPigLatin("yellow"));

        Assert::same('ellowyay ytray', $this->translator->ToPigLatin("yellow try "));

        Assert::same('ellowyay   eethray ytray', $this->translator->ToPigLatin("yellow   three try"));
    }
}

$translatorTest = new PigTranslatorTest($container);
$translatorTest->run();
