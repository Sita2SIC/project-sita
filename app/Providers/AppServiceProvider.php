<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengubah isi email reset password bawaan Laravel menjadi bahasa Indonesia
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]);

            return (new MailMessage)
                ->subject('Reset Password Noona Salon')
                ->greeting('Halo, ' . $notifiable->nama_lengkap . '!')
                ->line('Kami menerima permintaan untuk mengatur ulang password akun Noona Salon Anda.')
                ->action('Atur Ulang Password', $url)
                ->line('Link ini berlaku selama 60 menit.')
                ->line('Jika Anda tidak meminta reset password, abaikan saja email ini.')
                ->salutation('Salam, Noona Salon by Cortis');
        });
    }
}
