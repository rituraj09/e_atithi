<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generateCaptcha()
    {
        // Generate random characters for the captcha
        $captchaText = $this->generateRandomString(6);

        // Save the captcha text in the session
        Session::put('captcha', $captchaText);

        // Generate the captcha image
        $captchaImage = $this->generateCaptchaImage($captchaText);

        // Base64 encode the image data
        $captchaImageBase64 = base64_encode($captchaImage);

        // Return the base64 encoded image data
        return response()->json(['image' => $captchaImageBase64, 'secret' => $captchaText]);

        // // Display the captcha image
        // return response()->stream(
        //     function () use ($captchaImage) {
        //         echo $captchaImage;
        //     },
        //     200,
        //     ['Content-Type' => 'image/png']
        // );
    }

    private function generateRandomString($length = 6)
    {
        $characters = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    private function generateCaptchaImage($text)
    {
        $image = imagecreate(120, 36);
        $background = imagecolorallocate($image, 155, 155, 200 );
        $textColor = imagecolorallocate($image, 0, 0, 0);

        imagestring($image, 5, 20, 10, $text, $textColor);

        ob_start();
        imagepng($image);
        $captchaImage = ob_get_clean();

        imagedestroy($image);

        return $captchaImage;
    }

    public function verifyCaptcha(Request $request) {
        $captcha = session('captcha');

        if ($request->captcha === $captcha) {
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'failed']);
        }
    }
}
