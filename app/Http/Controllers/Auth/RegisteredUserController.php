<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use DateTime;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 'gander'=> 'required|in:male,female'
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:255', 'digits:10'],
            'dob' => ['required', 'string', 'date_format:Y-m-d', 'before:5 years'],
            'gender' => ['required', 'in:Male,Female'],
            'class' => ['required', 'string', 'max:255'],
            'father' => ['required', 'string', 'max:255'],
            'mother' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $age = $this->getAge($request->dob);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'age' => $age,
            'gender' => $request->gender,
            'class' => $request->class,
            'father' => $request->father,
            'mother' => $request->mother,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(RouteServiceProvider::RegisterMsg);
        // return view('auth.register-msg');
    }

    public function getAge($date)
    {
        $d1 = new DateTime(date("Y-m-d"));
        $d2 = new DateTime($date);
        $diff = $d2->diff($d1);
        return $diff->y;
    }
}
