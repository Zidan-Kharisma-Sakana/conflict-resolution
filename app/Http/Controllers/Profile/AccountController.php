<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Interfaces\DashboardServiceInterface;
use App\Models\Complaint\Pengaduan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(private DashboardServiceInterface $dashboardService)
    {
    }

    public function dashboard(Request $request)
    {
        $pengaduans = $request->user()->getRelatedPengaduans();
        return view('account.dashboard', [
            'user' => $request->user(),
            'data' => [
                'pengaduanCount' => $this->dashboardService->getPengaduanStatsData($pengaduans),
                'yearly' => $this->dashboardService->getYearlyPengaduanData($pengaduans),
                'active' => $this->dashboardService->getActivePengaduanData($pengaduans)
            ]
        ]);
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        return view('account.index', [
            'user' => $request->user(),
            'shownUsers' => User::whereNotNull('email_verified_at')->orderByDesc('created_at')->get()
        ]);
    }

    public function show(Request $request, User $user)
    {
        $this->authorize('viewAny', User::class);
        $pengaduans = $user->getRelatedPengaduans();
        return view('account.show', [
            'user' => $user,
            'data' => [
                'pengaduanCount' => $this->dashboardService->getPengaduanStatsData($pengaduans),
                'yearly' => $this->dashboardService->getYearlyPengaduanData($pengaduans),
                'active' => $this->dashboardService->getActivePengaduanData($pengaduans)
            ]
        ]);
    }

    public function delete(Request $request)
    {
        $this->authorize('delete', User::class);

    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('account.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('account.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
