<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/chatbot', function (Request $request) {
    $message = $request->input('message');

    // Logika respons chatbot (contoh sederhana)
    $responses = [
        'halo' => 'Halo! Ada yang bisa saya bantu?',
        'harga' => 'Harga kamar mulai dari Rp1.500.000 per bulan.',
        'lokasi' => 'Kami berlokasi di Jalan Kost Indah No. 123.',
    ];

    $response = $responses[strtolower($message)] ?? 'Maaf, saya tidak mengerti pertanyaan Anda.';

    return response()->json(['response' => $response]);
});