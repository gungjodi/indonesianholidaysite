<?php

namespace App;

class Holiday
{
    public function getHoliday()
    {
        $collection = json_decode(file_get_contents(config('constants.HOLIDAY_URL')),false);
        $itemsCollection = $collection->items;

        foreach ($itemsCollection as $item)
        {
            $holidaysCollection[]= array(
                "message"=>$item->summary,
                "holidayDate"=>$item->start->date,
                "holidayDateTime"=>strtotime($item->start->date)
            );
        }
        return collect($holidaysCollection);
    }

    function validateDate($date)
    {
        // Convert to timestamp
        $startDate = strtotime(config('constants.START_DATE'));
        $endDate = strtotime(config('constants.END_DATE'));

        // Check that user date is between start & end
        return ((strtotime($date) >= $startDate) && (strtotime($date) <= $endDate));
    }
}
