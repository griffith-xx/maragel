<?php

namespace App\Http\Controllers;

use App\Models\Cosmic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        $title = 'อ่านมังงะ มันฮวาออนไลน์ อัปเดตใหม่ทุกวัน';
        $description = "อ่านมังงะและมันฮวาออนไลน์ หลากหลายเรื่องดังครบทุกแนว ไม่พลาดตอนใหม่ สนุกไปกับโลกการ์ตูนที่คุณชื่นชอบ อัปเดตทุกวัน อ่านง่าย สะดวกทุกที่ทุกเวลา";
        $keywords = "อ่านมังงะ, อ่านมันฮวา";
        $image_url = "/images/wallpaper.jpeg";

        $cosmics = Cosmic::orderBy('id', 'ASC')->paginate(12);

        return Inertia::render('Welcome', [
            'cosmics' => $cosmics,
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'image_url' => $image_url,
        ]);
    }
}
