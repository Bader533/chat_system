<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\RecaptchaEnterprise\V1\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;

class ReCaptchaController extends Controller
{
    public function verify(Request $request)
    {
        $recaptchaKey = 'YOUR_RECAPTCHA_SITE_KEY'; // استبدل هذا بالمفتاح الخاص بموقعك
        $token = $request->input('g-recaptcha-response'); // الرمز الذي حصلت عليه من العميل
        $project = 'YOUR_PROJECT_ID'; // استبدل هذا بمعرف مشروع جوجل السحابي الخاص بك
        $action = 'YOUR_RECAPTCHA_ACTION'; // استبدل هذا بالإجراء المتوقع

        $client = new RecaptchaEnterpriseServiceClient();
        $projectName = $client->projectName($project);

        $event = (new Event())
            ->setSiteKey($recaptchaKey)
            ->setToken($token);

        $assessment = (new Assessment())
            ->setEvent($event);

        try {
            $response = $client->createAssessment($projectName, $assessment);

            if ($response->getTokenProperties()->getValid() == false) {
                return response()->json([
                    'error' => 'الرمز غير صالح بسبب: ' . InvalidReason::name($response->getTokenProperties()->getInvalidReason())
                ], 400);
            }

            if ($response->getTokenProperties()->getAction() == $action) {
                return response()->json([
                    'score' => $response->getRiskAnalysis()->getScore()
                ]);
            } else {
                return response()->json([
                    'error' => 'الإجراء في reCAPTCHA لا يتطابق مع الإجراء المتوقع'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'فشل التحقق مع الخطأ: ' . $e->getMessage()
            ], 500);
        }
    }
}
