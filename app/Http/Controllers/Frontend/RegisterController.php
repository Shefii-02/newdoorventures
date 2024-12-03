<?php

namespace App\Http\Controllers\Frontend;

use Botble\ACL\Traits\RegistersUsers;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\EmailHandler;
use App\Http\Controllers\Frontend\BaseController;
use Botble\Captcha\Facades\Captcha;
use Botble\RealEstate\Facades\RealEstateHelper;
use Botble\RealEstate\Forms\Fronts\Auth\RegisterForm;
use Botble\RealEstate\Models\Account;
use Botble\Payment\Models\Payment;
use Botble\RealEstate\Models\Package;
use Botble\RealEstate\Models\Transaction;
use Botble\RealEstate\Notifications\ConfirmEmailNotification;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Botble\Payment\Enums\PaymentStatusEnum;

class RegisterController extends BaseController
{
    use RegistersUsers;

    protected string $redirectTo = '/';

    public function __construct()
    {
        $this->redirectTo = route('public.account.dashboard');
    }

    public function showRegistrationForm()
    {
        if (! RealEstateHelper::isRegisterEnabled()) {
            abort(404);
        }

        SeoHelper::setTitle(__('Register'));

        return Theme::scope(
            'real-estate.account.auth.register',
            ['form' => RegisterForm::create()],
            'plugins/real-estate::themes.auth.register'
        )->render();
    }

    public function confirm(int|string $id, Request $request)
    {
        if (! RealEstateHelper::isRegisterEnabled()) {
            abort(404);
        }

        if (! URL::hasValidSignature($request)) {
            abort(404);
        }

        $account = Account::query()->findOrFail($id);

        $account->confirmed_at = Carbon::now();
        $account->save();

        $this->guard()->login($account);

        return $this
            ->httpResponse()
            ->setNextUrl(route('public.account.dashboard'))
            ->setMessage(__('You successfully confirmed your email address.'));
    }

    protected function guard()
    {
        return auth('account');
    }

    public function resendConfirmation(Request $request)
    {
        if (! RealEstateHelper::isRegisterEnabled()) {
            abort(404);
        }

        $account = Account::query()->where('email', $request->input('email'))->first();

        if (! $account) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(__('Cannot find this account!'));
        }

        $this->sendConfirmationToUser($account);

        return $this
            ->httpResponse()
            ->setMessage(__('We sent you another confirmation email. You should receive it shortly.'));
    }

    protected function sendConfirmationToUser(Account $account)
    {
        $account->notify(app(ConfirmEmailNotification::class));
    }

    public function register(Request $request)
    {
        if (! RealEstateHelper::isRegisterEnabled()) {
            abort(404);
        }

        $this->validator($request->input())->validate();

        event(new Registered($account = $this->create($request->input())));

        EmailHandler::setModule(REAL_ESTATE_MODULE_SCREEN_NAME)
            ->setVariableValues([
                'account_name' => $account->name,
                'account_email' => $account->email,
            ])
            ->sendUsingTemplate('account-registered');

        if (setting('verify_account_email', false)) {
            $this->sendConfirmationToUser($account);

            $this->registered($request, $account);

            return $this
                ->httpResponse()
                ->setNextUrl($this->redirectPath())
                ->setMessage(__('Please confirm your email address.'));
        }

        // $account->confirmed_at = Carbon::now();

        $account->is_public_profile = false;

        $account->save();
        
        
        /////additional code///
        // $payment = Payment::query()->first();
        // $package = Package::query()->first();
        // if ($package) {
        //     if (($payment && $payment->status == PaymentStatusEnum::COMPLETED)) {
        //         $account->credits += $package->number_of_listings;
        //         $account->save();
    
        //         $account->packages()->attach($package);
        //     }

        //         Transaction::query()->create([
        //             'user_id' => 0,
        //             'account_id' => auth('account')->id(),
        //             'credits' => $package->number_of_listings,
        //             'payment_id' => $payment ? $payment->id : null,
        //         ]);

        //     if (! $package->price) {
        //         EmailHandler::setModule(REAL_ESTATE_MODULE_SCREEN_NAME)
        //             ->setVariableValues([
        //                 'account_name' => $account->name,
        //                 'account_email' => $account->email,
        //             ])
        //             ->sendUsingTemplate('free-credit-claimed');
        //     }
        // }
        
        ////end additional code

        $this->guard()->login($account);

        return $this
            ->httpResponse()
            ->setNextUrl($this->redirectPath())->setMessage(__('Registered successfully!'));
    }

    protected function validator(array $data)
    {
        $rules = [
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'username' => 'required|max:60|min:2|unique:re_accounts,username',
            'email' => 'required|email|max:255|unique:re_accounts',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|' . BaseHelper::getPhoneValidationRule(),
        ];

        if (
            is_plugin_active('captcha') &&
            setting('enable_captcha') &&
            setting('real_estate_enable_recaptcha_in_register_page', 0)
        ) {
            $rules += Captcha::rules();
        }

        return Validator::make($data, $rules, [], Captcha::attributes());
    }

    protected function create(array $data)
    {
        return Account::query()->forceCreate([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getVerify()
    {
        if (! RealEstateHelper::isRegisterEnabled()) {
            abort(404);
        }

        return view('plugins/real-estate::account.auth.verify');
    }
}
