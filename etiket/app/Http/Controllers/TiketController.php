<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TiketController extends Controller
{

    public function get(Request $request, $limit = 10){
        $headerContent = $request->header("Content-Type");
        $headerKey = $request->header("X-API-KEY");

        if (($headerKey == "R@h4s14") && ($headerContent == "application/json")) {
            $tiket = Tiket::limit($limit)->get();
            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["tiket" => $tiket]
            ];
            return response()->json($arr,202);
        }
        $arr = [
            "code" => "406",
            "status" => "Not acceptable response",
        ];
        return response()->json($arr,406);
    }

    public function save(Request $request){
        $headerContent = $request->header("Content-Type");
        $headerKey = $request->header("X-API-KEY");

        if (($headerKey == "R@h4s14") && ($headerContent == "application/json")) {
            $request["priority"] = ucfirst($request["priority"]);
            $validator = Validator::make($request->all(), [
                'subject' => 'required|max:100',
                'message' => 'required',
                "priority" => "required|in:Low,High,Medium"
            ]);
    
    
            if ($validator->fails()) {
                
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" => $validator->errors()]
                ];
                return response()->json($arr,404);
            }
            $validated = $validator->validated();
            $validated["id"] = Str::uuid()->toString();
            $validated["tiket_number"] = time().Str::random(5);
            $validated["status"] = "Open";
            
            $tiket =  Tiket::create($validated);
            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["tiket" => $validated, "message" => "Tiket has been created"]
            ];
            return response()->json($arr,202);
        }
        $arr = [
            "code" => "406",
            "status" => "Not acceptable response",
        ];
        return response()->json($arr,406);
        
    }

    public function reply(Request $request){
        $headerContent = $request->header("Content-Type");
        $headerKey = $request->header("X-API-KEY");
        if (($headerKey == "R@h4s14") && ($headerContent == "application/json")) {
            $validator = Validator::make($request->all(), [
                'message' => 'required',
                "tiket_number" => "required|min:15|max:15"
            ]);
            if ($validator->fails()) {
                
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" => $validator->errors()]
                ];
                return response()->json($arr,404);
            }
            $validated = $validator->validated();

            $tiket = Tiket::where('tiket_number',"=", $validated["tiket_number"])->first();
            
            if ($tiket == null) {
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" => "Tiket not found in list"]
                ];
                return response()->json($arr,404);
            }
            $tiket["status"] = "Answered";
            $tiket->save();
            
            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["tiket" => $tiket, "message" => "Status tiket change to answered"]
            ];
            return response()->json($arr,202);
        }
        $arr = [
            "code" => "406",
            "status" => "Not acceptable response",
        ];
        return response()->json($arr,406);
    }

    public function closed(Request $request){
        $headerContent = $request->header("Content-Type");
        $headerKey = $request->header("X-API-KEY");

        if (($headerKey == "R@h4s14") && ($headerContent == "application/json")) {
            $validator = Validator::make($request->all(), [
                "tiket_number" => "required|min:15|max:15"
            ]);
            if ($validator->fails()) {
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" => $validator->errors()]
                ];
                return response()->json($arr,404);
            }
            $validated = $validator->validated();

            $tiket = Tiket::where('tiket_number',"=", $validated["tiket_number"])->first();
            
            if ($tiket == null) {
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" => "Tiket not found in list"]
                ];
                return response()->json($arr,404);
            }
            $tiket["status"] = "Closed";
            $tiket->save();

            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["tiket" => $tiket, "message" => "Status tiket change to closed"]
            ];
            return response()->json($arr,202);
        }
        $arr = [
            "code" => "406",
            "status" => "Not acceptable response",
        ];
        return response()->json($arr,406);
    }
    
    public function delete(Request $request){
        $headerContent = $request->header("Content-Type");
        $headerKey = $request->header("X-API-KEY");
        
        if (($headerKey == "R@h4s14") && ($headerContent == "application/json")) {
            $validator = Validator::make($request->all(), [
                "id" => "required|min:36|max:36"
            ]);
            if ($validator->fails()) {
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" => $validator->errors()]
                ];
                return response()->json($arr,404);
            }
            $validated = $validator->validated();

            $tiket = Tiket::find($validated["id"]);
            
            if ($tiket == null) {
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" =>"Tiket not found in list"]
                ];
                return response()->json($arr,404);
            }
            $tiket->delete();

            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["message" => "Tiket has been removed"]
            ];
            return response()->json($arr,202);
        }
        $arr = [
            "code" => "406",
            "status" => "Not acceptable response",
        ];
        return response()->json($arr,406);
    }

}
