<?php namespace Modules\Rent\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DB;
class rentschedule extends Model {

    protected $fillable = [];
    public $timestamps=false;
    const UPDATE_AT='RENT_SCHEDULE_UPDATE';
    protected $table='RENT_SCHEDULE';
    function scopegetScheduleDay($query,$tanggal){
    	return $query->select(['VEHICLE.*','RENT_SCHEDULE.*'])
    			->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID')
                ->where('RENT_SCHEDULE.RENT_SCHEDULE_DATE','LIKE','%'.$tanggal)	;

    }
    function scopefindRentSchedule($query,$id){
    	return $query->select(['RENT_SCHEDULE.*', 'VEHICLE.*','PARTNER.*','CITY.*'])
                    ->where('RENT_SCHEDULE.RENT_SCHEDULE_ID','=',$id)
                    ->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID')
                    ->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
                    ->join('CITY','CITY.CITY_ID','=','VEHICLE.CITY_ID');

    }
     function scoperentSchedule($query,$city, $date,$finish){
        return $query->select(['RENT_SCHEDULE.*','VEHICLE.*', 'PARTNER.*','CITY_NAME','VEHICLE_TYPE_NAME'])
                ->where('RENT_SCHEDULE_DATE','=',$date)
                ->whereNotIn('RENT_SCHEDULE_ID',function($query) use($date,$finish) {
                    $query->select(['RENT_TRANSACTION_DETAIL.RENT_SCHEDULE_ID'])
                        ->from('RENT_TRANSACTION_DETAIL')
                        ->join('RENT_SCHEDULE','RENT_SCHEDULE.RENT_SCHEDULE_ID','=','RENT_TRANSACTION_DETAIL.RENT_SCHEDULE_ID')
                        ->whereBetween('RENT_SCHEDULE_DATE',[$date,$finish])
                        ;})
                ->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID')
                ->join('CITY','CITY.CITY_ID','=','VEHICLE.CITY_ID')
                ->where('CITY.CITY_ID','=',$city)
                ->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
                ->join('VEHICLE_TYPE','VEHICLE_TYPE.VEHICLE_TYPE_ID','=','VEHICLE.VEHICLE_TYPE_ID');
    }

    function scopepartnerSchedule($query,$partner_id,$tanggal)
    {
        return $query->select(['RENT_SCHEDULE.*','VEHICLE.*','CITY.*']) 
                    ->where('RENT_SCHEDULE_DATE',  'LIKE',$tanggal.'%' )
                    ->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID')
                    ->join('VEHICLE_TYPE','VEHICLE_TYPE.VEHICLE_TYPE_ID','=','VEHICLE.VEHICLE_TYPE_ID')
                    ->join('PARTNER','PARTNER.PARTNER_ID','=','VEHICLE.PARTNER_ID')
                    ->where('PARTNER.PARTNER_ID','=',$partner_id)        
                    ->join('CITY','CITY.CITY_ID','=','VEHICLE.CITY_ID')            
                    ->orderBy('RENT_SCHEDULE_DATE');
    }
    /*function scopegetScheduleDayPartner($query,$tanggal,$partner_id){
        return $query->select('RENT_SCHEDULE.*','VEHICLE_NAME','CITY.*'])
                ->where('RENT_SCHEDULE_DEPARTTIME','LIKE',$tanggal.'%')
                ->join('ROUTE','ROUTE.ROUTE_ID','=','RENT_SCHEDULE.ROUTE_ID')
                ->join('VEHICLE','VEHICLE.VEHICLE_ID','=','RENT_SCHEDULE.VEHICLE_ID')
                ->where('VEHICLE.PARTNER_ID','=',$partner_id);
    }*/
}