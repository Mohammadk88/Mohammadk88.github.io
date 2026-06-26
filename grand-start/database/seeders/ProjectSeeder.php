<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectFeature;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title_ar' => 'برج النخبة الفاخر',
                'title_en' => 'Elite Luxury Tower',
                'slug' => 'elite-luxury-tower',
                'description_ar' => 'برج سكني فاخر يتكون من 45 طابقاً يوفر إطلالات خلابة على الخليج العربي. يضم أحدث المرافق والخدمات الفندقية.',
                'description_en' => 'A luxury residential tower consisting of 45 floors offering stunning views of the Arabian Gulf. Features the latest facilities and hotel services.',
                'location_ar' => 'دبي مارينا، دبي',
                'location_en' => 'Dubai Marina, Dubai',
                'price_usd' => 450000,
                'price_iqd' => 590000000,
                'area' => '120-350 م²',
                'floors' => 45,
                'units' => 180,
                'status' => 'available',
                'type' => 'tower',
                'featured' => true,
                'active' => true,
                'sort_order' => 1,
                'features' => [
                    ['ar' => 'مسبح خارجي على السطح', 'en' => 'Rooftop outdoor pool', 'icon' => 'fas fa-swimming-pool'],
                    ['ar' => 'صالة رياضية مجهزة', 'en' => 'Fully equipped gym', 'icon' => 'fas fa-dumbbell'],
                    ['ar' => 'أمن 24/7', 'en' => '24/7 Security', 'icon' => 'fas fa-shield-alt'],
                    ['ar' => 'موقف سيارات خاص', 'en' => 'Private parking', 'icon' => 'fas fa-parking'],
                    ['ar' => 'إطلالة بحرية مباشرة', 'en' => 'Direct sea view', 'icon' => 'fas fa-water'],
                    ['ar' => 'خدمات كونسيرج', 'en' => 'Concierge services', 'icon' => 'fas fa-concierge-bell'],
                ],
            ],
            [
                'title_ar' => 'فيلا الياسمين',
                'title_en' => 'Jasmine Villa',
                'slug' => 'jasmine-villa',
                'description_ar' => 'فيلا فاخرة مستقلة في مجمع سكني راقٍ، بحديقة خاصة ومسبح. تتميز بالتصميم المعماري الحديث.',
                'description_en' => 'Luxury standalone villa in an upscale residential complex with private garden and pool. Features modern architectural design.',
                'location_ar' => 'المرابع العربية، دبي',
                'location_en' => 'Arabian Ranches, Dubai',
                'price_usd' => 1200000,
                'price_iqd' => 1570000000,
                'area' => '480 م²',
                'floors' => 3,
                'units' => 1,
                'status' => 'available',
                'type' => 'villa',
                'featured' => true,
                'active' => true,
                'sort_order' => 2,
                'features' => [
                    ['ar' => '5 غرف نوم', 'en' => '5 Bedrooms', 'icon' => 'fas fa-bed'],
                    ['ar' => 'مسبح خاص', 'en' => 'Private pool', 'icon' => 'fas fa-swimming-pool'],
                    ['ar' => 'حديقة 300 م²', 'en' => '300 sqm garden', 'icon' => 'fas fa-leaf'],
                    ['ar' => 'غرفة خادمة', 'en' => 'Maid room', 'icon' => 'fas fa-home'],
                    ['ar' => 'موقف 4 سيارات', 'en' => '4 Car garage', 'icon' => 'fas fa-car'],
                ],
            ],
            [
                'title_ar' => 'مجمع الأعمال التجارية',
                'title_en' => 'Business Center Complex',
                'slug' => 'business-center-complex',
                'description_ar' => 'مجمع تجاري متكامل يضم مكاتب ومحلات تجارية في قلب المدينة. استثمار مثالي للمستثمرين.',
                'description_en' => 'Integrated commercial complex featuring offices and retail spaces in the heart of the city. Perfect investment for investors.',
                'location_ar' => 'منطقة الأعمال المركزية، بغداد',
                'location_en' => 'Central Business District, Baghdad',
                'price_usd' => 280000,
                'price_iqd' => 366000000,
                'area' => '80-200 م²',
                'floors' => 12,
                'units' => 60,
                'status' => 'under_construction',
                'type' => 'commercial',
                'featured' => true,
                'active' => true,
                'sort_order' => 3,
                'features' => [
                    ['ar' => 'موقع استراتيجي', 'en' => 'Strategic location', 'icon' => 'fas fa-map-marker-alt'],
                    ['ar' => 'قاعة مؤتمرات', 'en' => 'Conference hall', 'icon' => 'fas fa-users'],
                    ['ar' => 'كافيه ومطعم', 'en' => 'Cafe & restaurant', 'icon' => 'fas fa-coffee'],
                    ['ar' => 'تشطيبات عالية الجودة', 'en' => 'High-quality finishes', 'icon' => 'fas fa-star'],
                ],
            ],
        ];

        foreach ($projects as $projectData) {
            $features = $projectData['features'] ?? [];
            unset($projectData['features']);

            $project = Project::firstOrCreate(
                ['slug' => $projectData['slug']],
                $projectData
            );

            if ($project->wasRecentlyCreated) {
                foreach ($features as $feature) {
                    ProjectFeature::create([
                        'project_id' => $project->id,
                        'feature_ar' => $feature['ar'],
                        'feature_en' => $feature['en'],
                        'icon' => $feature['icon'] ?? 'fas fa-check',
                    ]);
                }
            }
        }
    }
}
