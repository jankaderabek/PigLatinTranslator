<?php
/**
 * Created by PhpStorm.
 * User: Jan Kaderabek
 * Date: 04.06.2016
 * Time: 22:11
 */

namespace App\Models;


class PigLatinTranslator
{
    private static $vowel = ['a', 'e', 'i', 'o', 'u'];
    private static $endWith = 'ay';

    private function isVowel($char)
    {
        return in_array(strtolower($char), self::$vowel);
    }

    private function startWithQu($word)
    {
        return preg_match('/^qu/i', $word, $matches);
    }

    private function translateConsonants($word)
    {
        $body = '';
        $suffix = '';

        foreach (str_split($word) as $index => $char)
        {
            if ($this->isVowel($char) || ($char == 'y' && $index > 0))
            {
                $body = substr($word, $index);
                break;
            }
            else
            {
                $suffix .= $char;
            }
        }

        return $body . $suffix . self::$endWith;
    }

    private function wordToPig($word)
    {
        if (empty($word))
            return '';

        if ($this->isVowel($word[0]))
        {
            return $word . self::$endWith;
        }
        else if ($this->startWithQu($word))
        {
            return substr($word, 2) . 'qu' . self::$endWith;
        }
        else
        {
            return $this->translateConsonants($word);
        }
    }

    /**
     * @param $input string Sequence for translation
     * @return string Translated sequence
     */
    public function ToPigLatin($input)
    {
        $words = explode(' ', $input);
        $result = '';

        foreach ($words as $word)
        {
            $result .= $this->wordToPig($word) . ' ';
        }

        return trim($result);
    }
}