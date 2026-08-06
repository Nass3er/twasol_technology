<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersManagementtController extends Controller
    {
        public $route = 'users-management';
        public $view = 'admin-panel.users-management';
    
        public function index()
        {
            try {
                $currentUser = User::findOrFail(Auth::id());
                // Get users with lower or equal privilege level
                $users = User::where('priv', '>=', $currentUser->priv)
                            ->orderBy('created_at', 'desc')
                            ->get();
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
            return view("$this->view.index", compact('users'));
        }
    
        public function show($locale, $id)
        {
            try {
                $user = User::findOrFail($id);
                return view("$this->view.show", compact('user'));
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    
        public function create()
        {
            try {
                $currentUser = User::findOrFail(Auth::id());
                // Pass available privilege levels (only those the current user can assign)
                $privilegeLevels = range(1, $currentUser->priv);
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
            return view("$this->view.create", compact('privilegeLevels'));
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                // 'priv' => 'required|integer|min:1',
                // 'active' => 'boolean',
            ], [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.unique' => 'This email is already taken.',
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least 8 characters.',
                'password.confirmed' => 'The password confirmation does not match.',
                // 'priv.required' => 'The privilege level is required.',
            ]);
    
            try {
                DB::beginTransaction();
    
                $currentUser = User::findOrFail(Auth::id());
                
                // Prevent creating users with higher privilege than current user
                if ($request->priv > $currentUser->priv) {
                    throw new \Exception('You cannot create users with higher privilege level than your own.');
                }
    
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                // $user->priv = $request->priv;
                // $user->active = $request->has('active') ? true : false;
                $user->priv = 1;
                $user->active = true;
                $user->save();
    
                DB::commit();
    
                return redirect()->route("$this->route.index", app()->getLocale())
                    ->with(['success' => 'User created successfully.']);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
            }
        }
    
        /**
         * Show the form for editing the specified resource.
         */
        public function edit($locale, int $id)
        {
            try {
                $user = User::findOrFail($id);
                $currentUser = User::findOrFail(Auth::id());
                
                // Prevent editing users with higher privilege
                if ($user->priv > $currentUser->priv) {
                    throw new \Exception('You cannot edit users with higher privilege level than your own.');
                }
    
                $privilegeLevels = range(1, $currentUser->priv);
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
            return view("$this->view.edit", compact('user', 'privilegeLevels'));
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, $locale, int $id)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
                'priv' => 'required|integer|min:1',
                'active' => 'boolean',
            ], [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.unique' => 'This email is already taken.',
                'password.min' => 'The password must be at least 8 characters.',
                'password.confirmed' => 'The password confirmation does not match.',
                'priv.required' => 'The privilege level is required.',
            ]);
    
            try {
                DB::beginTransaction();
    
                $user = User::findOrFail($id);
                $currentUser = User::findOrFail(Auth::id());
    
                // Prevent editing users with higher privilege
                if ($user->priv > $currentUser->priv) {
                    throw new \Exception('You cannot edit users with higher privilege level than your own.');
                }
    
                // Prevent assigning higher privilege than current user
                if ($request->priv > $currentUser->priv) {
                    throw new \Exception('You cannot assign privilege level higher than your own.');
                }
    
                $user->name = $request->name;
                $user->email = $request->email;
                
                // Only update password if provided
                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }
                
                $user->priv = $request->priv;
                $user->active = $request->has('active') ? true : false;
                $user->save();
    
                DB::commit();
    
                return redirect()->route("$this->route.index", app()->getLocale())
                    ->with(['success' => 'User updated successfully.']);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
            }
        }
    
        /**
         * Remove the specified resource from storage.
         */
        public function destroy($locale, string $id)
        {
            try {
                DB::beginTransaction();
    
                $user = User::findOrFail($id);
                $currentUser = User::findOrFail(Auth::id());
    
                // Prevent deleting users with higher privilege
                if ($user->priv < $currentUser->priv) {
                    throw new \Exception('You cannot delete users with higher privilege level than your own.');
                }
    
                // Prevent deleting yourself
                if ($user->id === $currentUser->id) {
                    throw new \Exception('You cannot delete your own account.');
                }
    
                $user->delete();
    
                DB::commit();
    
                return redirect()->route("$this->route.index", app()->getLocale())
                    ->with(['success' => __('adminlte::adminlte.succDelete')]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    
        /**
         * Toggle user active status.
         */
        public function toggleActive($locale, string $id)
        {
            try {
                DB::beginTransaction();
    
                $user = User::findOrFail($id);
                $currentUser = User::findOrFail(Auth::id());
    
                // Prevent deactivating users with higher privilege
                if ($user->priv < $currentUser->priv) {
                    throw new \Exception('You cannot modify users with higher privilege level than your own.');
                }
    
                // Prevent deactivating yourself
                if ($user->id === $currentUser->id) {
                    throw new \Exception('You cannot deactivate your own account.');
                }
                
                $user->active = !$user->active;

                if ($user->active === false) {
                    DB::table('sessions')->where('user_id', $user->id)->delete();
                }
                $user->save();
                DB::commit();
    
                $status = $user->active ? __('adminlte::adminlte.Activation') : __('adminlte::adminlte.DeActivation');
                return redirect()->route("$this->route.index", app()->getLocale())
                    ->with(['success' => "$status ".__('adminlte::adminlte.DoneSucc')]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
        public function changePasswordIndex()
        {
            return view("admin-panel.general.changePassword.index");

        }
        public function changePassword(Request $request, $locale)
        {
            $request->validate([
                'password' => 'nullable|string|min:8|confirmed',
            ], [
                'password.min' => 'The password must be at least 8 characters.',
                'password.confirmed' => 'The password confirmation does not match.',
            ]);
    
            try {
                
                $user = User::findOrFail(Auth::id());
                if (!Hash::check($request->old_password, $user->password)) {
                    throw new \Exception(__('adminlte::adminlte.passNotMatching'));
                }

                DB::beginTransaction();
                
                // Only update password if provided
                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }
                
                $user->save();
    
                DB::commit();
    
                return redirect()->route("change-password.index", app()->getLocale())
                    ->with(['success' => __('adminlte::adminlte.DoneSucc')]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
            }
        }
    }
    