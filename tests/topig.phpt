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
    private $o;

    function __construct(Nette\DI\Container $container)
    {
        $this->container = $container;
        $this->o = $this->container->createInstance(Models\PigLatinTranslator::class);
    }

    function testToPigLatin()
    {
        Assert::same('appleay', $this->o->ToPigLatin("apple"));

        Assert::same('eastbay', $this->o->ToPigLatin("beast"));
        Assert::same('estionquay', $this->o->ToPigLatin("question"));
        Assert::same('arstay', $this->o->ToPigLatin("star"));
        Assert::same('eethray', $this->o->ToPigLatin("three"));

        Assert::same('ytray', $this->o->ToPigLatin("try"));
        Assert::same('ellowyay', $this->o->ToPigLatin("yellow"));

        Assert::same('ellowyay ytray', $this->o->ToPigLatin("yellow try "));

        Assert::same('ellowyay   eethray ytray', $this->o->ToPigLatin("yellow   three try"));
    }
}
$test = new PigTranslatorTest($container);
$test->run();







