<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Interfaces\DashboardServiceInterface;
use App\Interfaces\ExcelServiceInterface;
use App\Models\Complaint\Pengaduan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AccountController extends Controller
{
    public function __construct(private DashboardServiceInterface $dashboardService, private ExcelServiceInterface $excelService)
    {
    }

    public function excel(Request $request)
    {
        try {
            $pengaduans = $request->user()->getRelatedPengaduans()->filter(fn ($pengaduan) => $pengaduan->status != Pengaduan::STATUS_REJECTED);
            $filename = "Laporan Pengaduan BAPPEBTI " . Carbon::now()->isoFormat('D MMMM Y hh:mm:ss');
            $Excel_writer = new Xls($this->excelService->getPengaduanExcel($pengaduans));
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
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
