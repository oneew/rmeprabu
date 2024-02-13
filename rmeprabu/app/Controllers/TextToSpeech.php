<?php

namespace App\Controllers;


class TextToSpeech extends BaseController
{
    public function index()
    {
        echo view('text_to_speech/index');
    }

    public function speech()
    {
        echo view('text_to_speech/speech_to_text');
    }
}
