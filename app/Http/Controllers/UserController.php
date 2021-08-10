<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Cache;
use PhpParser\Builder\Function_;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \App\Models\User::all();

        $today = \Carbon\Carbon::today();
        //data piechart
        $open_ogpi = Performance::where('created_at', '>=', $today)
            ->where('update_status', 'open_ogp')
            ->count();

        $ogp_eskalasii = Performance::where('created_at', '>=', $today)
            ->where('update_status', 'ogp_eskalasi')
            ->count();

        $ogp_closedi = Performance::where('created_at', '>=', $today)
            ->where('update_status', 'ogp_closed')
            ->count();

        $eskalasi_closedi = Performance::where('created_at', '>=', $today)
            ->where('update_status', 'eskalasi_closed')
            ->count();
        // testing
        // dd($user,$open_ogpi , $ogp_eskalasii, $ogp_closedi, $eskalasi_closedi);

        return view('user.index', compact('user', 'open_ogpi', 'ogp_eskalasii', 'ogp_closedi', 'eskalasi_closedi'));
    }

    //search berdasarkan nama user
    public function search(Request $request)
    {
        // menangkap data pencarian
        $search = $request->search;

        $user = \App\Models\User::all();

        $today = \Carbon\Carbon::today();
        //data piechart
        $open_ogpi = Performance::where('created_at', '>=', $today)
            ->where('update_status', 'open_ogp')
            ->count();

        $ogp_eskalasii = Performance::where('created_at', '>=', $today)
            ->where('update_status', 'ogp_eskalasi')
            ->count();

        $ogp_closedi = Performance::where('created_at', '>=', $today)
            ->where('update_status', 'ogp_closed')
            ->count();

        $eskalasi_closedi = Performance::where('created_at', '>=', $today)
            ->where('update_status', 'eskalasi_closed')
            ->count();

        // mengambil data dari table report sesuai pencarian data
        $user = DB::table('users')
            ->where('name', 'like', "%" . $search . "%")
            ->get();

        // mengirim data report ke view index
        return view('user.index', ['user' => $user], compact('user', 'open_ogpi', 'ogp_eskalasii', 'ogp_closedi', 'eskalasi_closedi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        // last 30 days
        $lastmonth = \Carbon\Carbon::today()->subDays(30);

        // last weeks
        $lastweek = \Carbon\Carbon::today()->subDays(7);

        // yesterday
        $yesterday = \Carbon\Carbon::yesterday();

        // today
        $today = \Carbon\Carbon::today();

        // get user id value
        $id = $user->id;

        // getting user data
        $performance = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->paginate(10);

        // Data chart 30
        $open_ogp30 = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->where('open_ogp_stat', 1)
            ->count();

        $ogp_eskalasi30 = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->where('ogp_eskalasi_stat', 1)
            ->count();

        $ogp_closed30 = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->where('ogp_closed_stat', 1)
            ->count();

        $eskalasi_closed30 = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->where('eskalasi_closed_stat', 1)
            ->count();

        // Data chart 7
        $open_ogp7 = Performance::where('created_at', '>=', $lastweek)
        ->where('user_id', '=', $id)
        ->where('open_ogp_stat', 1)
        ->count();

        $ogp_eskalasi7 = Performance::where('created_at', '>=', $lastweek)
        ->where('user_id', '=', $id)
        ->where('ogp_eskalasi_stat', 1)
        ->count();

        $ogp_closed7 = Performance::where('created_at', '>=', $lastweek)
        ->where('user_id', '=', $id)
        ->where('ogp_closed_stat', 1)
        ->count();

        $eskalasi_closed7 = Performance::where('created_at', '>=', $lastweek)
        ->where('user_id', '=', $id)
        ->where('eskalasi_closed_stat', 1)
        ->count();

        // Data chart yesterday
        $open_ogpy = Performance::whereDate('created_at', $yesterday)
        ->where('user_id', '=', $id)
        ->where('open_ogp_stat', 1)
        ->count();

        $ogp_eskalasiy = Performance::whereDate('created_at', $yesterday)
        ->where('user_id', '=', $id)
        ->where('ogp_eskalasi_stat', 1)
        ->count();

        $ogp_closedy = Performance::whereDate('created_at', $yesterday)
        ->where('user_id', '=', $id)
        ->where('ogp_closed_stat', 1)
        ->count();

        $eskalasi_closedy = Performance::whereDate('created_at', $yesterday)
        ->where('user_id', '=', $id)
        ->where('eskalasi_closed_stat', 1)
        ->count();

         // Data chart today
        $open_ogpt = Performance::where('created_at', '>=', $today)
        ->where('user_id', '=', $id)
        ->where('open_ogp_stat', 1)
        ->count();

        $ogp_eskalasit = Performance::where('created_at', '>=', $today)
        ->where('user_id', '=', $id)
        ->where('ogp_eskalasi_stat', 1)
        ->count();
        
        $ogp_closedt = Performance::where('created_at', '>=', $today)
        ->where('user_id', '=', $id)
        ->where('ogp_closed_stat', 1)
        ->count();

        $eskalasi_closedt = Performance::where('created_at', '>=', $today)
        ->where('user_id', '=', $id)
        ->where('eskalasi_closed_stat', 1)
        ->count();

        //no row
        $count = 1;

        // testing
        // dd($user, $performance, $open_ogp , $ogp_eskalasi , $ogp_closed , $eskalasi_closed);

        return view('user.show', compact('user', 'performance', 'open_ogp30', 'ogp_eskalasi30', 'ogp_closed30', 'eskalasi_closed30', 'open_ogp7', 'ogp_eskalasi7', 'ogp_closed7', 'eskalasi_closed7', 'open_ogpy', 'ogp_eskalasiy', 'ogp_closedy', 'eskalasi_closedy', 'open_ogpt', 'ogp_eskalasit', 'ogp_closedt', 'eskalasi_closedt', 'count'));
    }

    //filter action
    // public function filter(Request $request, User $user)
    // {
    //     // get user id value
    //     $id = $user->id;

    //     // get filter parameter
    //     $filter = $request->input('filteraction');

        
    //     $performance_filter = DB::table('performances')
    //         ->where('user_id','=',$id)
    //         ->where('update_status', 'LIKE', "%{$filter}%")
    //         ->get();

    //     return view('user.show', compact('performance_filter', 'user'));
    // }

    public function overview()
    {
        //  variable tanggal
        $today = \Carbon\Carbon::today();

        // get all user data
        $user = \App\Models\User::all();
        
        //  array kosong
        $iduser = [];
        $namauser = [];
        $datauser = [];

        // isi array 
        foreach ($user as $us){
        $namauser[] = $us->name;
        $iduser[] = $us->id;
        $datauser[] = $performance = Performance::whereIn('user_id',[$us->id])
                                                ->whereDate('updated_at',$today)
                                                ->where('closed_stat',1)
                                                ->count();
        }

        //  testing
        //  dd($namauser,$iduser,$datauser);

        return view('user/overview' ,compact('namauser','iduser','datauser'));
    }

    public function status()
    {
        $users = User::all();

        foreach ($users as $user) {

            if (Cache::has('user-is-online-' . $user->id))
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " ";
            else {
                if ($user->last_seen != null) {
                    echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " ";
                } else {
                    echo $user->name . " is offline. Last seen: No data ";
                }
            }
        }
    }

    /**
     * Live status page.
     */
    public function liveStatusPage()
    {
        $users = \App\Models\User::all();
        return view('live', compact('users'));
    }

    /**
     * Live status.
     */
    public function liveStatus($user_id)
    {
        // get user data
        $user = User::find($user_id);

        // check online status
        if (Cache::has('user-is-online-' . $user->id))
            $status = 'Online';
        else
            $status = 'Offline';

        // check last seen
        if ($user->last_seen != null)
            $last_seen = "Active " . Carbon::parse($user->last_seen)->diffForHumans();
        else
            $last_seen = "No data";

        // response
        return response()->json([
            'status' => $status,
            'last_seen' => $last_seen,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportCsvlastmonth(Request $request , User $user)
    {
        $date = \Carbon\Carbon::today()->subDays(30);
        $id = $request->id;
        $name = $user->name;
        $performance = Performance::where('user_id', '=', $id)
                                    ->where('created_at','>=',$date)
                                    ->get();

        $count = 1;
                                
        $filename = 'performance.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('No', 'user_name', 'id_moban','no_order','update_status','created_at'));

        foreach($performance as $row) {
        fputcsv($handle, array($count++, $row['user_name'], $row['id_moban'], $row['no_order'], $row['update_status'], $row['created_at']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );
        
        //dd($performance,$name);

        return response()->download($filename, 'performance.csv', $headers);
    }

    public function exportCsvlastweek(Request $request , User $user)
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        $id = $request->id;
        $performance = Performance::where('user_id', '=', $id)
                                    ->where('created_at','>=',$date)
                                    ->get();

        $count = 1;
                                
        $filename = 'performance.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('No', 'user_name', 'id_moban','no_order','update_status','created_at'));

        foreach($performance as $row) {
        fputcsv($handle, array($count++, $row['user_name'], $row['id_moban'], $row['no_order'], $row['update_status'], $row['created_at']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );
        
        //dd($performance);

        return response()->download($filename, 'performance.csv', $headers);
    }

    public function exportCsvyesterday(Request $request , User $user)
    {
        $date = \Carbon\Carbon::yesterday();
        $id = $request->id;
        $performance = Performance::where('user_id', '=', $id)
                                    ->whereDate('created_at',$date)
                                    ->get();

        $count = 1;
                                
        $filename = 'performance.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('No', 'user_name', 'id_moban','no_order','update_status','created_at'));

        foreach($performance as $row) {
        fputcsv($handle, array($count++, $row['user_name'], $row['id_moban'], $row['no_order'], $row['update_status'], $row['created_at']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );
        
        //dd($performance, $date);

        return response()->download($filename, 'performance.csv', $headers);
    }

    public function exportCsvtoday(Request $request , User $user)
    {
        $date = \Carbon\Carbon::today();
        $id = $request->id;
        $performance = Performance::where('user_id', '=', $id)
                                    ->where('created_at','>=',$date)
                                    ->get();

        $count = 1;
                                
        $filename = 'performance.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('No', 'user_name', 'id_moban','no_order','update_status','created_at'));

        foreach($performance as $row) {
        fputcsv($handle, array($count++, $row['user_name'], $row['id_moban'], $row['no_order'], $row['update_status'], $row['created_at']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );
        
        //dd($performance);

        return response()->download($filename, 'performance.csv', $headers);
    }

    public function exportCsvall(Request $request , User $user)
    {
        
        $id = $request->id;
        $performance = Performance::where('user_id', '=', $id)->get();

        $count = 1;
                                
        $filename = 'performance.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('No', 'user_name', 'id_moban','no_order','update_status','created_at'));

        foreach($performance as $row) {
        fputcsv($handle, array($count++, $row['user_name'], $row['id_moban'], $row['no_order'], $row['update_status'], $row['created_at']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );
        
        //dd($performance);

        return response()->download($filename, 'performance.csv', $headers);
    }
}
