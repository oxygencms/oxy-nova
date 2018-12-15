<?php

use Illuminate\Database\Seeder;
use Oxygencms\OxyNova\Models\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'name' => 'home',
                'template' => 'home',
                'slug' => [
                    'en' => '/',
                    'bg' => '/',
                ],
                'title' => [
                    'en' => 'Home',
                    'bg' => 'Начало',
                ],
            ],

            [
                'name' => 'terms_and_conditions',
                'template' => 'terms_and_conditions',
                'slug' => [
                    'en' => 'terms-and-conditions',
                    'bg' => 'terms-and-conditions',
                ],
                'title' => [
                    'en' => 'Terms and Conditions',
                    'bg' => 'Условия за ползване',
                ],
            ],

            [
                'name' => 'about_us',
                'template' => 'about_us',
                'slug' => [
                    'en' => 'about-us',
                    'bg' => 'about-us',
                ],
                'title' => [
                    'en' => 'About Us',
                    'bg' => 'За нас',
                ],
            ],

            [
                'name' => 'contact_us',
                'template' => 'contact_us',
                'slug' => [
                    'en' => 'contact-us',
                    'bg' => 'contact-us',
                ],
                'title' => [
                    'en' => 'Contact Us',
                    'bg' => 'Контакти',
                ],
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
