<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
class ApiController extends Controller
{
    public function jsonManipulate(){
        
        $jsonDataOrder = '
        {
            "status":1,
            "message":"Data Successfuly Retrieved.",
            "data":[
               {
                  "name":"anwar",
                  "email":"anwar@mail.com",
                  "booking":{
                     "booking_number":"101000103066",
                     "book_date":"2022-03-12",
                     "workshop":{
                        "code":"01000",
                        "name":"Wahana Honda Gunung Sahari"
                     },
                     "motorcycle":{
                        "name":"NEW CB150R STREETFIRE",
                        "ut_code":"H5C02R20S1 M/T"
                     }
                  }
               },
               {
                  "name":"heru",
                  "email":"heru@gmail.com",
                  "booking":{
                     "booking_number":"10100062661",
                     "book_date":"2022-06-09",
                     "workshop":{
                        "code":"11497",
                        "name":"AHASS KAWI Indah Jaya Motor 3"
                     },
                     "motorcycle":{
                        "name":"BEAT SPORTY CBS MMC",
                        "ut_code":"HH1B02N41S1 A/T"
                     }
                  }
               },
               {
                  "name":"bayu",
                  "email":"bayu@yahoo.com",
                  "booking":{
                     "booking_number":"100190109431",
                     "book_date":"2022-06-10",
                     "workshop":{
                        "code":"17236",
                        "name":"AHASS MEGATAMA MOTOR"
                     },
                     "motorcycle":{
                        "name":"BEAT POP ESP CW COMIC",
                        "ut_code":"Y1G02N02L1A A/T"
                     }
                  }
               },
               {
                  "name":"santoso",
                  "email":"santoso@microsoft.com",
                  "booking":{
                     "booking_number":"101000109430",
                     "book_date":"2022-03-12",
                     "workshop":{
                        "code":"07577",
                        "name":"AHASS TUNGGAL JAYA"
                     },
                     "motorcycle":{
                        "name":"BLADE S",
                        "ut_code":"NF11C1CD M/T"
                     }
                  }
               },
               {
                  "name":"ilyas",
                  "email":"ilyas@gmail.com",
                  "booking":{
                     "booking_number":"117236109426",
                     "book_date":"2022-06-08",
                     "workshop":{
                        "code":"00190",
                        "name":"Dunia Motor Kebayoran Lama"
                     },
                     "motorcycle":{
                        "name":"NEW BEAT CAST WHEEL",
                        "ut_code":"NC11B3C2A/T"
                     }
                  }
               },
               {
                  "name":"kibo",
                  "email":"kibo@gmail.com",
                  "booking":{
                     "booking_number":"117550109401",
                     "book_date":"2022-05-10",
                     "workshop":{
                        "code":"11497",
                        "name":"AHASS KAWI Indah Jaya Motor 3"
                     },
                     "motorcycle":{
                        "name":"BEAT STREET",
                        "ut_code":"D1I02N27M1 A/T"
                     }
                  }
               },
               {
                  "name":"ilyas",
                  "email":"ilyas@gmail.com",
                  "booking":{
                     "booking_number":"117550109404",
                     "book_date":"2022-06-08",
                     "workshop":{
                        "code":"00190",
                        "name":"Dunia Motor Kebayoran Lama"
                     },
                     "motorcycle":{
                        "name":"REVO FIT JKT",
                        "ut_code":"R2B02K01S1K M/T"
                     }
                  }
               }
            ]
         }
        ';

        $jsonDatashowroom = '
        {
            "status":1,
            "message":"Data Successfuly Retrieved.",
            "data":[
               {
                  "code":"01000",
                  "name":"Wahana Honda Gunung Sahari",
                  "address":"Jalan Gunung Sahari",
                  "phone_number":"085800000000",
                  "distance":5.2
               },
               {
                  "code":"11497",
                  "name":"AHASS KAWI Indah Jaya Motor 3",
                  "address":"Jakarta Pusat",
                  "phone_number":"085300000000",
                  "distance":10.3
               },
               {
                  "code":"00190",
                  "name":"Dunia Motor Kebayoran Lama",
                  "address":"Kebayoran Lama, Jakarta Selatan",
                  "phone_number":"085600000000",
                  "distance":2.5
               },
               {
                  "code":"07577",
                  "name":"AHASS TUNGGAL JAYA",
                  "address":"Jakarta Timur",
                  "phone_number":"085200000000",
                  "distance":11.5
               }
            ]
         }';

        $dataOrder = json_decode($jsonDataOrder, true);
        $datashowroom = json_decode($jsonDatashowroom, true);
        
        $showroomMapping = [];
        foreach ($datashowroom['data'] as $workshopData) {
            $showroomMapping[$workshopData['code']] = [
                'ahass_name' => $workshopData['name'],
                'ahass_address' => $workshopData['address'],
                'ahass_contact' => $workshopData['phone_number'],
                'ahass_distance' => $workshopData['distance'],
            ];
        }

        $transformedData = [];
        foreach ($dataOrder['data'] as $bookingData) {
            $showroomCode = $bookingData['booking']['workshop']['code'];
            $bookingNumber = $bookingData['booking']['booking_number'];

            if (isset($showroomMapping[$showroomCode])) {
                $showroomInfo = $showroomMapping[$showroomCode];
            } else {
                $showroomInfo = [
                  'ahass_name' => $workshopData['name'],
                  'ahass_address' => '',
                  'ahass_contact' => '',
                  'ahass_distance' => 0,
                ];
            }

            $transformedEntry = [
                'name' => $bookingData['name'],
                'email' => $bookingData['email'],
                'booking_number' => $bookingNumber,
                'book_date' => $bookingData['booking']['book_date'],
                'ahass_code' => $showroomCode,
                'ahass_name' => $showroomInfo['ahass_name'],
                'ahass_address' => $showroomInfo['ahass_address'],
                'ahass_contact' => $showroomInfo['ahass_contact'],
                'ahass_distance' => $showroomInfo['ahass_distance'],
                'motorcycle_ut_code' => $bookingData['booking']['motorcycle']['ut_code'],
                'motorcycle' => $bookingData['booking']['motorcycle']['name'],
            ];

            $transformedData[] = $transformedEntry;
        }

        usort($transformedData, function ($a, $b) {
            return $a['ahass_distance'] - $b['ahass_distance'];
        });

        $response = [
            'status' => 1,
            'message' => 'Data Successfully Retrieved.',
            'data' => $transformedData,
        ];

      //   $metadata = [
      //       'message' => 'Sukses',
      //       'code' => 200
      //   ];
        return response()->json(['response' => $response]);
    }
}
