<?php

namespace App\Http\Controllers\Admin;

use App\Models\Consult;
use App\Models\Contact;
use App\Models\GoogleAnalyticsTopDevice;
use App\Models\GoogleAnalyticsTopLandingPage;
use App\Models\GoogleAnalyticsTopReferrer;
use App\Models\GoogleAnalyticsVisitor;
use Vormkracht10\Analytics\Facades\Analytics;
use Vormkracht10\Analytics\Period;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Project;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
  
        $totalPropertyLeads = Consult::count();
        $totalProperties    = Property::count();
        $totalProjects      = Project::count();
        $totalAccounts      = Account::count();

        // Google Analytics
        $totalViews  = Analytics::sessions(Period::months(100));
        $last30DaysVisitors = GoogleAnalyticsVisitor::orderby('date', 'asc')->get();
        $topDevices = GoogleAnalyticsTopDevice::all();
        $topReferrers = GoogleAnalyticsTopReferrer::all();
        $topLandingPages = GoogleAnalyticsTopLandingPage::all();
        return view('admin.dashboard.index', 
               compact('totalPropertyLeads','totalProperties','totalAccounts','totalProjects', 'topDevices', 'topReferrers', 
                        'last30DaysVisitors', 'topLandingPages','totalViews'));
    }
}
