<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class CleanUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = urldecode($request->url());
        if ($this->hasAccent($url)) {
            $clean = $this->replace_accents($url);
            $clean = strtolower($clean);
            $clean = str_replace('·', '', $clean);
            if (strpos($url, 'storage') === false) {
                return Redirect::to($clean);
            }
        }
        return $next($request);
    }

    public function hasAccent($string)
    {
        $accented = array('·', ' ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
        foreach ($accented as $a) {
            if (strpos($string, $a) !== false) {
                return true;
            }
        }
        return false;
    }


    function replace_accents($str)
    {
        $str = htmlentities($str, ENT_COMPAT, "UTF-8");
        $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', '$1', $str);
        return html_entity_decode($str);
    }

    function urlify($string, $trim = true, $allow = null, $replace = null)
    {
        if (!is_string($string)) {
            throw new Exception('$string must be a string');
        }

        $_replace = array(
            0xE4 => "\0\0\0\x61\0\0\0\x65", // ä
            0xC4 => "\0\0\0\x41\0\0\0\x65", // Ä
            0xF6 => "\0\0\0\x6F\0\0\0\x65", // ö
            0xD6 => "\0\0\0\x4F\0\0\0\x65", // Ö
            0xFC => "\0\0\0\x75\0\0\0\x65", // ü
            0xDC => "\0\0\0\x55\0\0\0\x65", // Ü
            0xDF => "\0\0\0\x73\0\0\0\x73", // ß
            0xE6 => "\0\0\0\x61\0\0\0\x65", // æ
            0xC6 => "\0\0\0\x41\0\0\0\x65", // Æ
        );

        if ($replace && is_array($replace)) {
            foreach ($replace as $k => $v) {
                $_replace[$k] = mb_convert_encoding($v, "UTF-32BE");
            }
        }

        if ($allow && is_string($allow)) {
            $t = mb_convert_encoding($allow, "UTF-32BE");
            $t = unpack("N*", $t);
            $allow = array();
            foreach ($t as $k) {
                $allow[$k] = true;
            }
        } elseif ($allow && !is_array($allow)) {
            $allow = null;
        }

        $res = '';
        $string = mb_convert_encoding($string, "UTF-32BE");
        $unicodes = unpack("N*", $string);
        $i = -1;

        foreach ($unicodes as $code) {
            $i++;

            if (($code >= 97 && $code <= 122) || ($code >= 65 && $code <= 90) || ($code >= 48 && $code <= 57) || $code == 95 || $code == 45) {
                // skip normalization for alphanumeric characters [a-zA-Z0-9_-]
                $res .= mb_substr($string, $i, 1, "UTF-32BE");
            } elseif ($allow && isset($allow[$code])) {
                // skip normalization for allowed characters
                $res .= mb_substr($string, $i, 1, "UTF-32BE");
            } elseif (isset($_replace[$code])) {
                // replace as defined
                $res .= $_replace[$code];
            } elseif (($code >= 0xC0 && $code <= 0xC6) || ($code >= 0xE0 && $code <= 0xE6) || ($code >= 0x100 && $code <= 0x105)) {
                $res .= "\0\0\0\x61"; // a
            } elseif ($code == 0xC7 || $code == 0xE7 || ($code >= 0x106 && $code <= 0x10D)) {
                $res .= "\0\0\0\x63"; // c
            } elseif ($code == 0xD0 || ($code >= 0x10E && $code <= 0x111)) {
                $res .= "\0\0\0\x64"; // d
            } elseif (($code >= 0xC8 && $code <= 0xCB) || ($code >= 0xE8 && $code <= 0xEB) || ($code >= 0x112 && $code <= 0x11B)) {
                $res .= "\0\0\0\x65"; // e
            } elseif (($code >= 0xCC && $code <= 0xCF) || ($code >= 0xEC && $code <= 0xEF)) {
                $res .= "\0\0\0\x69"; // i
            } elseif ($code == 0xD1 || $code == 0xF1) {
                $res .= "\0\0\0\x6E"; // n
            } elseif (($code >= 0xD2 && $code <= 0xD8) || ($code >= 0xF2 && $code <= 0xF8)) {
                $res .= "\0\0\0\x6F"; // o
            } elseif (($code >= 0xD9 && $code <= 0xDB) || ($code >= 0xF9 && $code <= 0xFB)) {
                $res .= "\0\0\0\x75"; // u
            } elseif ($code == 0xDD || $code == 0xFD || $code == 0xFF) {
                $res .= "\0\0\0\x79"; // y
            } else {
                $res .= "\0\0\0\x2D"; // -
            }
        }

        if ($trim) {
            $res = preg_replace('#(\0\0\0\x2D){2,}#', "\0\0\0\x2D", $res);
            $res = preg_replace('#(^\0\0\0\x2D)|(\0\0\0\x2D$)#', "", $res);
        }

        return mb_convert_encoding($res, mb_internal_encoding(), "UTF-32BE");
    }
}
