<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Timezone
 *
 * @author CMSHelplive
 */
class Element_Timezone extends Element_Select
{

    public function __construct($label, $name, array $properties = null)
    {
        $options = array(
            null => __('--Select Timezone--','custom-registration-form-builder-with-submission-manager'),
            'Africa/Abidjan' => __('Abidjan','custom-registration-form-builder-with-submission-manager'),
            'Africa/Accra' => __('Accra','custom-registration-form-builder-with-submission-manager'),
            'Africa/Addis_Ababa' => __('Addis Ababa','custom-registration-form-builder-with-submission-manager'),
            'Africa/Algiers' => __('Algiers','custom-registration-form-builder-with-submission-manager'),
            'Africa/Asmara' => __('Asmara','custom-registration-form-builder-with-submission-manager'),
            'Africa/Bamako' => __('Bamako','custom-registration-form-builder-with-submission-manager'),
            'Africa/Bangui' => __('Bangui','custom-registration-form-builder-with-submission-manager'),
            'Africa/Banjul' => __('Banjul','custom-registration-form-builder-with-submission-manager'),
            'Africa/Bissau' => __('Bissau','custom-registration-form-builder-with-submission-manager'),
            'Africa/Blantyre' => __('Blantyre','custom-registration-form-builder-with-submission-manager'),
            'Africa/Brazzaville' => __('Brazzaville','custom-registration-form-builder-with-submission-manager'),
            'Africa/Bujumbura' => __('Bujumbura','custom-registration-form-builder-with-submission-manager'),
            'Africa/Cairo' => __('Cairo','custom-registration-form-builder-with-submission-manager'),
            'Africa/Casablanca' => __('Casablanca','custom-registration-form-builder-with-submission-manager'),
            'Africa/Ceuta' => __('Ceuta','custom-registration-form-builder-with-submission-manager'),
            'Africa/Conakry' => __('Conakry','custom-registration-form-builder-with-submission-manager'),
            'Africa/Dakar' => __('Dakar','custom-registration-form-builder-with-submission-manager'),
            'Africa/Dar_es_Salaam' => __('Dar es Salaam','custom-registration-form-builder-with-submission-manager'),
            'Africa/Djibouti' => __('Djibouti','custom-registration-form-builder-with-submission-manager'),
            'Africa/Douala' => __('Douala','custom-registration-form-builder-with-submission-manager'),
            'Africa/El_Aaiun' => __('El Aaiun','custom-registration-form-builder-with-submission-manager'),
            'Africa/Freetown' => __('Freetown','custom-registration-form-builder-with-submission-manager'),
            'Africa/Gaborone' => __('Gaborone','custom-registration-form-builder-with-submission-manager'),
            'Africa/Harare' => __('Harare','custom-registration-form-builder-with-submission-manager'),
            'Africa/Johannesburg' => __('Johannesburg','custom-registration-form-builder-with-submission-manager'),
            'Africa/Juba' => __('Juba','custom-registration-form-builder-with-submission-manager'),
            'Africa/Kampala' => __('Kampala','custom-registration-form-builder-with-submission-manager'),
            'Africa/Khartoum' => __('Khartoum','custom-registration-form-builder-with-submission-manager'),
            'Africa/Kigali' => __('Kigali','custom-registration-form-builder-with-submission-manager'),
            'Africa/Kinshasa' => __('Kinshasa','custom-registration-form-builder-with-submission-manager'),
            'Africa/Lagos' => __('Lagos','custom-registration-form-builder-with-submission-manager'),
            'Africa/Libreville' => __('Libreville','custom-registration-form-builder-with-submission-manager'),
            'Africa/Lome' => __('Lome','custom-registration-form-builder-with-submission-manager'),
            'Africa/Luanda' => __('Luanda','custom-registration-form-builder-with-submission-manager'),
            'Africa/Lubumbashi' => __('Lubumbashi','custom-registration-form-builder-with-submission-manager'),
            'Africa/Lusaka' => __('Lusaka','custom-registration-form-builder-with-submission-manager'),
            'Africa/Malabo' => __('Malabo','custom-registration-form-builder-with-submission-manager'),
            'Africa/Maputo' => __('Maputo','custom-registration-form-builder-with-submission-manager'),
            'Africa/Maseru' => __('Maseru','custom-registration-form-builder-with-submission-manager'),
            'Africa/Mbabane' => __('Mbabane','custom-registration-form-builder-with-submission-manager'),
            'Africa/Mogadishu' => __('Mogadishu','custom-registration-form-builder-with-submission-manager'),
            'Africa/Monrovia' => __('Monrovia','custom-registration-form-builder-with-submission-manager'),
            'Africa/Nairobi' => __('Nairobi','custom-registration-form-builder-with-submission-manager'),
            'Africa/Ndjamena' => __('Ndjamena','custom-registration-form-builder-with-submission-manager'),
            'Africa/Niamey' => __('Niamey','custom-registration-form-builder-with-submission-manager'),
            'Africa/Nouakchott' => __('Nouakchott','custom-registration-form-builder-with-submission-manager'),
            'Africa/Ouagadougou' => __('Ouagadougou','custom-registration-form-builder-with-submission-manager'),
            'Africa/Porto-Novo' => __('Porto-Novo','custom-registration-form-builder-with-submission-manager'),
            'Africa/Sao_Tome' => __('Sao Tome','custom-registration-form-builder-with-submission-manager'),
            'Africa/Tripoli' => __('Tripoli','custom-registration-form-builder-with-submission-manager'),
            'Africa/Tunis' => __('Tunis','custom-registration-form-builder-with-submission-manager'),
            'Africa/Windhoek' => __('Windhoek','custom-registration-form-builder-with-submission-manager'),
            'America/Adak' => __('Adak','custom-registration-form-builder-with-submission-manager'),
            'America/Anchorage' => __('Anchorage','custom-registration-form-builder-with-submission-manager'),
            'America/Anguilla' => __('Anguilla','custom-registration-form-builder-with-submission-manager'),
            'America/Antigua' => __('Antigua','custom-registration-form-builder-with-submission-manager'),
            'America/Araguaina' => __('Araguaina','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Buenos_Aires' => __('Argentina - Buenos Aires','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Catamarca' => __('Argentina - Catamarca','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Cordoba' => __('Argentina - Cordoba','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Jujuy' => __('Argentina - Jujuy','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/La_Rioja' => __('Argentina - La Rioja','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Mendoza' => __('Argentina - Mendoza','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Rio_Gallegos' => __('Argentina - Rio Gallegos','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Salta' => __('Argentina - Salta','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/San_Juan' => __('Argentina - San Juan','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/San_Luis' => __('Argentina - San Luis','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Tucuman' => __('Argentina - Tucuman','custom-registration-form-builder-with-submission-manager'),
            'America/Argentina/Ushuaia' => __('Argentina - Ushuaia','custom-registration-form-builder-with-submission-manager'),
            'America/Aruba' => __('Aruba','custom-registration-form-builder-with-submission-manager'),
            'America/Asuncion' => __('Asuncion','custom-registration-form-builder-with-submission-manager'),
            'America/Atikokan' => __('Atikokan','custom-registration-form-builder-with-submission-manager'),
            'America/Bahia' => __('Bahia','custom-registration-form-builder-with-submission-manager'),
            'America/Bahia_Banderas' => __('Bahia Banderas','custom-registration-form-builder-with-submission-manager'),
            'America/Barbados' => __('Barbados','custom-registration-form-builder-with-submission-manager'),
            'America/Belem' => __('Belem','custom-registration-form-builder-with-submission-manager'),
            'America/Belize' => __('Belize','custom-registration-form-builder-with-submission-manager'),
            'America/Blanc-Sablon' => __('Blanc-Sablon','custom-registration-form-builder-with-submission-manager'),
            'America/Boa_Vista' => __('Boa Vista','custom-registration-form-builder-with-submission-manager'),
            'America/Bogota' => __('Bogota','custom-registration-form-builder-with-submission-manager'),
            'America/Boise' => __('Boise','custom-registration-form-builder-with-submission-manager'),
            'America/Cambridge_Bay' => __('Cambridge Bay','custom-registration-form-builder-with-submission-manager'),
            'America/Campo_Grande' => __('Campo Grande','custom-registration-form-builder-with-submission-manager'),
            'America/Cancun' => __('Cancun','custom-registration-form-builder-with-submission-manager'),
            'America/Caracas' => __('Caracas','custom-registration-form-builder-with-submission-manager'),
            'America/Cayenne' => __('Cayenne','custom-registration-form-builder-with-submission-manager'),
            'America/Cayman' => __('Cayman','custom-registration-form-builder-with-submission-manager'),
            'America/Chicago' => __('Chicago','custom-registration-form-builder-with-submission-manager'),
            'America/Chihuahua' => __('Chihuahua','custom-registration-form-builder-with-submission-manager'),
            'America/Costa_Rica' => __('Costa Rica','custom-registration-form-builder-with-submission-manager'),
            'America/Creston' => __('Creston','custom-registration-form-builder-with-submission-manager'),
            'America/Cuiaba' => __('Cuiaba','custom-registration-form-builder-with-submission-manager'),
            'America/Curacao' => __('Curacao','custom-registration-form-builder-with-submission-manager'),
            'America/Danmarkshavn' => __('Danmarkshavn','custom-registration-form-builder-with-submission-manager'),
            'America/Dawson' => __('Dawson','custom-registration-form-builder-with-submission-manager'),
            'America/Dawson_Creek' => __('Dawson Creek','custom-registration-form-builder-with-submission-manager'),
            'America/Denver' => __('Denver','custom-registration-form-builder-with-submission-manager'),
            'America/Detroit' => __('Detroit','custom-registration-form-builder-with-submission-manager'),
            'America/Dominica' => __('Dominica','custom-registration-form-builder-with-submission-manager'),
            'America/Edmonton' => __('Edmonton','custom-registration-form-builder-with-submission-manager'),
            'America/Eirunepe' => __('Eirunepe','custom-registration-form-builder-with-submission-manager'),
            'America/El_Salvador' => __('El Salvador','custom-registration-form-builder-with-submission-manager'),
            'America/Fortaleza' => __('Fortaleza','custom-registration-form-builder-with-submission-manager'),
            'America/Glace_Bay' => __('Glace Bay','custom-registration-form-builder-with-submission-manager'),
            'America/Godthab' => __('Godthab','custom-registration-form-builder-with-submission-manager'),
            'America/Goose_Bay' => __('Goose Bay','custom-registration-form-builder-with-submission-manager'),
            'America/Grand_Turk' => __('Grand Turk','custom-registration-form-builder-with-submission-manager'),
            'America/Grenada' => __('Grenada','custom-registration-form-builder-with-submission-manager'),
            'America/Guadeloupe' => __('Guadeloupe','custom-registration-form-builder-with-submission-manager'),
            'America/Guatemala' => __('Guatemala','custom-registration-form-builder-with-submission-manager'),
            'America/Guayaquil' => __('Guayaquil','custom-registration-form-builder-with-submission-manager'),
            'America/Guyana' => __('Guyana','custom-registration-form-builder-with-submission-manager'),
            'America/Halifax' => __('Halifax','custom-registration-form-builder-with-submission-manager'),
            'America/Havana' => __('Havana','custom-registration-form-builder-with-submission-manager'),
            'America/Hermosillo' => __('Hermosillo','custom-registration-form-builder-with-submission-manager'),
            'America/Indiana/Indianapolis' => __('Indiana - Indianapolis','custom-registration-form-builder-with-submission-manager'),
            'America/Indiana/Knox' => __('Indiana - Knox','custom-registration-form-builder-with-submission-manager'),
            'America/Indiana/Marengo' => __('Indiana - Marengo','custom-registration-form-builder-with-submission-manager'),
            'America/Indiana/Petersburg' => __('Indiana - Petersburg','custom-registration-form-builder-with-submission-manager'),
            'America/Indiana/Tell_City' => __('Indiana - Tell City','custom-registration-form-builder-with-submission-manager'),
            'America/Indiana/Vevay' => __('Indiana - Vevay','custom-registration-form-builder-with-submission-manager'),
            'America/Indiana/Vincennes' => __('Indiana - Vincennes','custom-registration-form-builder-with-submission-manager'),
            'America/Indiana/Winamac' => __('Indiana - Winamac','custom-registration-form-builder-with-submission-manager'),
            'America/Inuvik' => __('Inuvik','custom-registration-form-builder-with-submission-manager'),
            'America/Iqaluit' => __('Iqaluit','custom-registration-form-builder-with-submission-manager'),
            'America/Jamaica' => __('Jamaica','custom-registration-form-builder-with-submission-manager'),
            'America/Juneau' => __('Juneau','custom-registration-form-builder-with-submission-manager'),
            'America/Kentucky/Louisville' => __('Kentucky - Louisville','custom-registration-form-builder-with-submission-manager'),
            'America/Kentucky/Monticello' => __('Kentucky - Monticello','custom-registration-form-builder-with-submission-manager'),
            'America/Kralendijk' => __('Kralendijk','custom-registration-form-builder-with-submission-manager'),
            'America/La_Paz' => __('La Paz','custom-registration-form-builder-with-submission-manager'),
            'America/Lima' => __('Lima','custom-registration-form-builder-with-submission-manager'),
            'America/Los_Angeles' => __('Los Angeles','custom-registration-form-builder-with-submission-manager'),
            'America/Lower_Princes' => __('Lower Princes','custom-registration-form-builder-with-submission-manager'),
            'America/Maceio' => __('Maceio','custom-registration-form-builder-with-submission-manager'),
            'America/Managua' => __('Managua','custom-registration-form-builder-with-submission-manager'),
            'America/Manaus' => __('Manaus','custom-registration-form-builder-with-submission-manager'),
            'America/Marigot' => __('Marigot','custom-registration-form-builder-with-submission-manager'),
            'America/Martinique' => __('Martinique','custom-registration-form-builder-with-submission-manager'),
            'America/Matamoros' => __('Matamoros','custom-registration-form-builder-with-submission-manager'),
            'America/Mazatlan' => __('Mazatlan','custom-registration-form-builder-with-submission-manager'),
            'America/Menominee' => __('Menominee','custom-registration-form-builder-with-submission-manager'),
            'America/Merida' => __('Merida','custom-registration-form-builder-with-submission-manager'),
            'America/Metlakatla' => __('Metlakatla','custom-registration-form-builder-with-submission-manager'),
            'America/Mexico_City' => __('Mexico City','custom-registration-form-builder-with-submission-manager'),
            'America/Miquelon' => __('Miquelon','custom-registration-form-builder-with-submission-manager'),
            'America/Moncton' => __('Moncton','custom-registration-form-builder-with-submission-manager'),
            'America/Monterrey' => __('Monterrey','custom-registration-form-builder-with-submission-manager'),
            'America/Montevideo' => __('Montevideo','custom-registration-form-builder-with-submission-manager'),
            'America/Montserrat' => __('Montserrat','custom-registration-form-builder-with-submission-manager'),
            'America/Nassau' => __('Nassau','custom-registration-form-builder-with-submission-manager'),
            'America/New_York' => __('New York','custom-registration-form-builder-with-submission-manager'),
            'America/Nipigon' => __('Nipigon','custom-registration-form-builder-with-submission-manager'),
            'America/Nome' => __('Nome','custom-registration-form-builder-with-submission-manager'),
            'America/Noronha' => __('Noronha','custom-registration-form-builder-with-submission-manager'),
            'America/North_Dakota/Beulah' => __('North Dakota - Beulah','custom-registration-form-builder-with-submission-manager'),
            'America/North_Dakota/Center' => __('North Dakota - Center','custom-registration-form-builder-with-submission-manager'),
            'America/North_Dakota/New_Salem' => __('North Dakota - New Salem','custom-registration-form-builder-with-submission-manager'),
            'America/Ojinaga' => __('Ojinaga','custom-registration-form-builder-with-submission-manager'),
            'America/Panama' => __('Panama','custom-registration-form-builder-with-submission-manager'),
            'America/Pangnirtung' => __('Pangnirtung','custom-registration-form-builder-with-submission-manager'),
            'America/Paramaribo' => __('Paramaribo','custom-registration-form-builder-with-submission-manager'),
            'America/Phoenix' => __('Phoenix','custom-registration-form-builder-with-submission-manager'),
            'America/Port-au-Prince' => __('Port-au-Prince','custom-registration-form-builder-with-submission-manager'),
            'America/Port_of_Spain' => __('Port of Spain','custom-registration-form-builder-with-submission-manager'),
            'America/Porto_Velho' => __('Porto Velho','custom-registration-form-builder-with-submission-manager'),
            'America/Puerto_Rico' => __('Puerto Rico','custom-registration-form-builder-with-submission-manager'),
            'America/Rainy_River' => __('Rainy River','custom-registration-form-builder-with-submission-manager'),
            'America/Rankin_Inlet' => __('Rankin Inlet','custom-registration-form-builder-with-submission-manager'),
            'America/Recife' => __('Recife','custom-registration-form-builder-with-submission-manager'),
            'America/Regina' => __('Regina','custom-registration-form-builder-with-submission-manager'),
            'America/Resolute' => __('Resolute','custom-registration-form-builder-with-submission-manager'),
            'America/Rio_Branco' => __('Rio Branco','custom-registration-form-builder-with-submission-manager'),
            'America/Santa_Isabel' => __('Santa Isabel','custom-registration-form-builder-with-submission-manager'),
            'America/Santarem' => __('Santarem','custom-registration-form-builder-with-submission-manager'),
            'America/Santiago' => __('Santiago','custom-registration-form-builder-with-submission-manager'),
            'America/Santo_Domingo' => __('Santo Domingo','custom-registration-form-builder-with-submission-manager'),
            'America/Sao_Paulo' => __('Sao Paulo','custom-registration-form-builder-with-submission-manager'),
            'America/Scoresbysund' => __('Scoresbysund','custom-registration-form-builder-with-submission-manager'),
            'America/Sitka' => __('Sitka','custom-registration-form-builder-with-submission-manager'),
            'America/St_Barthelemy' => __('St Barthelemy','custom-registration-form-builder-with-submission-manager'),
            'America/St_Johns' => __('St Johns','custom-registration-form-builder-with-submission-manager'),
            'America/St_Kitts' => __('St Kitts','custom-registration-form-builder-with-submission-manager'),
            'America/St_Lucia' => __('St Lucia','custom-registration-form-builder-with-submission-manager'),
            'America/St_Thomas' => __('St Thomas','custom-registration-form-builder-with-submission-manager'),
            'America/St_Vincent' => __('St Vincent','custom-registration-form-builder-with-submission-manager'),
            'America/Swift_Current' => __('Swift Current','custom-registration-form-builder-with-submission-manager'),
            'America/Tegucigalpa' => __('Tegucigalpa','custom-registration-form-builder-with-submission-manager'),
            'America/Thule' => __('Thule','custom-registration-form-builder-with-submission-manager'),
            'America/Thunder_Bay' => __('Thunder Bay','custom-registration-form-builder-with-submission-manager'),
            'America/Tijuana' => __('Tijuana','custom-registration-form-builder-with-submission-manager'),
            'America/Toronto' => __('Toronto','custom-registration-form-builder-with-submission-manager'),
            'America/Tortola' => __('Tortola','custom-registration-form-builder-with-submission-manager'),
            'America/Vancouver' => __('Vancouver','custom-registration-form-builder-with-submission-manager'),
            'America/Whitehorse' => __('Whitehorse','custom-registration-form-builder-with-submission-manager'),
            'America/Winnipeg' => __('Winnipeg','custom-registration-form-builder-with-submission-manager'),
            'America/Yakutat' => __('Yakutat','custom-registration-form-builder-with-submission-manager'),
            'America/Yellowknife' => __('Yellowknife','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Casey' => __('Casey','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Davis' => __('Davis','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/DumontDUrville' => __('DumontDUrville','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Macquarie' => __('Macquarie','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Mawson' => __('Mawson','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/McMurdo' => __('McMurdo','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Palmer' => __('Palmer','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Rothera' => __('Rothera','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Syowa' => __('Syowa','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Troll' => __('Troll','custom-registration-form-builder-with-submission-manager'),
            'Antarctica/Vostok' => __('Vostok','custom-registration-form-builder-with-submission-manager'),
            'Arctic/Longyearbyen' => __('Longyearbyen','custom-registration-form-builder-with-submission-manager'),
            'Asia/Aden' => __('Aden','custom-registration-form-builder-with-submission-manager'),
            'Asia/Almaty' => __('Almaty','custom-registration-form-builder-with-submission-manager'),
            'Asia/Amman' => __('Amman','custom-registration-form-builder-with-submission-manager'),
            'Asia/Anadyr' => __('Anadyr','custom-registration-form-builder-with-submission-manager'),
            'Asia/Aqtau' => __('Aqtau','custom-registration-form-builder-with-submission-manager'),
            'Asia/Aqtobe' => __('Aqtobe','custom-registration-form-builder-with-submission-manager'),
            'Asia/Ashgabat' => __('Ashgabat','custom-registration-form-builder-with-submission-manager'),
            'Asia/Baghdad' => __('Baghdad','custom-registration-form-builder-with-submission-manager'),
            'Asia/Bahrain' => __('Bahrain','custom-registration-form-builder-with-submission-manager'),
            'Asia/Baku' => __('Baku','custom-registration-form-builder-with-submission-manager'),
            'Asia/Bangkok' => __('Bangkok','custom-registration-form-builder-with-submission-manager'),
            'Asia/Beirut' => __('Beirut','custom-registration-form-builder-with-submission-manager'),
            'Asia/Bishkek' => __('Bishkek','custom-registration-form-builder-with-submission-manager'),
            'Asia/Brunei' => __('Brunei','custom-registration-form-builder-with-submission-manager'),
            'Asia/Choibalsan' => __('Choibalsan','custom-registration-form-builder-with-submission-manager'),
            'Asia/Chongqing' => __('Chongqing','custom-registration-form-builder-with-submission-manager'),
            'Asia/Colombo' => __('Colombo','custom-registration-form-builder-with-submission-manager'),
            'Asia/Damascus' => __('Damascus','custom-registration-form-builder-with-submission-manager'),
            'Asia/Dhaka' => __('Dhaka','custom-registration-form-builder-with-submission-manager'),
            'Asia/Dili' => __('Dili','custom-registration-form-builder-with-submission-manager'),
            'Asia/Dubai' => __('Dubai','custom-registration-form-builder-with-submission-manager'),
            'Asia/Dushanbe' => __('Dushanbe','custom-registration-form-builder-with-submission-manager'),
            'Asia/Gaza' => __('Gaza','custom-registration-form-builder-with-submission-manager'),
            'Asia/Harbin' => __('Harbin','custom-registration-form-builder-with-submission-manager'),
            'Asia/Hebron' => __('Hebron','custom-registration-form-builder-with-submission-manager'),
            'Asia/Ho_Chi_Minh' => __('Ho Chi Minh','custom-registration-form-builder-with-submission-manager'),
            'Asia/Hong_Kong' => __('Hong Kong','custom-registration-form-builder-with-submission-manager'),
            'Asia/Hovd' => __('Hovd','custom-registration-form-builder-with-submission-manager'),
            'Asia/Irkutsk' => __('Irkutsk','custom-registration-form-builder-with-submission-manager'),
            'Asia/Jakarta' => __('Jakarta','custom-registration-form-builder-with-submission-manager'),
            'Asia/Jayapura' => __('Jayapura','custom-registration-form-builder-with-submission-manager'),
            'Asia/Jerusalem' => __('Jerusalem','custom-registration-form-builder-with-submission-manager'),
            'Asia/Kabul' => __('Kabul','custom-registration-form-builder-with-submission-manager'),
            'Asia/Kamchatka' => __('Kamchatka','custom-registration-form-builder-with-submission-manager'),
            'Asia/Karachi' => __('Karachi','custom-registration-form-builder-with-submission-manager'),
            'Asia/Kashgar' => __('Kashgar','custom-registration-form-builder-with-submission-manager'),
            'Asia/Kathmandu' => __('Kathmandu','custom-registration-form-builder-with-submission-manager'),
            'Asia/Khandyga' => __('Khandyga','custom-registration-form-builder-with-submission-manager'),
            'Asia/Kolkata' => __('Kolkata','custom-registration-form-builder-with-submission-manager'),
            'Asia/Krasnoyarsk' => __('Krasnoyarsk','custom-registration-form-builder-with-submission-manager'),
            'Asia/Kuala_Lumpur' => __('Kuala Lumpur','custom-registration-form-builder-with-submission-manager'),
            'Asia/Kuching' => __('Kuching','custom-registration-form-builder-with-submission-manager'),
            'Asia/Kuwait' => __('Kuwait','custom-registration-form-builder-with-submission-manager'),
            'Asia/Macau' => __('Macau','custom-registration-form-builder-with-submission-manager'),
            'Asia/Magadan' => __('Magadan','custom-registration-form-builder-with-submission-manager'),
            'Asia/Makassar' => __('Makassar','custom-registration-form-builder-with-submission-manager'),
            'Asia/Manila' => __('Manila','custom-registration-form-builder-with-submission-manager'),
            'Asia/Muscat' => __('Muscat','custom-registration-form-builder-with-submission-manager'),
            'Asia/Nicosia' => __('Nicosia','custom-registration-form-builder-with-submission-manager'),
            'Asia/Novokuznetsk' => __('Novokuznetsk','custom-registration-form-builder-with-submission-manager'),
            'Asia/Novosibirsk' => __('Novosibirsk','custom-registration-form-builder-with-submission-manager'),
            'Asia/Omsk' => __('Omsk','custom-registration-form-builder-with-submission-manager'),
            'Asia/Oral' => __('Oral','custom-registration-form-builder-with-submission-manager'),
            'Asia/Phnom_Penh' => __('Phnom Penh','custom-registration-form-builder-with-submission-manager'),
            'Asia/Pontianak' => __('Pontianak','custom-registration-form-builder-with-submission-manager'),
            'Asia/Pyongyang' => __('Pyongyang','custom-registration-form-builder-with-submission-manager'),
            'Asia/Qatar' => __('Qatar','custom-registration-form-builder-with-submission-manager'),
            'Asia/Qyzylorda' => __('Qyzylorda','custom-registration-form-builder-with-submission-manager'),
            'Asia/Rangoon' => __('Rangoon','custom-registration-form-builder-with-submission-manager'),
            'Asia/Riyadh' => __('Riyadh','custom-registration-form-builder-with-submission-manager'),
            'Asia/Sakhalin' => __('Sakhalin','custom-registration-form-builder-with-submission-manager'),
            'Asia/Samarkand' => __('Samarkand','custom-registration-form-builder-with-submission-manager'),
            'Asia/Seoul' => __('Seoul','custom-registration-form-builder-with-submission-manager'),
            'Asia/Shanghai' => __('Shanghai','custom-registration-form-builder-with-submission-manager'),
            'Asia/Singapore' => __('Singapore','custom-registration-form-builder-with-submission-manager'),
            'Asia/Taipei' => __('Taipei','custom-registration-form-builder-with-submission-manager'),
            'Asia/Tashkent' => __('Tashkent','custom-registration-form-builder-with-submission-manager'),
            'Asia/Tbilisi' => __('Tbilisi','custom-registration-form-builder-with-submission-manager'),
            'Asia/Tehran' => __('Tehran','custom-registration-form-builder-with-submission-manager'),
            'Asia/Thimphu' => __('Thimphu','custom-registration-form-builder-with-submission-manager'),
            'Asia/Tokyo' => __('Tokyo','custom-registration-form-builder-with-submission-manager'),
            'Asia/Ulaanbaatar' => __('Ulaanbaatar','custom-registration-form-builder-with-submission-manager'),
            'Asia/Urumqi' => __('Urumqi','custom-registration-form-builder-with-submission-manager'),
            'Asia/Ust-Nera' => __('Ust-Nera','custom-registration-form-builder-with-submission-manager'),
            'Asia/Vientiane' => __('Vientiane','custom-registration-form-builder-with-submission-manager'),
            'Asia/Vladivostok' => __('Vladivostok','custom-registration-form-builder-with-submission-manager'),
            'Asia/Yakutsk' => __('Yakutsk','custom-registration-form-builder-with-submission-manager'),
            'Asia/Yekaterinburg' => __('Yekaterinburg','custom-registration-form-builder-with-submission-manager'),
            'Asia/Yerevan' => __('Yerevan','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/Azores' => __('Azores','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/Bermuda' => __('Bermuda','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/Canary' => __('Canary','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/Cape_Verde' => __('Cape Verde','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/Faroe' => __('Faroe','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/Madeira' => __('Madeira','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/Reykjavik' => __('Reykjavik','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/South_Georgia' => __('South Georgia','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/Stanley' => __('Stanley','custom-registration-form-builder-with-submission-manager'),
            'Atlantic/St_Helena' => __('St Helena','custom-registration-form-builder-with-submission-manager'),
            'Australia/Adelaide' => __('Adelaide','custom-registration-form-builder-with-submission-manager'),
            'Australia/Brisbane' => __('Brisbane','custom-registration-form-builder-with-submission-manager'),
            'Australia/Broken_Hill' => __('Broken Hill','custom-registration-form-builder-with-submission-manager'),
            'Australia/Currie' => __('Currie','custom-registration-form-builder-with-submission-manager'),
            'Australia/Darwin' => __('Darwin','custom-registration-form-builder-with-submission-manager'),
            'Australia/Eucla' => __('Eucla','custom-registration-form-builder-with-submission-manager'),
            'Australia/Hobart' => __('Hobart','custom-registration-form-builder-with-submission-manager'),
            'Australia/Lindeman' => __('Lindeman','custom-registration-form-builder-with-submission-manager'),
            'Australia/Lord_Howe' => __('Lord Howe','custom-registration-form-builder-with-submission-manager'),
            'Australia/Melbourne' => __('Melbourne','custom-registration-form-builder-with-submission-manager'),
            'Australia/Perth' => __('Perth','custom-registration-form-builder-with-submission-manager'),
            'Australia/Sydney' => __('Sydney','custom-registration-form-builder-with-submission-manager'),
            'Europe/Amsterdam' => __('Amsterdam','custom-registration-form-builder-with-submission-manager'),
            'Europe/Andorra' => __('Andorra','custom-registration-form-builder-with-submission-manager'),
            'Europe/Athens' => __('Athens','custom-registration-form-builder-with-submission-manager'),
            'Europe/Belgrade' => __('Belgrade','custom-registration-form-builder-with-submission-manager'),
            'Europe/Berlin' => __('Berlin','custom-registration-form-builder-with-submission-manager'),
            'Europe/Bratislava' => __('Bratislava','custom-registration-form-builder-with-submission-manager'),
            'Europe/Brussels' => __('Brussels','custom-registration-form-builder-with-submission-manager'),
            'Europe/Bucharest' => __('Bucharest','custom-registration-form-builder-with-submission-manager'),
            'Europe/Budapest' => __('Budapest','custom-registration-form-builder-with-submission-manager'),
            'Europe/Busingen' => __('Busingen','custom-registration-form-builder-with-submission-manager'),
            'Europe/Chisinau' => __('Chisinau','custom-registration-form-builder-with-submission-manager'),
            'Europe/Copenhagen' => __('Copenhagen','custom-registration-form-builder-with-submission-manager'),
            'Europe/Dublin' => __('Dublin','custom-registration-form-builder-with-submission-manager'),
            'Europe/Gibraltar' => __('Gibraltar','custom-registration-form-builder-with-submission-manager'),
            'Europe/Guernsey' => __('Guernsey','custom-registration-form-builder-with-submission-manager'),
            'Europe/Helsinki' => __('Helsinki','custom-registration-form-builder-with-submission-manager'),
            'Europe/Isle_of_Man' => __('Isle of Man','custom-registration-form-builder-with-submission-manager'),
            'Europe/Istanbul' => __('Istanbul','custom-registration-form-builder-with-submission-manager'),
            'Europe/Jersey' => __('Jersey','custom-registration-form-builder-with-submission-manager'),
            'Europe/Kaliningrad' => __('Kaliningrad','custom-registration-form-builder-with-submission-manager'),
            'Europe/Kiev' => __('Kiev','custom-registration-form-builder-with-submission-manager'),
            'Europe/Lisbon' => __('Lisbon','custom-registration-form-builder-with-submission-manager'),
            'Europe/Ljubljana' => __('Ljubljana','custom-registration-form-builder-with-submission-manager'),
            'Europe/London' => __('London','custom-registration-form-builder-with-submission-manager'),
            'Europe/Luxembourg' => __('Luxembourg','custom-registration-form-builder-with-submission-manager'),
            'Europe/Madrid' => __('Madrid','custom-registration-form-builder-with-submission-manager'),
            'Europe/Malta' => __('Malta','custom-registration-form-builder-with-submission-manager'),
            'Europe/Mariehamn' => __('Mariehamn','custom-registration-form-builder-with-submission-manager'),
            'Europe/Minsk' => __('Minsk','custom-registration-form-builder-with-submission-manager'),
            'Europe/Monaco' => __('Monaco','custom-registration-form-builder-with-submission-manager'),
            'Europe/Moscow' => __('Moscow','custom-registration-form-builder-with-submission-manager'),
            'Europe/Oslo' => __('Oslo','custom-registration-form-builder-with-submission-manager'),
            'Europe/Paris' => __('Paris','custom-registration-form-builder-with-submission-manager'),
            'Europe/Podgorica' => __('Podgorica','custom-registration-form-builder-with-submission-manager'),
            'Europe/Prague' => __('Prague','custom-registration-form-builder-with-submission-manager'),
            'Europe/Riga' => __('Riga','custom-registration-form-builder-with-submission-manager'),
            'Europe/Rome' => __('Rome','custom-registration-form-builder-with-submission-manager'),
            'Europe/Samara' => __('Samara','custom-registration-form-builder-with-submission-manager'),
            'Europe/San_Marino' => __('San Marino','custom-registration-form-builder-with-submission-manager'),
            'Europe/Sarajevo' => __('Sarajevo','custom-registration-form-builder-with-submission-manager'),
            'Europe/Simferopol' => __('Simferopol','custom-registration-form-builder-with-submission-manager'),
            'Europe/Skopje' => __('Skopje','custom-registration-form-builder-with-submission-manager'),
            'Europe/Sofia' => __('Sofia','custom-registration-form-builder-with-submission-manager'),
            'Europe/Stockholm' => __('Stockholm','custom-registration-form-builder-with-submission-manager'),
            'Europe/Tallinn' => __('Tallinn','custom-registration-form-builder-with-submission-manager'),
            'Europe/Tirane' => __('Tirane','custom-registration-form-builder-with-submission-manager'),
            'Europe/Uzhgorod' => __('Uzhgorod','custom-registration-form-builder-with-submission-manager'),
            'Europe/Vaduz' => __('Vaduz','custom-registration-form-builder-with-submission-manager'),
            'Europe/Vatican' => __('Vatican','custom-registration-form-builder-with-submission-manager'),
            'Europe/Vienna' => __('Vienna','custom-registration-form-builder-with-submission-manager'),
            'Europe/Vilnius' => __('Vilnius','custom-registration-form-builder-with-submission-manager'),
            'Europe/Volgograd' => __('Volgograd','custom-registration-form-builder-with-submission-manager'),
            'Europe/Warsaw' => __('Warsaw','custom-registration-form-builder-with-submission-manager'),
            'Europe/Zagreb' => __('Zagreb','custom-registration-form-builder-with-submission-manager'),
            'Europe/Zaporozhye' => __('Zaporozhye','custom-registration-form-builder-with-submission-manager'),
            'Europe/Zurich' => __('Zurich','custom-registration-form-builder-with-submission-manager'),
            'Indian/Antananarivo' => __('Antananarivo','custom-registration-form-builder-with-submission-manager'),
            'Indian/Chagos' => __('Chagos','custom-registration-form-builder-with-submission-manager'),
            'Indian/Christmas' => __('Christmas','custom-registration-form-builder-with-submission-manager'),
            'Indian/Cocos' => __('Cocos','custom-registration-form-builder-with-submission-manager'),
            'Indian/Comoro' => __('Comoro','custom-registration-form-builder-with-submission-manager'),
            'Indian/Kerguelen' => __('Kerguelen','custom-registration-form-builder-with-submission-manager'),
            'Indian/Mahe' => __('Mahe','custom-registration-form-builder-with-submission-manager'),
            'Indian/Maldives' => __('Maldives','custom-registration-form-builder-with-submission-manager'),
            'Indian/Mauritius' => __('Mauritius','custom-registration-form-builder-with-submission-manager'),
            'Indian/Mayotte' => __('Mayotte','custom-registration-form-builder-with-submission-manager'),
            'Indian/Reunion' => __('Reunion','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Apia' => __('Apia','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Auckland' => __('Auckland','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Chatham' => __('Chatham','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Chuuk' => __('Chuuk','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Easter' => __('Easter','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Efate' => __('Efate','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Enderbury' => __('Enderbury','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Fakaofo' => __('Fakaofo','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Fiji' => __('Fiji','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Funafuti' => __('Funafuti','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Galapagos' => __('Galapagos','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Gambier' => __('Gambier','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Guadalcanal' => __('Guadalcanal','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Guam' => __('Guam','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Honolulu' => __('Honolulu','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Johnston' => __('Johnston','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Kiritimati' => __('Kiritimati','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Kosrae' => __('Kosrae','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Kwajalein' => __('Kwajalein','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Majuro' => __('Majuro','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Marquesas' => __('Marquesas','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Midway' => __('Midway','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Nauru' => __('Nauru','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Niue' => __('Niue','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Norfolk' => __('Norfolk','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Noumea' => __('Noumea','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Pago_Pago' => __('Pago Pago','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Palau' => __('Palau','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Pitcairn' => __('Pitcairn','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Pohnpei' => __('Pohnpei','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Port_Moresby' => __('Port Moresby','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Rarotonga' => __('Rarotonga','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Saipan' => __('Saipan','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Tahiti' => __('Tahiti','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Tarawa' => __('Tarawa','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Tongatapu' => __('Tongatapu','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Wake' => __('Wake','custom-registration-form-builder-with-submission-manager'),
            'Pacific/Wallis' => __('Wallis','custom-registration-form-builder-with-submission-manager'),
            'UTC' => __('UTC','custom-registration-form-builder-with-submission-manager'),
            'UTC-12' => __('UTC-12','custom-registration-form-builder-with-submission-manager'),
            'UTC-11.5' => __('UTC-11:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-11' => __('UTC-11','custom-registration-form-builder-with-submission-manager'),
            'UTC-10.5' => __('UTC-10:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-10' => __('UTC-10','custom-registration-form-builder-with-submission-manager'),
            'UTC-9.5' => __('UTC-9:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-9' => __('UTC-9','custom-registration-form-builder-with-submission-manager'),
            'UTC-8.5' => __('UTC-8:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-8' => __('UTC-8','custom-registration-form-builder-with-submission-manager'),
            'UTC-7.5' => __('UTC-7:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-7' => __('UTC-7','custom-registration-form-builder-with-submission-manager'),
            'UTC-6.5' => __('UTC-6:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-6' => __('UTC-6','custom-registration-form-builder-with-submission-manager'),
            'UTC-5.5' => __('UTC-5:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-5' => __('UTC-5','custom-registration-form-builder-with-submission-manager'),
            'UTC-4.5' => __('UTC-4:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-4' => __('UTC-4','custom-registration-form-builder-with-submission-manager'),
            'UTC-3.5' => __('UTC-3:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-3' => __('UTC-3','custom-registration-form-builder-with-submission-manager'),
            'UTC-2.5' => __('UTC-2:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-2' => __('UTC-2','custom-registration-form-builder-with-submission-manager'),
            'UTC-1.5' => __('UTC-1:30','custom-registration-form-builder-with-submission-manager'),
            'UTC-1' => __('UTC-1','custom-registration-form-builder-with-submission-manager'),
            'UTC-0.5' => __('UTC-0:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+0' => __('UTC+0','custom-registration-form-builder-with-submission-manager'),
            'UTC+0.5' => __('UTC+0:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+1' => __('UTC+1','custom-registration-form-builder-with-submission-manager'),
            'UTC+1.5' => __('UTC+1:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+2' => __('UTC+2','custom-registration-form-builder-with-submission-manager'),
            'UTC+2.5' => __('UTC+2:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+3' => __('UTC+3','custom-registration-form-builder-with-submission-manager'),
            'UTC+3.5' => __('UTC+3:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+4' => __('UTC+4','custom-registration-form-builder-with-submission-manager'),
            'UTC+4.5' => __('UTC+4:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+5' => __('UTC+5','custom-registration-form-builder-with-submission-manager'),
            'UTC+5.5' => __('UTC+5:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+5.75' => __('UTC+5:45','custom-registration-form-builder-with-submission-manager'),
            'UTC+6' => __('UTC+6','custom-registration-form-builder-with-submission-manager'),
            'UTC+6.5' => __('UTC+6:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+7' => __('UTC+7','custom-registration-form-builder-with-submission-manager'),
            'UTC+7.5' => __('UTC+7:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+8' => __('UTC+8','custom-registration-form-builder-with-submission-manager'),
            'UTC+8.5' => __('UTC+8:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+8.75' => __('UTC+8:45','custom-registration-form-builder-with-submission-manager'),
            'UTC+9' => __('UTC+9','custom-registration-form-builder-with-submission-manager'),
            'UTC+9.5' => __('UTC+9:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+10' => __('UTC+10','custom-registration-form-builder-with-submission-manager'),
            'UTC+10.5' => __('UTC+10:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+11' => __('UTC+11','custom-registration-form-builder-with-submission-manager'),
            'UTC+11.5' => __('UTC+11:30','custom-registration-form-builder-with-submission-manager'),
            'UTC+12' => __('UTC+12','custom-registration-form-builder-with-submission-manager'),
            'UTC+12.75' => __('UTC+12:45','custom-registration-form-builder-with-submission-manager'),
            'UTC+13' => __('UTC+13','custom-registration-form-builder-with-submission-manager'),
            'UTC+13.75' => __('UTC+13:45','custom-registration-form-builder-with-submission-manager'),
            'UTC+14' => __('UTC+14','custom-registration-form-builder-with-submission-manager')
        );
        parent::__construct($label, $name, $options, $properties);
    }

}
