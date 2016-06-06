<?php
/**
 * Created by PhpStorm.
 * User: Jan Kaderabek
 * Date: 04.06.2016
 * Time: 22:11
 */

namespace App\Models;

/**
 * Class PigLatinTranslator
 * @package App\Models
 */
class PigLatinTranslator
{
    private static $vowel = ['a', 'e', 'i', 'o', 'u'];
    private static $endWith = 'ay';

    /**
     * Check if given character is vowel
     *
     * @param $char string First char of word
     * @return bool
     */
    private function isVowel($char)
    {
        return in_array(strtolower($char), self::$vowel);
    }

    /**
     * Check if given word is starting with "qu"
     *
     * @param $word string Word for translate
     * @return int
     */
    private function startWithQu($word)
    {
        return preg_match('/^qu/i', $word, $matches);
    }

    /**
     * Translate given word starting with consonants to Pig Latin
     *
     * @param $word string World for translate
     * @return string Translated word
     */
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

            $suffix .= $char;
        }

        return $body . $suffix . self::$endWith;
    }

    /**
     * Translate given word to PigLatin
     *
     * @param $word string Word for translate
     * @return string Translated word
     */
    private function wordToPig($word)
    {
        if (empty($word))
        {
            return '';
        }

        if ($this->isVowel($word[0]))
        {
            return $word . self::$endWith;
        }

        if ($this->startWithQu($word))
        {
            return substr($word, 2) . 'qu' . self::$endWith;
        }

        return $this->translateConsonants($word);
    }

    /**
     * Translate given string from English to PigLatin
     *
     * @param $input string String for translation
     * @return string Translated string
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