<?php

namespace App\Http\Controllers;

use App\Models\Performance;
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

        // get user id value
        $id = $user->id;

        // getting user data
        $performance = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->get();

        // Data chart
        $open_ogp = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->where('open_ogp_stat', 1)
            ->count();

        $ogp_eskalasi = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->where('ogp_eskalasi_stat', 1)
            ->count();

        $ogp_closed = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->where('ogp_closed_stat', 1)
            ->count();

        $eskalasi_closed = Performance::where('created_at', '>=', $lastmonth)
            ->where('user_id', '=', $id)
            ->where('eskalasi_closed_stat', 1)
            ->count();
        //no row
        $count = 1;

        // testing
        // dd($user, $performance, $open_ogp , $ogp_eskalasi , $ogp_closed , $eskalasi_closed);

        return view('user.show', compact('user', 'performance', 'open_ogp', 'ogp_eskalasi', 'ogp_closed', 'eskalasi_closed', 'count'));
    }

    //filter action
    public function filter(Request $request, User $user)
    {
        // get user id value
        $id = $user->id;

        // get filter parameter
        $filter = $request->input('filteraction');

        
        $performance_filter = DB::table('performances')
            ->where('user_id','=',$id)
            ->where('update_status', 'LIKE', "%{$filter}%")
            ->get();

        return view('user.show', compact('performance_filter', 'user'));
    }

    public function overview($id)
    {
        $user = \App\Models\User::all();

        $namauser = \App\Models\User::find($id);

        $performance = \App\Models\Performance::all();
        //array kosong 
        $namauser = [];
        $datauser = [];

        foreach ($user as $us){
            $namauser[] = $us->name;
            $datauser[] = $namauser->performance;
        }
        // $closed = Performance::
        //                     where('user_id','=',$iduser)
        //                     ->where('user_id','=',$iduser)
        //                     ->get();
        // $closed = Performance::where('created_at', '>=', $today)
        // ->where('user_id', '=', $iduser)
        // ->where('closed_stat', 1)
        // ->count();
        // get data user
        
        // foreach ($performance as $pr){
        //     $dataperformance[] = $pr->
        // }
        

        // testing 
        dd($namauser,$datauser);
        return view('user.overview', compact('namauser','iduser','datauser'));
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
}
