<?php

namespace App\Services;

use App\Models\Setting;

class CountryContactService
{
    private static array $countryMap = [
        'IQ' => 'iraq',
        'SY' => 'syria',
        'SA' => 'ksa',
        'AE' => 'uae',
        'KW' => 'kuwait',
        'QA' => 'qatar',
        'BH' => 'bahrain',
        'OM' => 'oman',
        'JO' => 'jordan',
        'EG' => 'egypt',
        'LB' => 'lebanon',
    ];

    public static function getContact(string $countryCode = 'AE'): array
    {
        $suffix = self::$countryMap[strtoupper($countryCode)] ?? null;
        $locale = app()->getLocale();

        if ($suffix) {
            $phone    = Setting::get("phone_{$suffix}") ?: Setting::get('phone_default');
            $whatsapp = Setting::get("whatsapp_{$suffix}") ?: Setting::get('whatsapp_default', env('WHATSAPP_DEFAULT'));
            $email    = Setting::get("email_{$suffix}") ?: Setting::get('email_default');
            $address  = Setting::get("address_{$suffix}_{$locale}")
                     ?: Setting::get("address_{$suffix}_ar")
                     ?: Setting::get("address_default_{$locale}")
                     ?: Setting::get('address_default_ar');
        } else {
            $phone    = Setting::get('phone_default');
            $whatsapp = Setting::get('whatsapp_default', env('WHATSAPP_DEFAULT'));
            $email    = Setting::get('email_default');
            $address  = Setting::get("address_default_{$locale}")
                     ?: Setting::get('address_default_ar');
        }

        return [
            'phone'    => $phone,
            'whatsapp' => $whatsapp,
            'email'    => $email,
            'address'  => $address,
            'has_custom' => $suffix !== null && Setting::get("phone_{$suffix}") !== null,
        ];
    }
}
