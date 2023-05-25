<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UploadImageController extends Controller
{
    //
    public function uploadImage(Request $request)
    {
        $username = $_POST['User'];
        $password = $_POST['Password'];
        $comment = $_POST['Comment'];
        $file_name     = $_FILES["image"]["name"];
        $file_type     = $_FILES["image"]["type"];
        $file_size     = $_FILES["image"]["size"];
        $file_tmp_name = $_FILES["image"]["tmp_name"];
        $file_error    = $_FILES["image"]["error"];
        // Authenticate User
        $user = User::where('email', $username)
            ->orWhere('username', $username)->first();
        // Check if the user is outdated
        if (!empty($user)) {
            $date_expire = $user->expires;
            if (!empty($date_expire)) {
                $date_today = date("Y-m-d");
                if (strtotime($date_today) > strtotime($date_expire)) $user = "";
                }
            }// end if user not empty
        // check password
        if( $user && \Hash::check($password, $user->password)){
            // generate proper path for our user
            if ($user->username) {
                $datenow = date("dMYHis");
                $file_name = "IMG_".$datenow.'.jpg';
                $target_file = '/documents/users/'.$user->username;
                $path = Storage::disk('sam')->putFileAs($target_file, $request->file('image'), $file_name);
                // Let's make an entry in the database
                $document = new Document();
                $document->name = $comment;
                $document->path = 'users/'.$user->username.'/'.$file_name;
                $document->related_type = 'App\Models\User';
                $document->related_id = $user->id;
                $document->save();
                echo "file saved : OK/n";
                }// end username is defined
            else{
                echo "Username not yet configured .../n";
                }
            }// end user authenticated
        else{// user unknown
            // user NOT authenticated
            echo "Unknown user/password/n";
            }
    }// end function

    public function getFileFromStore($pathname, $filename)
    {
        $path='';
        if ($pathname == "userdocs") $path = '/documents/'.$filename;
        if ($pathname == "sampics") $path = '/utilities/software/SAMpics/'.$filename;
        if (!Storage::disk('sam')->exists($path)){
            abort(404);
            }
        $file = Storage::disk('sam')->get($path);
        $type = Storage::disk('sam')->mimeType($path);
        if ($pathname == "sampics") $type = 'application/vnd.android.package-archive';

        return response($file, 200)->header('Content-Type', $type);
    }


}//end class
