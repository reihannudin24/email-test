<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSendController extends Controller
{

    public function sendBasicEmail () {

        $data = [
            'subject' => 'Email Basic Test with Template',
            'title' => 'Welcome to Our Application',
            'content' => 'This is a test email sent using a Blade template and Mailtrap.',
        ];

        Mail::send("emails.test_email" , $data , function ($message) use ($data){
            $message->to('reihannudin@gmail.com')->subject($data['subject']);
        });

        return response()->json(['message' => 'Email with template sent successfully!']);

    }

    public function scheduleSendEmail()
    {
        $datetimeNow = Carbon::now('UTC'); // Waktu sekarang di UTC
        $jakartaTime = $datetimeNow->setTimezone('Asia/Jakarta'); // Konversi ke zona waktu Jakarta
        $jakartaDate = $jakartaTime->toDateString(); // Hanya ambil bagian tanggal (YYYY-MM-DD)

        $scheduleDate = "2024-11-24";

        $jakartaDateCarbon = Carbon::parse($jakartaDate);
        $scheduleDateCarbon = Carbon::parse($scheduleDate);

        // Hitung selisih hari dengan logika tambahan jika tanggal sudah lewat
        $daysDifference = $jakartaDateCarbon->gt($scheduleDateCarbon)
            ? 0
            : $scheduleDateCarbon->diffInDays($jakartaDateCarbon);

        // Debugging: Periksa selisih hari
        if ($daysDifference === 0) {
            return response()->json(['message' => 'Tanggal sekarang sudah melewati tanggal jatuh tempo.']);
        }

        // Kirim email jika selisih hari <= 7
        if ($daysDifference <= 7) {
            $dates = []; // Array untuk menyimpan daftar tanggal

            // Loop dari tanggal sekarang hingga tanggal jatuh tempo
            while ($jakartaDateCarbon->lte($scheduleDateCarbon)) {
                $dates[] = $jakartaDateCarbon->toDateString(); // Tambahkan tanggal ke array
                $jakartaDateCarbon->addDay(); // Tambahkan satu hari
            }

            // Periksa apakah hari ini adalah salah satu tanggal dalam daftar
            if (in_array($jakartaDate, $dates)) {
                $data = [
                    'subject' => 'Email Schedule Jatuh Tempo Test with Template',
                    'title' => 'Welcome to Our Application',
                    'content' => 'This is a test email sent using a Blade template and Mailtrap.',
                ];

                Mail::send("emails.test_email", $data, function ($message) use ($data) {
                    $message->to('shannon@gmail.com')->subject($data['subject']);
                });

                return response()->json(['message' => 'Email with template sent successfully!']);
            }

            // Debugging: Tampilkan daftar tanggal
            return response()->json(['dates' => $dates]);
        }

        return response()->json(['message' => 'Tidak ada email yang dikirimkan.']);
    }


    public function blastMarketingEmails (){

        $recipients = [
            'recipient1@example.com',
            'recipient2@example.com',
            'recipient3@example.com',
        ];

        foreach ($recipients as $email) {
            $data = [
                'subject' => 'Marketing Blast with Template',
                'title' => 'Special Offer!',
                'content' => 'Check out our latest deals and discounts just for you.',
            ];

            Mail::send('emails.test_email', $data, function ($message) use ($data, $email) {
                $message->to($email)
                    ->subject($data['subject']);
            });
        }

        return response()->json(['message' => 'Marketing emails with template sent successfully!']);

    }

}

