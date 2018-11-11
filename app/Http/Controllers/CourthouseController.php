<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourthouseInfo;
use App\Courthouse;
use App\County;
use Yajra\Datatables\Datatables;

class CourthouseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function attorney(Request $request){
    	if($request->user()->authorizeRoles('Attorney')){
            $attorneyInfo = $request->user()->attorney;
            $availableCourthouses = Courthouse::with('county')->select("courthouses.courthouse_id", "courthouses.county_id", "courthouses.court", "courthouses.address")->leftJoin("courthouses_info", "courthouses.courthouse_id", "=", "courthouses_info.courthouse_id")->whereNull("courthouses_info.attorney_userid")->get();
            // $availableCounties = County::all();

            $availableCountyCourthouses = []; 
            // foreach($availableCourthouses as $court){
            //     if(in_array($court->county_id, $availableCountyCourthouses)){
            //         echo "Exists";
            //     }else{
            //         echo "None";
            //     }
            //     array_push($availableCountyCourthouses, array($court->county_id => array("court" => $court->court, "address" => $court->address)));
            //     // var_dump($availableCountyCourthouses);
            // };

            // dd($availableCourthouses);
// ->join("courthouses_info", "courthouse_id", "=", "courthouses.courthouse_id")
            
            // $getAllCourthouse = County::with("courthouse")->get();
            // foreach($getAllCourthouse as $court){
            //     foreach($court->courthouse as $courthouse){
            //         foreach($availableCourthouses as $availCourt){
            //             // echo "Courthouse: " . $courthouse->courthouse_id . " == " . $availCourt->courthouse_id;
            //             if($courthouse->courthouse_id == $availCourt->courthouse_id){
            //                 // array_push($availableCountyCourthouses, array());
            //             }
            //         };
            //     };
            // };
            // $getAllCourthouse->courthousejoin();
            // dd($getAllCourthouse);
            // var_dump($getAllCourthouse);
            // $demo = $getAllCourthouse->courthouse;
            $getAllCourthouseAvailable = County::with([
                "courthouse" => function($q){
                    $q->select('county_id', 'court', 'courthouse_id', 'address')->has("info", "<", "1");
                }
            ])->get();
            // return $getAllCourthouseAvailable;
            // dd($getAllCourthouse->courthouse);
            // var_dump($availableCourt);
            $data = [
                "attorneyInfo" => $attorneyInfo,
                "getAllCourthouseAvailable" => $getAllCourthouseAvailable
                // "availableCounties" => $availableCounties
            ];
            // dd($data);
            return view('attorney_courthouses')->with($data);
        }else{
            return redirect('/login');
        }
    }

    public function getAssociatedCourthouses(Request $request, $id){
        $associatedCourthouse = CourthouseInfo::with('courthouse')->join("counties", "county_id", "=", "counties.county_id")->where("attorney_userid", $id)->get();
        return Datatables::of($associatedCourthouse)->make(true);
    }

    public function store(Request $request){

    }

}
