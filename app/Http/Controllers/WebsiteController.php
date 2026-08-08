<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Statistic;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    private function getSettings(): array
    {
        return Setting::all()->pluck('value', 'para')->all();
    }

    private function getLogoPath(): ?string
    {
        $logoSetting = Setting::where('para', 'logo')->first();
        return $logoSetting?->imagepath;
    }

    public function home()
    {
        $settings = $this->getSettings();
        $logoPath = $this->getLogoPath();
        $services = Service::where('active', true)->with('images')->take(6)->get();
        $statistics = Statistic::where('active', true)->get();
        $customers = Customer::where('active', true)->with('services')->take(8)->get();

        return view('landingPage.home', compact('settings', 'logoPath', 'services', 'statistics', 'customers'));
    }

    public function about()
    {
        $settings = $this->getSettings();
        $logoPath = $this->getLogoPath();
        $statistics = Statistic::where('active', true)->get();

        return view('landingPage.about', compact('settings', 'logoPath', 'statistics'));
    }

    public function services()
    {
        $settings = $this->getSettings();
        $logoPath = $this->getLogoPath();
        $services = Service::where('active', true)->with('images')->get();

        return view('landingPage.services', compact('settings', 'logoPath', 'services'));
    }

    public function serviceDetail($locale, $id)
    {
        $settings = $this->getSettings();
        $logoPath = $this->getLogoPath();
        $service = Service::where('active', true)->with('images')->findOrFail($id);
        $otherServices = Service::where('active', true)->where('id', '!=', $id)->with('images')->take(3)->get();

        return view('landingPage.service-detail', compact('settings', 'logoPath', 'service', 'otherServices'));
    }

    public function customers()
    {
        $settings = $this->getSettings();
        $logoPath = $this->getLogoPath();
        $customers = Customer::where('active', true)->with('services')->get();

        return view('landingPage.customers', compact('settings', 'logoPath', 'customers'));
    }

    public function customerService()
    {
        $settings = $this->getSettings();
        $logoPath = $this->getLogoPath();
        $services = Service::where('active', true)->get();

        return view('landingPage.customer-service', compact('settings', 'logoPath', 'services'));
    }

    public function submitServiceRequest(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:200',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:50',
            'service_id' => 'nullable|exists:services,id',
            'message' => 'required|string|max:2000',
        ]);

        $service = null;
        if ($data['service_id']) {
            $service = Service::find($data['service_id']);
        }

        $companyEmail = Setting::where('para', 'email')->value('value') ?? 'info@twasol-tech.com';

        try {
            Mail::send([], [], function($message) use ($data, $service, $companyEmail) {
                $serviceName = $service
                    ? (app()->getLocale() == 'ar' ? $service->name_ar : $service->name_en)
                    : 'غير محدد / Not specified';

                $body = "طلب خدمة جديد من الموقع الإلكتروني / New Service Request from Website\n\n";
                $body .= "==============================================\n";
                $body .= "الاسم / Name: " . $data['full_name'] . "\n";
                $body .= "الهاتف / Phone: " . $data['phone'] . "\n";
                $body .= "البريد الإلكتروني / Email: " . ($data['email'] ?? 'غير مذكور') . "\n";
                $body .= "الخدمة المطلوبة / Requested Service: " . $serviceName . "\n";
                $body .= "الرسالة / Message:\n" . $data['message'] . "\n";
                $body .= "==============================================\n";
                $body .= "وقت الطلب / Request Time: " . now()->format('Y-m-d H:i:s') . "\n";

                $message->to($companyEmail)
                    ->subject('طلب خدمة جديد من موقع تواصل تكنولوجي / New Service Request - Twasol Tech')
                    ->text($body);
            });

            return redirect()->back()->with('success', app()->getLocale() == 'ar'
                ? 'تم إرسال طلبك بنجاح! سنتواصل معك قريباً.'
                : 'Your request has been submitted successfully! We will contact you soon.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', app()->getLocale() == 'ar'
                ? 'حدث خطأ أثناء إرسال الطلب. يرجى المحاولة مرة أخرى.'
                : 'An error occurred while submitting your request. Please try again.');
        }
    }

    public function contact()
    {
        $settings = $this->getSettings();
        $logoPath = $this->getLogoPath();

        return view('landingPage.contact', compact('settings', 'logoPath'));
    }

    public function sitemap()
    {
        $urls = [
            ['loc' => url('/ar'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => url('/en'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => url('/ar/about'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => url('/en/about'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => url('/ar/services'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => url('/en/services'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => url('/ar/customers'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => url('/en/customers'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => url('/ar/customer-service'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('/en/customer-service'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('/ar/contact'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('/en/contact'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
        ];

        return response()->view('sitemap', compact('urls'))
                         ->header('Content-Type', 'text/xml');
    }
}