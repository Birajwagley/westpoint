<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function getNepaliMonth($m)
    {
        $n_month = false;
        switch ($m) {
            case '१':
                $n_month = 'बैशाख';
                break;
            case '२':
                $n_month = 'जेष्ठ';
                break;
            case '३':
                $n_month = 'असार';
                break;
            case '४':
                $n_month = 'श्रावण';
                break;
            case '५':
                $n_month = 'भाद्र';
                break;
            case '६':
                $n_month = 'आश्विन';
                break;
            case '७':
                $n_month = 'कार्तिक';
                break;
            case '८':
                $n_month = 'मंसिर';
                break;
            case '९':
                $n_month = 'पुष';
                break;
            case '१०':
                $n_month = 'माघ';
                break;
            case '११':
                $n_month = 'फाल्गुन';
                break;
            case '१२':
                $n_month = 'चैत्र';
                break;
        }

        return $n_month;
    }

    public static function getNepaliCountryName($code)
    {
        $countries = file_get_contents(public_path('json/countries.json'));
        $countries = json_decode($countries);

        return collect($countries)->where('code', Str::upper($code))->pluck('name_ne')->first() ?? countries()[$code]['name'];
    }

    public static function convertEnglishToNepaliNumbers($number)
    {
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $nepaliDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

        return str_replace($englishDigits, $nepaliDigits, $number);
    }

    public static function stripInlineStyle($content)
    {
        return preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);
    }
}
