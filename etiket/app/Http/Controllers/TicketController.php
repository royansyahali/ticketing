<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{

    public function get(Request $request, $limit = 10){
        $headerContent = $request->header("Content-Type");
        $headerKey = $request->header("X-API-KEY");

        if (($headerKey == "R@h4s14") && ($headerContent == "application/json")) {
            $ticket = Ticket::limit($limit)->get();
            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["tickets" => $ticket]
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
            $request["priority"] = ucfirst(strtolower(($request["priority"])));
            $validator = Validator::make($request->all(), [
                'subject' => 'required|max:50',
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
            $validated["ticket_number"] = time().Str::random(5);
            $validated["status"] = "Open";
            
            $ticket =  Ticket::create($validated);
            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["ticket" => $validated, "message" => "Ticket has been created"]
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
                "ticket_number" => "required|min:15|max:15"
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

            $ticket = Ticket::where('ticket_number',"=", $validated["ticket_number"])->first();
            
            if ($ticket == null) {
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" => "Ticket not found in list"]
                ];
                return response()->json($arr,404);
            }
            $ticket["status"] = "Answered";
            $ticket["message"] = $validated["message"];
            $ticket->save();
            
            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["ticket" => $ticket, "message" => "Status ticket change to answered"]
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
                "ticket_number" => "required|min:15|max:15"
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

            $ticket = Ticket::where('ticket_number',"=", $validated["ticket_number"])->first();
            
            if ($ticket == null) {
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" => "Ticket not found in list"]
                ];
                return response()->json($arr,404);
            }
            $ticket["status"] = "Closed";
            $ticket->save();

            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["ticket" => $ticket, "message" => "Status ticket change to closed"]
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

            $ticket = Ticket::find($validated["id"]);
            
            if ($ticket == null) {
                $arr = [
                    "code" => "404",
                    "status" => "Bad Request",
                    "data" => ["message" =>"Ticket not found in list"]
                ];
                return response()->json($arr,404);
            }
            $ticket->delete();

            $arr = [
                "code" => "202",
                "status" => "Accepted",
                "data" => ["message" => "Ticket has been removed"]
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
