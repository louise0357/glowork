<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class PositionController extends Controller


{    /** 
    * POSİTİONS START
    */

   public function Positionassign(Request $request)
   {
       $request->validate([
           'user_id' => 'required|exists:users,id',
           'position_id' => 'required|exists:positions,id',
       ]);

       $user = User::findOrFail($request->user_id);
       $user->position_id = $request->position_id;
       $user->save();

       return redirect()->back()->with('success', 'Position assigned successfully.');
   }


   public function Positionstore(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
       ]);

       Position::create([
           'name' => $request->name,
       ]);

       return redirect()->back()->with('success', 'Position assigned successfully.');
   }

   /** 
    * POSİTİONS FINISH
    */
}
