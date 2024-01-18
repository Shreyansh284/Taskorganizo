<?php

namespace App\Http\Controllers;

use App\Models\label;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class labelcontroller extends Controller
{
    public function addLabel(Request $request)
    {
        $userEmail = session()->get('email');
        $user = $this->getUserByEmail($userEmail);

        $label = new label;
        $label->user_id = $user->id;
        $label->label_name = $request->label_name;
        $label->save();

        return redirect('filterAndLabel');
    }
    static function getLabelsByEmail($email)
    {
        $user = User::where('email', $email)->first();
        $labels = label::where('user_id', $user->id)->get("label_name");
        return with($labels);
    }
    function updatelabel(Request $request, $user_id, $id)
    {
        $upadateTaskLabel = label::where('id', $id)->where('user_id', $user_id)->update(['label_name' => $request->label_name]);
        if ($upadateTaskLabel) {
            return response()->json(['message' => 'label Updated'], 200);
        } else {
            return response()->json(['message' => 'NOT FOUND'], 404);
        }
    }

    function deletelabel(Request $request, $user_id, $id)
    {
        $taskLabel = label::where('id', $id)->where('user_id', $user_id)->delete();
        if ($taskLabel) {
            return response()->json(['message' => 'label delete'], 200);
        } else {
            return response()->json(['message' => 'NOT FOUND'], 404);
        }
    }
    private function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }


}
