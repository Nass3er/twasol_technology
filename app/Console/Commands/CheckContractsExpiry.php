<?php

namespace App\Console\Commands;

use App\Models\MaintenanceContract;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckContractsExpiry extends Command
{
    protected $signature = 'app:check-contracts-expiry';
    protected $description = 'Check maintenance contracts expiring within 30 days and send email notification.';

    public function handle()
    {
        $companyEmail = Setting::where('para', 'email')->value('value') ?? 'info@twasol-tech.com';
        $companyNameAr = Setting::where('para', 'company_name_ar')->value('value') ?? 'تواصل تكنولوجي';

        $expiringContracts = MaintenanceContract::where('active', true)
            ->whereDate('end_date', '>=', now()->toDateString())
            ->whereDate('end_date', '<=', now()->addDays(30)->toDateString())
            ->whereNull('notified_at')
            ->with('customer')
            ->get();

        if ($expiringContracts->isEmpty()) {
            $this->info('No expiring contracts found needing notification.');
            return 0;
        }

        $this->info("Found {$expiringContracts->count()} expiring contract(s). Sending notifications...");

        foreach ($expiringContracts as $contract) {
            $daysLeft = (int) now()->diffInDays($contract->end_date, false);
            $customerName = $contract->customer->name_ar;
            $endDate = $contract->end_date->format('Y-m-d');

            try {
                Mail::send([], [], function ($message) use ($companyEmail, $companyNameAr, $customerName, $endDate, $daysLeft, $contract) {
                    $body = "تنبيه: عقد صيانة على وشك الانتهاء\n\n";
                    $body .= "===================================\n";
                    $body .= "العميل: {$customerName}\n";
                    $body .= "تاريخ انتهاء العقد: {$endDate}\n";
                    $body .= "الأيام المتبقية: {$daysLeft} يوم\n\n";
                    if ($contract->description_ar) {
                        $body .= "تفاصيل العقد:\n{$contract->description_ar}\n\n";
                    }
                    $body .= "يرجى التواصل مع العميل لتجديد العقد قبل انتهائه.\n";
                    $body .= "===================================\n";
                    $body .= "تم الإرسال تلقائياً من نظام {$companyNameAr}\n";
                    $body .= "التاريخ: " . now()->format('Y-m-d H:i:s') . "\n";

                    $message->to($companyEmail)
                        ->subject("⚠️ تنبيه: عقد صيانة العميل ({$customerName}) ينتهي خلال {$daysLeft} يوم")
                        ->text($body);
                });

                // Mark as notified so we don't send again
                $contract->update(['notified_at' => now()]);
                $this->info("  ✓ Notification sent for: {$customerName}");

            } catch (\Exception $e) {
                $this->error("  ✗ Failed to send notification for {$customerName}: " . $e->getMessage());
            }
        }

        $this->info("Done.");
        return 0;
    }
}