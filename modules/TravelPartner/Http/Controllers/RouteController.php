<?php namespace Modules\Travelpartner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Session;
use Modules\Travel\Entities\Travelschedule;
use Modules\Vehicle\Entities\City;
use Modules\Vehicle\Entities\Vehicle;
use Modules\vehicle\Entities\VehicleType;
use Modules\Travel\Entities\Route;
use Datatables;
use Input;
class RouteController extends Controller {

private $partner_id;

	public function __construct()
	{
		$this->partner_id=Session::get('id');
	}
	public function index()
	{
		$city=City::all();
		return view('travelpartner::route.index',compact('city'));
	}
	function getRoutePartner()
	{
		$route=Route::getRoutePartner($this->partner_id);
        return Datatables::of($route)
         ->addColumn('action', function ($route) {
         		return '<li class="dropdown dropdown-no-type"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li><button class="btn btn-primary" id="'.$route->ROUTE_ID.'">Edit</button></li><li><button class="btn btn-danger" id="'.$route->ROUTE_ID.'" data-target="#hapusRoute">Hapus</button></li></ul></li>';
            })
        ->make(true);
	}
	function armada()
	{

		$armada=Vehicle::where('VEHICLE_CREATEBY','=',$this->partner_id)->get();
		$route=Route::getRoutePartner($this->partner_id);
		$city=City::all();
		$type=VehicleType::all();
		return view('travelpartner::armada.index',compact('armada','route','city','type'));
	}
	function getarmada()
	{
		$path=url("public/Assets/vehiclePhoto");
		$vehicles =Vehicle::getarmada($this->partner_id)->distinct()->get();
        return Datatables::of($vehicles)
         ->addColumn('action', function ($vehicle){
              //  return '<a href="#edit-'.$user->USERS_ID.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#hapus-'.$user->USERS_ID.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Hapus</a>';
         		return '<li style="decoration:none" class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle btn btn-xs btn-primary" href="#" > Pilihan <b class="caret"></b></a><ul class="dropdown-menu"><li> <button class="btn  btn-primary" id="'.$vehicle->VEHICLE_ID.'">Edit</li><li><button class="btn btn-danger" id="'.$vehicle->VEHICLE_ID.'" data-target="#hapusUser">Hapus</button></li></ul></li>';
            })
         ->addColumn('photo', function ($vehicle) use($path) {
         		return '<img src="'.$path.'/'.$vehicle['VEHICLE_PHOTO'].'" style="width:50px; height:50px">';
         	
            })
            ->make(true);
	}
};