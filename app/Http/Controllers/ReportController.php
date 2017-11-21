<?php

namespace App\Http\Controllers;

use App\Partner;
use App\SocialService;
use App\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $user = auth()->user();
        if ($user->isAdmin()) {
            if (isset($request->category)) {

                $category = $request->category;

                $filters = $request->request->all();

                switch ($category) {
                    case 'student':
                        $query = $this->filterStudent($filters);

                        if (count($query) > 0) {
                            return view('pages.admin.reports')->with(['results' => $query, 'category' => $category]);
                        } else {
                            return redirect()->back()->with(['fail' => 'No se ha encontrado ningún registro con los filtros seleccionados.']);
                        }

                        break;
                    case 'partner':
                        $query = $this->filterPartner($filters);

                        if (count($query) > 0) {
                            return view('pages.admin.reports')->with(['results' => $query, 'category' => $category]);
                        } else {
                            return redirect()->back()->with(['fail' => 'No se ha encontrado ningún registro con los filtros seleccionados.']);
                        }
                        break;
                    case 'social_service':
                        $query = $this->filterSocialService($filters);

                        if (count($query) > 0) {
                            return view('pages.admin.reports')->with(['results' => $query, 'category' => $category]);
                        } else {
                            return redirect()->back()->with(['fail' => 'No se ha encontrado ningún registro con los filtros seleccionados.']);
                        }
                        break;
                }
            } else {
                return view('pages.admin.reports');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    private function filterStudent($filters) {
        $query = Student::all();

        if (isset($filters['major'])) {
            $query = $query->where('major', $filters['major']);
        }

        if (isset($filters['totalCertifiedHoursSSC'])) {
            $query = $query->where('totalCertifiedHoursSSC', $filters['conditionTotalCertifiedHoursSSC'], $filters['totalCertifiedHoursSSC']);
        }

        if (isset($filters['totalRegisteredHoursSSC'])) {
            $query = $query->where('totalRegisteredHoursSSC', $filters['conditionTotalRegisteredHoursSSC'], $filters['totalRegisteredHoursSSC']);
        }

        if (isset($filters['totalCertifiedHoursSSP'])) {
            $query = $query->where('totalCertifiedHoursSSP', $filters['conditionTotalCertifiedHoursSSP'], $filters['totalCertifiedHoursSSP']);
        }

        if (isset($filters['totalRegisteredHoursSSP'])) {
            $query = $query->where('totalRegisteredHoursSSP', $filters['conditionTotalRegisteredHoursSSP'], $filters['totalRegisteredHoursSSP']);
        }

        if (isset($filters['totalCertifiedHoursSS'])) {
            $query = $query->where('totalCertifiedHoursSS', $filters['conditionTotalCertifiedHoursSS'], $filters['totalCertifiedHoursSS']);
        }

        if (isset($filters['campus'])) {
            $query = $query->where('campus', $filters['campus']);
        }

        if (isset($filters['recCourseCertified'])) {
            $query = $query->where('recCourseCertified', $filters['recCourseCertified']);
        }

        if (isset($filters['inductionCourseCertified'])) {
            $query = $query->where('inductionCourseCertified', $filters['inductionCourseCertified']);
        }

        return $query;
    }

    private function filterPartner($filters) {
        $query = Partner::all();

        if (isset($filters['defaultPasswordChanged'])) {
            $query = $query->where('defaultPasswordChanged', $filters['defaultPasswordChanged']);
        }

        return $query;
    }

    private function filterSocialService($filters) {
        $query = SocialService::all();

        if (isset($filter['partner_id'])) {
            $query = $query->where('partner_id', $filters['partner_id']);
        }

        if (isset($filter['totalHours'])) {
            $query = $query->where('totalHours', $filters['conditionTotalHours'], $filters['totalHours']);
        }

        if (isset($filter['managerName'])) {
            $query = $query->where('managerName', 'LIKE', '%'.$filters['managerName'].'%');
        }

        if (isset($filter['capability'])) {
            $query = $query->where('capability', $filters['conditionCapability'], $filters['capability']);
        }

        if (isset($filter['currentCapability'])) {
            $query = $query->where('currentCapability', $filters['conditionCurrentCapability'], $filters['currentCapability']);
        }

        if (isset($filter['startDate'])) {
            $query = $query->where('startDate', '>=', $filters['startDate']);
        }

        if (isset($filter['endDate'])) {
            $query = $query->where('endDate', '<=', $filters['endDate']);
        }

        if (isset($filter['type'])) {
            $query = $query->where('type', $filters['type']);
        }

        if (isset($filter['period'])) {
            $period_id = $filters['year'].$filters['period'];

            $query = $query->where('period', '>=', $period_id);
        }

        if (isset($filter['social_cause'])) {
            $query = $query->where('social_cause', $filters['social_cause']);
        }

        if (isset($filter['campus'])) {
            $query = $query->where('campus', $filters['campus']);
        }

        return $query;
    }
}
