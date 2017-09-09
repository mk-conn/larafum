<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace App\Http\Controllers;


class AppController
{
    public function index()
    {
        $indexHtml = file_get_contents(public_path('ember-frontend/index.html'));

        $pattern = [
            '~assets/vendor.css~',
            '~assets/larafum.css~',
            '~assets/vendor.js~',
            '~assets/larafum.js~'
        ];
        $replacements = [
            'ember-frontend/assets/vendor.css',
            'ember-frontend/assets/larafum.css',
            'ember-frontend/assets/vendor.js',
            'ember-frontend/assets/larafum.js'
        ];

        $indexHtml = preg_replace_array($pattern, $replacements, $indexHtml);


        return view('app', ['app' => $indexHtml]);

    }
}