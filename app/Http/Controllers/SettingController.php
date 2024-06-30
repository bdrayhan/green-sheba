<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use App\Models\BasicSetting;
use App\Models\ContactInfo;
use App\Models\SMSSetting;
use App\Models\SocialSetting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SettingController extends Controller
{
    public function generalSetting()
    {
        $setting = BasicSetting::firstOrFail();
        return view('backend.setting.general', compact('setting'));
    }

    public function settingUpdate(Request $request,)
    {
        $data = array();
        $data['basic_company'] = $request->basic_company;
        $data['basic_url'] = $request->basic_url;
        $data['basic_title'] = $request->basic_title;
        $data['invoice_additional'] = $request->invoice_additional;
        // Logo Upload
        if ($request->hasFile('basic_logo')) {
            if ($request->old_basic_logo) {
                unlink($request->old_basic_logo);
            }
            $image = $request->file('basic_logo');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/setting/' . $image_name);
            $data['basic_logo'] = 'media/setting/' . $image_name;
        }
        // Footer Logo Upload
        if ($request->hasFile('basic_flogo')) {
            if ($request->old_basic_flogo) {
                unlink($request->old_basic_flogo);
            }
            $image = $request->file('basic_flogo');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/setting/' . $image_name);
            $data['basic_flogo'] = 'media/setting/' . $image_name;
        }
        // Favicon Upload
        if ($request->hasFile('basic_favicon')) {
            if ($request->old_basic_favicon) {
                unlink($request->old_basic_favicon);
            }
            $image = $request->file('basic_favicon');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('media/setting/' . $image_name);
            $data['basic_favicon'] = 'media/setting/' . $image_name;
        }
        $setting = BasicSetting::where('id', $request->id)->update($data);
        if ($setting) {
            $notification = array(
                'message' => 'Setting Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Setting Updated Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function socialSetting(): Factory|View|Application
    {
        $social = SocialSetting::firstOrFail();
        return view('backend.setting.social', compact('social'));
    }

    public function socialUpdate(Request $request): RedirectResponse
    {
        $data = array();
        $data['sm_facebook'] = $request->sm_facebook;
        $data['sm_twitter'] = $request->sm_twitter;
        $data['sm_linkedin'] = $request->sm_linkedin;
        $data['sm_youtube'] = $request->sm_youtube;
        $data['sm_pinterest'] = $request->sm_pinterest;
        $data['sm_instagram'] = $request->sm_instagram;
        $social = SocialSetting::where('id', $request->social_id)->update($data);

        if ($social) {
            $notification = array(
                'message' => 'Social Setting Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Social Setting Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function contactInfoSetting(): Factory|View|Application
    {
        $contactinfo = ContactInfo::firstOrFail();
        return view('backend.setting.contactinfo', compact('contactinfo'));
    }

    public function contactInfoUpdate(Request $request): RedirectResponse
    {
        $data = array();
        $data['ci_phone1'] = $request->ci_phone1;
        $data['ci_phone2'] = $request->ci_phone2;
        $data['ci_email1'] = $request->ci_email1;
        $data['ci_email2'] = $request->ci_email2;
        $data['ci_address1'] = $request->ci_address1;
        $data['ci_working_info'] = $request->ci_working_info;
        $social = ContactInfo::where('id', $request->id)->update($data);

        if ($social) {
            $notification = array(
                'message' => 'Contact Setting Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Contact Setting Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function analyticSetting()
    {
        $analytic = Analytics::firstOrFail();
        return view('backend.setting.analytic', compact('analytic'));
    }

    public function analyticUpdate(Request $request): RedirectResponse
    {
        $analytic = Analytics::where('id', 1)->update(
            [
                'google_analytic' => request()->google_analytic,
                'facebook_pixel' => request()->facebook_pixel,
                'bing_analytic' => request()->bing_analytic,
                'google_site_verification' => request()->google_site_verification,
                'facebook_site_verification' => request()->facebook_site_verification,
                'bing_site_verification' => request()->bing_site_verification,
                'custom_header_script' => request()->custom_header_script,
                'custom_footer_script' => request()->custom_footer_script,
            ]
        );
        if ($analytic) {
            $notification = array(
                'message' => 'Website Analytic Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Website Analytic Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function thanksNote()
    {
        $notes = BasicSetting::where('id', 1)->firstOrFail();
        return view('backend.setting.thanksNote', compact('notes'));
    }

    public function thanksNoteUpdate(Request $request): RedirectResponse
    {
        $notes = BasicSetting::where('id', 1)->update(
            [
                'thanks_notes' => $request->thanks_note,
            ]
        );
        if ($notes) {
            $notification = array(
                'message' => 'Thanks Note Updated!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Thanks Note Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function smsSetting(): Factory|View|Application
    {
        $sms = SMSSetting::firstOrFail();

        return view('backend.setting.sms_setting', compact('sms'));
    }

    public function smsUpdate(Request $request): RedirectResponse
    {

        $sms = SMSSetting::firstOrFail();
        $sms->sms_api_key = $request->sms_api_key;
        $sms->sms_sender_id = $request->sms_sender_id;
        $sms->sms_type = $request->sms_type;
        $sms->sms_status = $request->sms_status;
        $sms->update();

        if ($sms) {
            $notification = array(
                'message' => 'Setting Update',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Setting Update Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }
}
