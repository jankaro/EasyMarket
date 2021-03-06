<?php


namespace App;


class Similarity
{
    public static function hamming(string $string1, string $string2, bool $returnDistance = false): float
    {
        $a        = str_pad($string1, strlen($string2) - strlen($string1), ' ');
        $b        = str_pad($string2, strlen($string1) - strlen($string2), ' ');
        $str1= explode(' ', $a);
        $str2= explode(' ', $b);


        $distance = count(array_diff_assoc($str1, $str2));


        if ($returnDistance) {

            $i = 0; $count = 0;
           foreach ($str1 as $item1){
               foreach ($str2 as $item2){
                   if (soundex($item1) == soundex($item2)){
                       $count++;
                   }
               }
           }

            return  ($count/count($str2));
        }
        return (count($array1) - $distance) / count($array1);
    }


    public static function euclidean(array $array1, array $array2, bool $returnDistance = false): float
    {
        $a   = $array1;
        $b   = $array2;
        $set = [];

        foreach ($a as $index => $value) {
            $set[] = $value - $b[$index] ?? 0;
        }

        $distance = sqrt(array_sum(array_map(function ($x) { return pow($x, 2); }, $set)));

        if ($returnDistance) {
            return $distance;
        }
        // doesn't work well with distances larger than 1
        // return 1 / (1 + $distance);
        // so we'll use angular similarity instead
        return 1 - $distance;
    }

    public static function jaccard(string $string1, string $string2, string $separator = ' '): float
    {
        $a            = explode($separator, $string1);
        $b            = explode($separator, $string2);
        if (($key = array_search('&', $a)) !== false) {
            unset($a[$key]);
        }
        if (($key = array_search('&', $b)) !== false) {
            unset($b[$key]);
        }
        $intersection = array_unique(array_intersect($a, $b));
        $union        = array_unique(array_merge($a, $b));

        return count($intersection) / count($union);
    }

    public static function minMaxNorm(array $values, $min = null, $max = null): array
    {
        $norm = [];
        $min  = $min ?? min($values);
        $max  = $max ?? max($values);

        foreach ($values as $value) {
            $numerator   = $value - $min;
            $denominator = $max - $min;
            $minMaxNorm  = $numerator / $denominator;
            $norm[]      = $minMaxNorm;
        }
        return $norm;
    }
}
