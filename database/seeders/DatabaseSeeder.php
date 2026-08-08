<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Statistic;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Admin User
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123123123',
            'active' => true,
            'priv' => 0,
        ]);

        // 2. Seed Company Settings
        $settings = [
            ['para' => 'company_name_ar', 'para_en' => 'Company Name (Arabic)', 'value' => 'تواصل تكنولوجي'],
            ['para' => 'company_name_en', 'para_en' => 'Company Name (English)', 'value' => 'Twasol Technology'],
            ['para' => 'logo', 'para_en' => 'Company Logo', 'imagepath' => 'images/logo.png', 'value' => null],
            ['para' => 'whatsapp', 'para_en' => 'WhatsApp Link', 'value' => 'https://wa.me/967777777777'],
            ['para' => 'facebook', 'para_en' => 'Facebook Link', 'value' => 'https://facebook.com/twasol'],
            ['para' => 'email', 'para_en' => 'Company Email Address', 'value' => 'info@twasol-tech.com'],
            ['para' => 'instagram', 'para_en' => 'Instagram Link', 'value' => 'https://instagram.com/twasol'],
            ['para' => 'youtube', 'para_en' => 'YouTube Link', 'value' => 'https://youtube.com/twasol'],
            ['para' => 'phone', 'para_en' => 'Contact Number', 'value' => '+967777777777'],
            ['para' => 'primary_color', 'para_en' => 'Primary Theme Color', 'value' => '#000000'],
            ['para' => 'secondary_color', 'para_en' => 'Secondary Theme Color', 'value' => '#ffffff'],
            ['para' => 'about_ar', 'para_en' => 'About Us (Arabic)', 'value' => 'نحن في شركة تواصل تكنولوجي نقدم حلول الربط الشبكي المتقدمة لربط الفروع عن بعد بأعلى مستويات الأمان والاستقرار.'],
            ['para' => 'about_en', 'para_en' => 'About Us (English)', 'value' => 'At Twasol Technology, we provide advanced networking solutions to connect branches remotely with the highest level of security and stability.'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        // 3. Seed Sample Statistics
        $stats = [
            [
                'name_ar' => 'العملاء النشطون',
                'name_en' => 'Active Clients',
                'description_ar' => 'عدد الشركات والمؤسسات التي تم ربط فروعها',
                'description_en' => 'Number of companies and entities connected',
                'number' => '150+',
                'icon' => 'fas fa-users'
            ],
            [
                'name_ar' => 'عقود الصيانة الجارية',
                'name_en' => 'Active Maintenance Contracts',
                'description_ar' => 'العقود السنوية للشركات الكبرى',
                'description_en' => 'Annual contracts for major companies',
                'number' => '45+',
                'icon' => 'fas fa-file-contract'
            ],
            [
                'name_ar' => 'نسبة استقرار الشبكات',
                'name_en' => 'Uptime Rate',
                'description_ar' => 'معدل استقرار وثبات خدمات الربط الشبكي',
                'description_en' => 'Network reliability and uptime rate',
                'number' => '99.9%',
                'icon' => 'fas fa-signal'
            ]
        ];

        foreach ($stats as $stat) {
            Statistic::create($stat);
        }

        // 4. Seed Initial Services
        $services = [
            [
                'name_ar' => 'ربط الفروع عبر VMware',
                'name_en' => 'Branch Connection via VMware',
                'description_ar' => 'ربط شبكي متكامل ومستقر بين الفروع والمراكز الرئيسية باستخدام تقنيات VMware والافتراضية لتسهيل مشاركة البيانات والأنظمة.',
                'description_en' => 'Integrated and stable branch-to-headquarters network connection using VMware and virtualization tech for easy sharing of data and systems.',
                'price' => null
            ],
            [
                'name_ar' => 'ربط الفروع عبر Citrix',
                'name_en' => 'Branch Connection via Citrix',
                'description_ar' => 'تقديم حلول Citrix السحابية لتشغيل التطبيقات والبرامج الحساسة عن بعد وبأعلى كفاءة وسرعة استجابة.',
                'description_en' => 'Providing Citrix cloud solutions to run critical applications and software remotely with top efficiency and response speed.',
                'price' => null
            ],
            [
                'name_ar' => 'ربط الأنظمة والمستخدمين عبر TSplus',
                'name_en' => 'Remote Desktop access via TSplus',
                'description_ar' => 'توفير تراخيص وإعداد خوادم TSplus للوصول الآمن لسطح المكتب والتطبيقات والمحاسبة لأي عدد من المستخدمين من أي مكان.',
                'description_en' => 'Providing licenses and setting up TSplus servers for secure remote desktop and accounting application access from anywhere.',
                'price' => null
            ],
            [
                'name_ar' => 'الحلول السحابية (Cloud Solutions)',
                'name_en' => 'Cloud Solutions',
                'description_ar' => 'نوفر لمؤسستك بيئة سحابية فائقة الأداء تضمن استمرارية أعمالك بكفاءة وأمان تام. تمتاز سيرفراتنا السحابية بالمرونة العالية والقدرة على التوسع الفوري لتلبية تطلعات نمو مشاريعك، مع حماية متكاملة ودعم فني متواصل لضمان تشغيل تطبيقاتك دون انقطاع.',
                'description_en' => 'We provide your organization with a high-performance cloud environment that ensures business continuity with efficiency and security. Our cloud servers offer high flexibility and instant scalability with complete protection and support.',
                'price' => null
            ],
            [
                'name_ar' => 'خدمة استعادة قواعد البيانات المتضررة والمشفرة',
                'name_en' => 'Encrypted & Damaged Database Recovery Service',
                'description_ar' => 'نساعدك في إنقاذ عملك بعد هجمات الفدية دون الحاجة لفك تشفير كامل النظام. نركز مباشرة على استخراج البيانات من (Oracle, SQL Server, MySQL). الفحص والتأهيل: معاينة السيرفر مجاناً لتحديد امكانية استخراج ملفات قاعدة البيانات. التقييم المالي: تقديم عرض سعر شفاف بناءً على حجم البيانات ونوع النظام. الاستخراج والتسليم: إصلاح بناء البيانات، فحص سلامة الجداول، وتسليمك قاعدة بيانات جاهزة للتشغيل المباشر.',
                'description_en' => 'We help rescue your business after ransomware attacks without needing to decrypt the entire system. We focus directly on data extraction from Oracle, SQL Server, and MySQL with free inspection, transparent evaluation, and DB repair.',
                'price' => null
            ]
        ];

        foreach ($services as $srv) {
            Service::create($srv);
        }
    }
}