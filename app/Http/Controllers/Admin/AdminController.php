<?php

namespace App\Http\Controllers\Admin;

use App\DTOs\Admin\AddSupport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\AddSupportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $users = User::all();

        return view('admin.dashboard', compact('users'));
    }

    public function showSupports(): View
    {
        $supports = User::where('role', 'support')->get();

        return view('admin.supports', compact('supports'));
    }

    public function addSupport(AddSupportService $service, User $user): RedirectResponse
    {
        $service->execute(new AddSupport($user->id));

        return redirect()->route('admin.dashboard');
    }

    public function addSupportForm(User $user): View
    {
        return view('admin.add', [
            'user' => $user,
        ]);
    }
}
