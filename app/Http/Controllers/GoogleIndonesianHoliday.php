<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Config;
use Carbon\Carbon;

class GoogleIndonesianHoliday extends Controller
{
    public function getEvent($date)
    {
        $collection = json_decode(file_get_contents(config('constants.HOLIDAY_URL')),false);
        $itemsCollection = $collection->items;

        foreach ($itemsCollection as $item)
        {
            $holidaysCollection[]=(object) array(
                "holidayName"=>$item->summary,
                "holidayDate"=>$item->start->date,
            );
        }
        $formattedDate =  Carbon::createFromFormat('Y-m-d', $date)->format('d F Y');

        foreach ($holidaysCollection as $holiday)
        {
            if(strtotime($date)==strtotime($holiday->holidayDate))
            {
                return array(
                    "formattedDate"=>$formattedDate,
                    "holidayName"=>$holiday->holidayName
                );
                break;
            }
        }
        return array(
            "formattedDate"=>$formattedDate,
            "holidayName"=>"NOT FOUND"
        );
    }

    public function index()
    {
        return view('index');
    }
}
