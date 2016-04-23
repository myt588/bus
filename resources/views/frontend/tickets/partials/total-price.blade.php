{{ (array_key_exists('trip_two_id', $data) ? 
$trip_one->price() * ($data['adults_depart'] + $data['kids_depart']) + $trip_two->price() * ($data['adults_return'] + $data['kids_return']) : 
$trip_one->price() * ($data['adults_depart'] + $data['kids_depart'])) 
}}