<?php

namespace BPC\Service;

class Gunof {

    const Allemand = "german";
    const Français = "french";
    const Anglais = "english";
    const Japonais = "japanese";
    const Arabe = "arabic";

    public static function getNames($race = Gunof::Français, $gender = "M", $nb = 10, $complex = true) {
        if ($race == self::Arabe) {
            $html = self::curlGetHtml($race, $gender, $nb, $complex);
            $res0 = self::extractNames($html, $nb);
            $html = self::curlGetHtml($race, $gender, $nb, $complex);
            $res1 = self::extractNames($html, $nb);
            $result = array();
            for ($i = 0; $i < $nb; $i++) {
                $result[] = $res0[$i] . " " . $res1[$i];
            }
            return $result;
        } else {
            $html = self::curlGetHtml($race, $gender, $nb, $complex);
            return self::extractNames($html, $nb);
        }
    }

    private static function curlGetHtml($race = Gunof::Français, $gender = "M", $nb = 10, $complex = true) {
        $ressource = curl_init();
        $nb = $nb + 5;
        $fields = array(
            "data[Name][nation]" => $race,
            "data[Name][gender]" => $gender,
            "data[Name][complex]" => $complex,
            "data[Name][num]" => $nb,
        );
        if ($race == self::Arabe) {
            $fields["data[Name][complex]"] = false;
        }
        $fields_string = http_build_query($fields);
        curl_setopt($ressource, CURLOPT_URL, "http://www.gunof.net/");
        curl_setopt($ressource, CURLOPT_REFERER, "http://www.gunof.net/");
        curl_setopt($ressource, CURLOPT_POST, count($fields));
        curl_setopt($ressource, CURLOPT_POSTFIELDS, $fields_string);
        ob_start();
        $result = curl_exec($ressource);
        $html = ob_get_contents();
        ob_clean();
        curl_close($ressource);
        return $html;
    }

    private static function extractNames($html, $nb) {
        //echo $html;
        setlocale(LC_TIME, 'fr_FR');
        $nom = [];
        $matches = [];
        if (preg_match_all('/(<div class="result">([\wéèàëêïç\-\s]+)<\/div>)+/', $html, $matches)) {
            foreach ($matches[0] as $line) {
                $tmp = $line;
                do {
                    preg_match_all('#(<div class="result">([\wéèëàêçï\-\s]+)<\/div>)+#', $tmp, $matchesb);
                    $tmp = str_replace($matchesb[1][0], "", $tmp);
                    $nom[] = $matchesb[2][0];
                } while ($tmp != "");
            }
        }
        return array_slice($nom, 0, $nb);
    }

}
