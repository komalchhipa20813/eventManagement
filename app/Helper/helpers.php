<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\{EventGallery,Event};


// / encrypt primary key of user /
if (!function_exists('encryptid')) {
	function encryptid($string) {
		$encrypted = Crypt::encryptString($string);
		return $encrypted;
	}
}

// / decrypt primary key of user /
if (!function_exists('decryptid')) {
	function decryptid($string) {
		$decrypted = Crypt::decryptString($string);
		return $decrypted;
	}
}

    function active_class($path, $active = 'active') {
      return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    function is_active_route($path) {
      return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
    }

    function show_class($path) {
      return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
    }
    if (!function_exists('dashboard_calculation')) {
        function dashboard_calculation($table){
            return DB::table($table)->select('id')->where('status',1)->count();
        }
    }
	
    if(!function_exists('query')) {
        function query($query) {
            $sql = str_replace(array('?'), array('\'%s\''), $query->toSql());
            $query = vsprintf($sql, $query->getBindings());
            dd($query);
        }
    }

    if(!function_exists('getUpComingEventData')) {
      function getUpComingEventData() {
         $endDate =Carbon::today()->addDays(30)->format('Y-m-d 23:59:59');
         $toDate= Carbon::today()->format('Y-m-d 00:00:00');
         
        return Event::where('status',1)->whereBetween('date',[$toDate,$endDate])->orderBy('date', 'ASC')->first();
      }
  }


    

?>
