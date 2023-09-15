<?php

namespace App\Http\Controllers\Auth;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\AdminToken;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    // protected $admin;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('guest');
        // $this->admin = $
        
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User|\App\Models\Student|\App\Models\Admin
     */
    
     public function create(Request $request)
{
    
    // Validate the registration data
    $this->validator($request->all())->validate();
    // dd($request['profile']);

    if ($request['profile'] === 'Student') {
        return $this->createStudent($request);
    } elseif ($request['profile'] === 'Admin') {
        return $this->createAdmin($request);
    }
    
    return redirect('/register')->withErrors(['error' => 'Provide a valid token or register as a student']);
}



    protected function createStudent($data)
    {
        
        $faculty_id = json_decode($data['department'])->faculty_id;
        
        
        $department_id = json_decode($data['department'])->id;
        $count = Student::where('department_id', $department_id)->count();
        
        if(strlen((string)$count) < 2){
            
            $count += 1;
            $count = '0' . $count;
        }else{
            $count += 1;
        }

        if(strlen((string)$department_id) < 2){
            $department_id = '0' . $department_id;
        }

        if(strlen((string)$faculty_id) < 2) {
            $faculty_id = '0' . $faculty_id;
        }
        
        
        $matricNumber = substr(date('Ymd'), 2, 2) . $department_id . $faculty_id . $count;
        

        
            $newUser = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $newStudent = Student::create([
                'matric_number' => $matricNumber,
                'department_id' => $department_id,
                'faculty_id' => $faculty_id,
                'name' => $data['name'],
                'user_id' => $newUser->id,
                'level_id' => 30,
            ]);

            $newProfile = Profile::create([
                'user_id' => $newUser->id,
                'profileable_id' => $newStudent->id,
                'profileable_type' => 'Student',
            ]);
    

            
            return redirect('/')->with('success', $data['profile']. ' registered successfully. You can login now');
    }


    protected function createAdmin($data)
    {
        dd($data);
        
        $tokenExists = AdminToken::where('admin_token', $data['admin_token'])->exists();
        if (!$tokenExists) {
            return redirect('/register')->withErrors(['error' => 'Provide a valid token or register as a student']);
        }

        $adminUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $admin = Admin::create([
            'user_id' => $adminUser->id,
        ]);

        $adminProfile = Profile::create([
            'user_id' => $adminUser->id,
            'profileable_id' => $admin->id,
            'profileable_type' => 'Admin',
        ]);

        
        return redirect('/')->with('success', $data['profile']. ' registered successfully. You can loging now');
    }
}
