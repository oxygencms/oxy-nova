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
                        ],
                    ],
                    [
                        'key' => 'personal-information',
                        'message' => [
                            'en' => 'Personal information',
                        ],
                    ],
                    [
                        'key' => 'change-password',
                        'message' => [
                            'en' => 'Change password',
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
                        ],
                    ],
                    [
                        'key' => 'twitter-login',
                        'message' => [
                            'en' => 'Twitter login',
                        ],
                    ],
                    [
                        'key' => 'gplus-login',
                        'message' => [
                            'en' => 'Google plus',
                        ],
                    ],
                    [
                        'key' => 'dashboard',
                        'message' => [
                            'en' => 'Dashboard',
                        ],
                    ],
                    [
                        'key' => 'update',
                        'message' => [
                            'en' => 'Update',
                        ],
                    ],
                    [
                        'key' => 'back-to-top',
                        'message' => [
                            'en' => 'Back to top',
                        ],
                    ],
                    [
                        'key' => 'forgotten-password',
                        'message' => [
                            'en' => 'Forgotten password?',
                        ],
                    ],
                ],
            ],

            [
                'name' => 'buttons',
                'items'  => [
                    [
                        'key' => 'contact-us-form-send',
                        'message' => [
                            'en' => 'Send Message',
                        ],
                    ],
                    [
                        'key' => 'sign-up',
                        'message' => [
                            'en' => 'Sign up',
                        ],
                    ],
                    [
                        'key' => 'log-in',
                        'message' => [
                            'en' => 'Log in',
                        ],
                    ],
                    [
                        'key' => 'reset-password',
                        'message' => [
                            'en' => 'Reset Password',
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
                        ],
                    ],
                    [
                        'key' => 'name',
                        'message' => [
                            'en' => 'Name',
                        ],
                    ],
                    [
                        'key' => 'phone',
                        'message' => [
                            'en' => 'Phone',
                        ],
                    ],
                    [
                        'key' => 'email',
                        'message' => [
                            'en' => 'Email',
                        ],
                    ],
                    [
                        'key' => 'password',
                        'message' => [
                            'en' => 'Password',
                        ],
                    ],
                    [
                        'key' => 'password-confirmation',
                        'message' => [
                            'en' => 'Confirm password',
                        ],
                    ],
                    [
                        'key' => 'current-password',
                        'message' => [
                            'en' => 'Current password',
                        ],
                    ],
                    [
                        'key' => 'new-password',
                        'message' => [
                            'en' => 'New password',
                        ],
                    ],
                    [
                        'key' => 'confirm-new-password',
                        'message' => [
                            'en' => 'Confirm new password',
                        ],
                    ],
                    [
                        'key' => 'country',
                        'message' => [
                            'en' => 'Country',
                        ],
                    ],
                    [
                        'key' => 'city',
                        'message' => [
                            'en' => 'City',
                        ],
                    ],
                    [
                        'key' => 'postcode',
                        'message' => [
                            'en' => 'Postcode',
                        ],
                    ],
                    [
                        'key' => 'description',
                        'message' => [
                            'en' => 'Description',
                        ],
                    ],
                    [
                        'key' => 'active',
                        'message' => [
                            'en' => 'Active',
                        ],
                    ],
                    [
                        'key' => 'inactive',
                        'message' => [
                            'en' => 'Inactive',
                        ],
                    ],
                    [
                        'key' => 'length',
                        'message' => [
                            'en' => 'Length',
                        ],
                    ],
                    [
                        'key' => 'width',
                        'message' => [
                            'en' => 'Width',
                        ],
                    ],
                    [
                        'key' => 'height',
                        'message' => [
                            'en' => 'Height',
                        ],
                    ],
                    [
                        'key' => 'message',
                        'message' => [
                            'en' => 'Message',
                        ],
                    ],
                    [
                        'key' => 'address',
                        'message' => [
                            'en' => 'Address',
                        ],
                    ],
                    [
                        'key' => 'address-line1',
                        'message' => [
                            'en' => 'Address line 1',
                        ],
                    ],
                    [
                        'key' => 'address-line2',
                        'message' => [
                            'en' => 'Address line 2',
                        ],
                    ],
                    [
                        'key' => 'male',
                        'message' => [
                            'en' => 'Male',
                        ],
                    ],
                    [
                        'key' => 'female',
                        'message' => [
                            'en' => 'Female',
                        ],
                    ],
                    [
                        'key' => 'non-binary',
                        'message' => [
                            'en' => 'Non binary',
                        ],
                    ],
                    [
                        'key' => 'agree',
                        'message' => [
                            'en' => 'I Agree',
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
