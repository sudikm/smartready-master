<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\AdminUser;
use App\ContactUs;
use App\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;


class AdminController extends Controller
{
    public $data = array(
        'home' => 'admin/dashboard',
        'user' => 'admin/listAdminUser',
        'shopping-cart' => 'admin/listProduct'
    );

    /**
     * Admin User login
     */
    public function login(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        } else {
            return view('admin.login', ['title' => 'Login']);
        }
    }

    /**
     * Verify user login
     */
    public function verifyLogin(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => 'required',
            'password' => 'required'
        );
        $messages = array(
            'email' => 'required',
            'password' => 'required'
        );
        $validation = Validator::make($input, $rules, $messages);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->withInput()->with('failure', 'That email/password does not match, please try again !!!.');
        }
    }

    /**
     *  Dashboard
     */
    public function dashboard(Request $request)
    {
        $adminuser = Auth::guard('admin')->user();
        $userList = User::OrderBy('created_at', 'desc')->get();
        return view('admin.dashboard', ['adminuser' => $adminuser, 'userList' => $userList, 'title' => "Admin Dashboard", 'page_title' => "Admin Dashboard",'linkData' => $this->data]);
    }

    /**
     * List Admin User
     */
    public function listAdminUser(Request $request)
    {
        $usersList = AdminUser::select('id','firstname','email','lastname','status')->orderBY('updated_at', 'desc')->paginate(5);
        $adminuser = Auth::guard('admin')->user();
        return view('admin.listAdminUser', ['adminuser' => $adminuser, 'users' => $usersList, 'title' => 'Admin Dashboard', 'page_title' => 'Admin Users', 'linkData' => $this->data]);
    }

    /**
     *  Open the add new admin user view
     */
    public function addAdminUser(Request $request)
    {
        $adminuser = Auth::guard('admin')->user();
        return view('admin.addAdminUser', ['adminuser' => $adminuser, 'title' => "Admin Dashboard", 'page_title' => 'Add Admin Users', 'linkData' => $this->data]);
    }

    /**
     *  Verify the new admin user data and save to database
     */
    public function saveAdminUser(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'firstname' => 'required',
            'lastname' => 'required | alpha',
            'email' => 'required | email | unique:admin_users',
            'password' => 'required',
            'confirmPassword' => 'required_if:password,password',
            'status' => 'required'
        );
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }
        $adminuser = Auth::guard('admin')->user();
        $newAdminUser = new AdminUser();
        $newAdminUser->firstname = $request->get('firstname');
        $newAdminUser->lastname = $request->get('lastname');
        $newAdminUser->email = $request->get('email');
        $newAdminUser->password = bcrypt($request->get('password'));
        $newAdminUser->status = $request->get('status');
        $newAdminUser->created_by = $adminuser->id;
        $newAdminUser->modified_by = $adminuser->id;
        $newAdminUser->save();
        return redirect('admin/listAdminUser')->with('status', 'New User added successfully');
    }

    /**
     *  Open the edit admin user view
     */
    public function editAdminUser(Request $request, $id)
    {
        $adminuser = Auth::guard('admin')->user();
        $userData = AdminUser::where('id', $id)->get();
        return view('admin.editAdminUser', ['adminuser' => $adminuser, 'userData' => $userData[0], 'title' => "Admin Dashboard", 'page_title' => 'Edit Admin Users', 'linkData' => $this->data]);
    }

    /**
     *  Edit admin user data
     */
    public function updateAdminUser(Request $request, $id)
    {
        $input = $request->all();
        $email = AdminUser::where('id', $id)->first()->email;
        $rules = array(
            'firstname' => 'required | alpha',
            'lastname' => 'required | alpha',
            'email' => 'required | unique:admin_users,email,' . $id,
            'confirmPassword' => 'required_if:password,password',
            'status' => 'required'
        );
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }
        $adminuser = Auth::guard('admin')->user();
        $editAdminUser = array(
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'status' => $request->get('status'),
            'created_by' => $adminuser->id,
            'modified_by' => $adminuser->id,
        );
        if (Input::has('password')) {
            $editAdminUser['password'] = bcrypt($request->get('password'));
        }
        AdminUser::where('id', $id)->update($editAdminUser);
        return redirect('admin/listAdminUser')->with('status', 'User data updated successfully');
    }

    /**
     *  Delete admin user data
     */
    public function deleteAdminUser(Request $request, $id)
    {
        AdminUser::where('id', $id)->delete();
        return redirect('admin/listAdminUser')->with('status', 'User deleted successfully');
    }

    /**
     * Logout user
     */
    public function logoutAdminUser()
    {
        $user = Auth::guard('admin')->user();
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
