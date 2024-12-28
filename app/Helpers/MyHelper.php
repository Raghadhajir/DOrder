<?php
namespace App\Helpers;

use App\Models\User;
class MyHelper{
    public static function numMontior($id)
    {
        $monitors = User::where('type', '=', 'monitor')->where('area_id', '=', $id)->count();
        return $monitors;
    }
    public static function numDeliver($id)
    {
        $deliveries = User::where('type', '=', 'deliver')->where('area_id', '=', $id)->count();
        return $deliveries;
    }
}

?>