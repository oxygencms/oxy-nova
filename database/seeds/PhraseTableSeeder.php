<?php

use Illuminate\Database\Seeder;
use Oxygencms\OxyNova\Models\Phrase;
use Illuminate\Support\Facades\Cache;

class PhraseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phrases = [
            [
                'name' => 'db',
                'items' => [
                    [
                        'key' => 'password-recommendation',
                        'message' => [
                            'en' => 'Avoid passwords that are easy to guess or used with other websites',
                            'bg' => 'Избягвайте пароли които са лесни за догатване или използвате за дуги сайтове'
                        ],
                    ]
                ],
            ],

            [
                'name' => 'headings',
                'items' => [
                    [
                        'key' => 'dashboard',
                        'message' => [
                            'en' => 'Dashboard',
                            'bg' => 'Дашборд',
                        ],
                    ],
                    [
                        'key' => 'personal-information',
                        'message' => [
                            'en' => 'Personal information',
                            'bg' => 'Лична информация',
                        ],
                    ],
                    [
                        'key' => 'change-password',
                        'message' => [
                            'en' => 'Change password',
                            'bg' => 'Промяна на парола',
                        ],
                    ],
                ],
            ],

            [
                'name' => 'links',
                'items' => [
                    [
                        'key' => 'facebook-login',
                        'message' => [
                            'en' => 'Facebook login',
                            'bg' => 'Вход с Facebook',
                        ],
                    ],
                    [
                        'key' => 'twitter-login',
                        'message' => [
                            'en' => 'Twitter login',
                            'bg' => 'Вход с Twitter',
                        ],
                    ],
                    [
                        'key' => 'gplus-login',
                        'message' => [
                            'en' => 'Google+',
                            'bg' => 'Вход с Google+',
                        ],
                    ],
                    [
                        'key' => 'dashboard',
                        'message' => [
                            'en' => 'Dashboard',
                            'bg' => 'Дашборд',
                        ],
                    ],
                    [
                        'key' => 'update',
                        'message' => [
                            'en' => 'Update',
                            'bg' => 'Промени',
                        ],
                    ],
                    [
                        'key' => 'back-to-top',
                        'message' => [
                            'en' => 'Back to top',
                            'bg' => 'Обратно горе',
                        ],
                    ],
                    [
                        'key' => 'forgotten-password',
                        'message' => [
                            'en' => 'Forgotten password?',
                            'bg' => 'Забравена парола?',
                        ],
                    ],
                ],
            ],

            [
                'name' => 'buttons',
                'items'  => [
                    [
                        'key' => 'send',
                        'message' => [
                            'en' => 'Send',
                            'bg' => 'Изпрати',
                        ],
                    ],
                    [
                        'key' => 'sign-up',
                        'message' => [
                            'en' => 'Sign up',
                            'bg' => 'Запиши се',
                        ],
                    ],
                    [
                        'key' => 'register',
                        'message' => [
                            'en' => 'Register',
                            'bg' => 'Регистрация',
                        ],
                    ],
                    [
                        'key' => 'log-in',
                        'message' => [
                            'en' => 'Log in',
                            'bg' => 'Вход',
                        ],
                    ],
                    [
                        'key' => 'reset-password',
                        'message' => [
                            'en' => 'Reset Password',
                            'bg' => 'Промяни паролата',
                        ],
                    ],
                ],
            ],

            [
                'name' => 'labels',
                'items' => [
                    [
                        'key' => 'search',
                        'message' => [
                            'en' => 'Search',
                            'bg' => 'Търсене',
                        ],
                    ],
                    [
                        'key' => 'name',
                        'message' => [
                            'en' => 'Name',
                            'bg' => 'Име',
                        ],
                    ],
                    [
                        'key' => 'phone',
                        'message' => [
                            'en' => 'Phone',
                            'bg' => 'Снимка',
                        ],
                    ],
                    [
                        'key' => 'email',
                        'message' => [
                            'en' => 'Email',
                            'bg' => 'Email адрес',
                        ],
                    ],
                    [
                        'key' => 'password',
                        'message' => [
                            'en' => 'Password',
                            'bg' => 'Парола',
                        ],
                    ],
                    [
                        'key' => 'password-confirmation',
                        'message' => [
                            'en' => 'Confirm password',
                            'bg' => 'Потвърди паролата',
                        ],
                    ],
                    [
                        'key' => 'current-password',
                        'message' => [
                            'en' => 'Current password',
                            'bg' => 'Текуща парола',
                        ],
                    ],
                    [
                        'key' => 'new-password',
                        'message' => [
                            'en' => 'New password',
                            'bg' => 'Нова парола',
                        ],
                    ],
                    [
                        'key' => 'confirm-new-password',
                        'message' => [
                            'en' => 'Confirm new password',
                            'bg' => 'Потвърди новата парола',
                        ],
                    ],
                    [
                        'key' => 'country',
                        'message' => [
                            'en' => 'Country',
                            'bg' => 'Държава',
                        ],
                    ],
                    [
                        'key' => 'city',
                        'message' => [
                            'en' => 'City',
                            'bg' => 'Град',
                        ],
                    ],
                    [
                        'key' => 'postcode',
                        'message' => [
                            'en' => 'Postcode',
                            'bg' => 'Пощенски код',
                        ],
                    ],
                    [
                        'key' => 'description',
                        'message' => [
                            'en' => 'Description',
                            'bg' => 'Оптисание',
                        ],
                    ],
                    [
                        'key' => 'active',
                        'message' => [
                            'en' => 'Active',
                            'bg' => 'Активно',
                        ],
                    ],
                    [
                        'key' => 'inactive',
                        'message' => [
                            'en' => 'Inactive',
                            'bg' => 'Деактивирано',
                        ],
                    ],
                    [
                        'key' => 'length',
                        'message' => [
                            'en' => 'Length',
                            'bg' => 'Дължина',
                        ],
                    ],
                    [
                        'key' => 'width',
                        'message' => [
                            'en' => 'Width',
                            'bg' => 'Ширина',
                        ],
                    ],
                    [
                        'key' => 'height',
                        'message' => [
                            'en' => 'Height',
                            'bg' => 'Височина',
                        ],
                    ],
                    [
                        'key' => 'message',
                        'message' => [
                            'en' => 'Message',
                            'bg' => 'Съобщение',
                        ],
                    ],
                    [
                        'key' => 'address',
                        'message' => [
                            'en' => 'Address',
                            'bg' => 'Адрес',
                        ],
                    ],
                    [
                        'key' => 'address-2',
                        'message' => [
                            'en' => 'Address 2',
                            'bg' => 'Адрес 2',
                        ],
                    ],
                    [
                        'key' => 'male',
                        'message' => [
                            'en' => 'Male',
                            'bg' => 'Мъж',
                        ],
                    ],
                    [
                        'key' => 'female',
                        'message' => [
                            'en' => 'Female',
                            'bg' => 'Жена',
                        ],
                    ],
                    [
                        'key' => 'non-binary',
                        'message' => [
                            'en' => 'Non binary',
                            'bg' => 'Не определен',
                        ],
                    ],
                    [
                        'key' => 'i-agree',
                        'message' => [
                            'en' => 'I Agree',
                            'bg' => 'Съгласен съм',
                        ],
                    ],
                ],
            ],
        ];

        Cache::tags('phrases')->flush();

        foreach ($phrases as $group) {
            foreach ($group['items'] as $phrase) {
                Phrase::create([
                    'group' => $group['name'],
                    'key' => $phrase['key'],
                    'message' => $phrase['message'],
                ]);
            }
        }
    }
}
