<?php

use Tester\Assert;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../app/models/PigLatinTranslator.php';


Tester\Environment::setup();

$o = new \App\Models\PigLatinTranslator();

Assert::same('appleay', $o->ToPigLatin("apple"));

Assert::same('eastbay', $o->ToPigLatin("beast"));
Assert::same('estionquay', $o->ToPigLatin("question"));
Assert::same('arstay', $o->ToPigLatin("star"));
Assert::same('eethray', $o->ToPigLatin("three"));

Assert::same('ytray', $o->ToPigLatin("try"));
Assert::same('ellowyay', $o->ToPigLatin("yellow"));

Assert::same('ellowyay ytray', $o->ToPigLatin("yellow try "));

Assert::same('ellowyay   eethray ytray', $o->ToPigLatin("yellow   three try"));



