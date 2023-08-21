<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;

class GeneralInfoController extends Controller
{
    public function index()
    {
        $data['setting'] = Setting::get()->pluck('value', 'key');

        return view('general-info',$data);
    }
    public function store(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $index => $datum) {
            if (is_array($datum) && sizeof($datum) > 0) {
                foreach ($datum as $index2 => $item) {
                    Setting::updateOrCreate(
                        ['key' => $index.'.'.$index2],
                        ['value' => $item]
                    );
                }
            }else{
                Setting::updateOrCreate(
                    ['key' => $index],
                    ['value' => $datum]
                );
            }
        }
        return redirect()
            ->route('general_info')
            ->with('success', t('Successfully Updated'));
    }
    public function accountSettings()
    {
        $data['admin'] = Auth()->user();
        return view('admin.account-setting',$data);
    }
    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = Auth('admin')->user()->update($request->except(['_token']));
        if ($user) {
            $message = "Account updated successfully.";
        } else {
            $message = "Error while saving. Please try again.";
        }
        return redirect()
            ->route('account_settings')
            ->with('success', $message);
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', Password::min(8)->numbers(),'confirmed','different:old_password'],
        ]);
        $user = Auth('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $message = t('You have entered wrong password');
        } else {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            $message = "Account updated successfully.";
        }
        return redirect()
            ->route('account_settings')
            ->with('success', $message);
    }

}
