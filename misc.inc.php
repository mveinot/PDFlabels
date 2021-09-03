<?php

// if the name was entered "Last, First", flip it around and remove the comma
function normalize_name($name, $first_only)
{
        $full_name = '';

        if (strpos($name, ',') !== FALSE)
        {
                preg_match('/^(.*),\s*(.*)$/',$name,$matches);
                if ($first_only == "on") {
                        $full_name = "$matches[2]";
                } else {
                        $full_name = "$matches[2] $matches[1]";
                }
        } else
        {
                if ($first_only == "on") {
                        $split_name = explode(' ', $name);
                        $full_name = $split_name[0];
                } else { 
                        $full_name = $name;
                }
        }

        return $full_name;
}

function em($word) {

        $search = array('@', '`', '¢', '£', '¥', '|', '«', '¬', '¯', 'º', '±', 'ª', 'µ', '»', '¼', '½', '¿', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'Þ', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', '÷', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ');

        $replace = array('%40', '%60', '%A2', '%A3', '%A5', '%A6', '%AB', '%AC', '%AD', '%B0', '%B1', '%B2', '%B5', '%BB', '%BC', '%BD', '%BF', '%C0', '%C1', '%C2', '%C3', '%C4', '%C5', '%C6', '%C7', '%C8', '%C9', '%CA', '%CB', '%CC', '%CD', '%CE', '%CF', '%D0', '%D1', '%D2', '%D3', '%D4', '%D5', '%D6', '%D8', '%D9', '%DA', '%DB', '%DC', '%DD', '%DE', '%DF', '%E0', '%E1', '%E2', '%E3', '%E4', '%E5', '%E6', '%E7', '%E8', '%E9', '%EA', '%EB', '%EC', '%ED', '%EE', '%EF', '%F0', '%F1', '%F2', '%F3', '%F4', '%F5', '%F6', '%F7', '%F8', '%F9', '%FA', '%FB', '%FC', '%FD', '%FE', '%FF');

        $escaped = str_replace($search, $replace, $word);

	return $escaped;
}
