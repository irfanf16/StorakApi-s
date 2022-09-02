<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

trait ApiDataGenerate
{
    /*
    |======================================================================
    | This Function Converts name to slug
    |======================================================================
    */

    public function createSlug($table, $title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($table, $slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($table, $slug, $id = 0)
    {
        return DB::table($table)->select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    /*
       |======================================================================
       | This Function Converts Arbic
       |======================================================================
       */

    protected function translate($data, $lang)
    {
        return GoogleTranslate::trans($data ?? 'Not Provided', $lang);
    }
    public function randomStr($strength)
    {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
}
