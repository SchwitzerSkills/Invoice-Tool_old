<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class Image
{

    public function save(Request $request){

        $messages = [
            "mobileContract" => "Das Fileformat ist falsch! JPG, PNG, JPEG"
        ];

        try {
            $request->validate([
                "mobileContract" => "required|file|mimes:jpg,png,jpeg|max:5096",
            ], $messages);
        } catch (\Illuminate\Validation\ValidationException $th){
            return back()->with("error_message", $th->validator->errors()->messages()["mobileContract"][0]);
        }

        if ($request->file("mobileContract")->isValid()) {
            $originalName = $request->file("mobileContract")->getClientOriginalName();
            
            $filename = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file("mobileContract")->getClientOriginalExtension();
            $newFileName = $filename . "_" . time() . "." . $extension;

            $count = DB::table("mobileContracts")->where("handyOwner", $request->handyOwner)->count();
            
            if(!$count){
                $request->file("mobileContract")->storeAs("images", $newFileName, "public");

                DB::table("mobileContracts")->insert([
                    "handyOwner" => $request->handyOwner,
                    "imageName" => $newFileName,
                ]);
            } else {
                $oldImageName = DB::table("mobileContracts")->select("imageName")->where("handyOwner", $request->handyOwner)->get()->first()->imageName;

                DB::table("mobileContracts")->where("handyOwner", $request->handyOwner)->update([
                    "imageName" => $newFileName
                ]);

                Storage::purge($oldImageName);
                $request->file("mobileContract")->storeAs("images", $newFileName, "public");
            }

            return back()->with("success_message", "Vertrag wurde erfolgreich hochgeladen");
        }

        return back()->with("error_message", "Fehler beim Upload");
    }

    public function get($handyOwner) {
        $imageName = DB::table("mobileContracts")->select("imageName")->where("handyOwner", $handyOwner)->get()->first()->imageName;

        return array("imageName" => $imageName);
    }

}