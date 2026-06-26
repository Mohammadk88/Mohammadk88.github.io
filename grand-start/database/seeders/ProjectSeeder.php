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
                'title_ar' => 'برج بوسفور الفاخر',
                'title_en' => 'Bosphorus Luxury Tower',
                'title_tr' => 'Boğaz Lüks Kulesi',
                'slug' => 'bosphorus-luxury-tower',
                'description_ar' => 'برج سكني فاخر يتكون من 40 طابقاً بإطلالات خلابة على مضيق البوسفور في إسطنبول. يضم أحدث المرافق والخدمات الفندقية الراقية.',
                'description_en' => 'A luxury residential tower of 40 floors with stunning views of the Bosphorus Strait in Istanbul. Features the latest facilities and premium hotel services.',
                'description_tr' => 'İstanbul\'da Boğaz\'a nefes kesen manzarası olan 40 katlı lüks konut kulesi. En son imkânlar ve premium otel hizmetleri sunmaktadır.',
                'location_ar' => 'بشيكتاش، إسطنبول',
                'location_en' => 'Beşiktaş, Istanbul',
                'location_tr' => 'Beşiktaş, İstanbul',
                'price_usd' => 380000,
                'price_try' => 11000000,
                'price_iqd' => 497000000,
                'area' => '90-280 م²',
                'floors' => 40,
                'units' => 160,
                'status' => 'available',
                'type' => 'tower',
                'featured' => true,
                'active' => true,
                'sort_order' => 1,
                'features' => [
                    ['ar' => 'مسبح مفتوح على السطح', 'en' => 'Rooftop outdoor pool', 'tr' => 'Çatı açık havuzu', 'icon' => 'fas fa-swimming-pool'],
                    ['ar' => 'صالة رياضية مجهزة', 'en' => 'Fully equipped gym', 'tr' => 'Tam donanımlı spor salonu', 'icon' => 'fas fa-dumbbell'],
                    ['ar' => 'حراسة أمنية 24/7', 'en' => '24/7 Security', 'tr' => '24/7 Güvenlik', 'icon' => 'fas fa-shield-alt'],
                    ['ar' => 'موقف سيارات خاص', 'en' => 'Private parking', 'tr' => 'Özel otopark', 'icon' => 'fas fa-parking'],
                    ['ar' => 'إطلالة مباشرة على البوسفور', 'en' => 'Direct Bosphorus view', 'tr' => 'Direkt Boğaz manzarası', 'icon' => 'fas fa-water'],
                    ['ar' => 'خدمات كونسيرج', 'en' => 'Concierge services', 'tr' => 'Konsiyerj hizmetleri', 'icon' => 'fas fa-concierge-bell'],
                ],
            ],
            [
                'title_ar' => 'فيلا أنطاليا الذهبية',
                'title_en' => 'Antalya Golden Villa',
                'title_tr' => 'Antalya Altın Villa',
                'slug' => 'antalya-golden-villa',
                'description_ar' => 'فيلا فاخرة مستقلة على ساحل أنطاليا بحديقة خاصة ومسبح ومطبخ مفتوح. تتميز بالتصميم المعماري العصري المتميز.',
                'description_en' => 'Luxury standalone villa on the Antalya coast with private garden, pool and open kitchen. Features modern contemporary architectural design.',
                'description_tr' => 'Antalya sahilinde özel bahçe, havuz ve açık mutfaklı lüks müstakil villa. Modern çağdaş mimari tasarımıyla öne çıkmaktadır.',
                'location_ar' => 'لارا، أنطاليا',
                'location_en' => 'Lara, Antalya',
                'location_tr' => 'Lara, Antalya',
                'price_usd' => 950000,
                'price_try' => 27500000,
                'price_iqd' => 1243000000,
                'area' => '420 م²',
                'floors' => 2,
                'units' => 1,
                'status' => 'available',
                'type' => 'villa',
                'featured' => true,
                'active' => true,
                'sort_order' => 2,
                'features' => [
                    ['ar' => '5 غرف نوم', 'en' => '5 Bedrooms', 'tr' => '5 Yatak Odası', 'icon' => 'fas fa-bed'],
                    ['ar' => 'مسبح خاص', 'en' => 'Private pool', 'tr' => 'Özel havuz', 'icon' => 'fas fa-swimming-pool'],
                    ['ar' => 'حديقة 250 م²', 'en' => '250 sqm garden', 'tr' => '250 m² bahçe', 'icon' => 'fas fa-leaf'],
                    ['ar' => 'إطلالة بحرية', 'en' => 'Sea view', 'tr' => 'Deniz manzarası', 'icon' => 'fas fa-water'],
                    ['ar' => 'موقف 3 سيارات', 'en' => '3 Car garage', 'tr' => '3 Araçlık garaj', 'icon' => 'fas fa-car'],
                ],
            ],
            [
                'title_ar' => 'مجمع إسطنبول التجاري',
                'title_en' => 'Istanbul Business Complex',
                'title_tr' => 'İstanbul İş Merkezi Kompleksi',
                'slug' => 'istanbul-business-complex',
                'description_ar' => 'مجمع تجاري متكامل يضم مكاتب ومحلات في قلب إسطنبول. استثمار مثالي بعوائد مضمونة في أحد أكثر أسواق العقارات نشاطاً.',
                'description_en' => 'Integrated commercial complex with offices and retail spaces in the heart of Istanbul. Perfect investment with guaranteed returns in one of the most active real estate markets.',
                'description_tr' => 'İstanbul\'un kalbinde ofis ve perakende alanları bulunan entegre ticari kompleks. En aktif gayrimenkul piyasalarından birinde garantili getirili mükemmel yatırım.',
                'location_ar' => 'شيشلي، إسطنبول',
                'location_en' => 'Şişli, Istanbul',
                'location_tr' => 'Şişli, İstanbul',
                'price_usd' => 220000,
                'price_try' => 6400000,
                'price_iqd' => 288000000,
                'area' => '60-180 م²',
                'floors' => 15,
                'units' => 80,
                'status' => 'under_construction',
                'type' => 'commercial',
                'featured' => true,
                'active' => true,
                'sort_order' => 3,
                'features' => [
                    ['ar' => 'موقع استراتيجي مركزي', 'en' => 'Central strategic location', 'tr' => 'Merkezi stratejik konum', 'icon' => 'fas fa-map-marker-alt'],
                    ['ar' => 'قاعة مؤتمرات حديثة', 'en' => 'Modern conference hall', 'tr' => 'Modern konferans salonu', 'icon' => 'fas fa-users'],
                    ['ar' => 'كافيه ومطعم', 'en' => 'Cafe & restaurant', 'tr' => 'Kafe ve restoran', 'icon' => 'fas fa-coffee'],
                    ['ar' => 'عوائد استثمارية مضمونة', 'en' => 'Guaranteed investment returns', 'tr' => 'Garantili yatırım getirileri', 'icon' => 'fas fa-chart-line'],
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
                        'feature_tr' => $feature['tr'] ?? null,
                        'icon'       => $feature['icon'] ?? 'fas fa-check',
                    ]);
                }
            }
        }
    }
}
