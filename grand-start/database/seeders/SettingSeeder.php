<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Company
            ['key' => 'company_name_ar', 'value' => 'جراند ستار للعقارات', 'group' => 'company'],
            ['key' => 'company_name_en', 'value' => 'Grand Start Real Estate', 'group' => 'company'],
            ['key' => 'company_name_ku', 'value' => 'گراند ستار بۆ خانووبەرە', 'group' => 'company'],
            ['key' => 'company_tagline_ar', 'value' => 'نحول أحلامك إلى واقع', 'group' => 'company'],
            ['key' => 'company_tagline_en', 'value' => 'Turning Your Dreams Into Reality', 'group' => 'company'],
            ['key' => 'company_years', 'value' => '15', 'group' => 'company'],
            ['key' => 'total_clients', 'value' => '1200', 'group' => 'company'],
            ['key' => 'countries_count', 'value' => '8', 'group' => 'company'],

            // Hero
            ['key' => 'hero_title_ar', 'value' => 'اكتشف عقارات فاخرة بمعايير عالمية', 'group' => 'hero'],
            ['key' => 'hero_title_en', 'value' => 'Discover Luxury Properties with World-Class Standards', 'group' => 'hero'],
            ['key' => 'hero_subtitle_ar', 'value' => 'نقدم لك أفضل المشاريع العقارية في المنطقة بأعلى مستويات الجودة والموثوقية', 'group' => 'hero'],
            ['key' => 'hero_subtitle_en', 'value' => 'We offer you the best real estate projects in the region with the highest levels of quality and reliability', 'group' => 'hero'],

            // Contact - Default (International/UAE)
            ['key' => 'phone_default', 'value' => '+971 50 123 4567', 'group' => 'contact'],
            ['key' => 'email_default', 'value' => 'info@grandstartrealestate.com', 'group' => 'contact'],
            ['key' => 'whatsapp_default', 'value' => '+971501234567', 'group' => 'contact'],
            ['key' => 'address_default_ar', 'value' => 'دبي، الإمارات العربية المتحدة', 'group' => 'contact'],
            ['key' => 'address_default_en', 'value' => 'Dubai, United Arab Emirates', 'group' => 'contact'],

            // Contact - Iraq
            ['key' => 'phone_iraq', 'value' => '+964 750 123 4567', 'group' => 'contact_iraq'],
            ['key' => 'email_iraq', 'value' => 'iraq@grandstartrealestate.com', 'group' => 'contact_iraq'],
            ['key' => 'whatsapp_iraq', 'value' => '+9647501234567', 'group' => 'contact_iraq'],
            ['key' => 'address_iraq_ar', 'value' => 'بغداد، العراق - شارع الكرادة', 'group' => 'contact_iraq'],
            ['key' => 'address_iraq_en', 'value' => 'Baghdad, Iraq - Karada Street', 'group' => 'contact_iraq'],

            // Social Media
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/grandstartrealestate', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/grandstartrealestate', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => '', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => '', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => '', 'group' => 'social'],

            // About
            ['key' => 'about_text_ar', 'value' => 'شركة جراند ستار للعقارات هي شركة رائدة في مجال التطوير العقاري، تأسست بهدف تقديم أفضل الحلول العقارية للعملاء في المنطقة والعالم. نحن نؤمن بأن كل عميل يستحق أفضل تجربة عقارية ممكنة، ولهذا نضع معايير عالية الجودة في كل مشروع نقوم بتطويره.', 'group' => 'about'],
            ['key' => 'about_text_en', 'value' => 'Grand Start Real Estate is a leading real estate development company, founded with the goal of providing the best real estate solutions to clients in the region and worldwide. We believe every client deserves the best possible real estate experience, which is why we set high quality standards in every project we develop.', 'group' => 'about'],
            ['key' => 'about_text_ku', 'value' => 'کۆمپانیای گراند ستار بۆ خانووبەرە کۆمپانیایەکی پێشەنگی گەشەسەندنی خانووبەرەیە', 'group' => 'about'],

            // SEO
            ['key' => 'meta_title_ar', 'value' => 'جراند ستار للعقارات - عقارات فاخرة', 'group' => 'seo'],
            ['key' => 'meta_title_en', 'value' => 'Grand Start Real Estate - Luxury Properties', 'group' => 'seo'],
            ['key' => 'meta_description_ar', 'value' => 'جراند ستار للعقارات - نقدم أفضل المشاريع العقارية الفاخرة', 'group' => 'seo'],
            ['key' => 'meta_description_en', 'value' => 'Grand Start Real Estate - We offer the best luxury real estate projects', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }
}
