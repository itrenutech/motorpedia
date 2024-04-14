<?php

namespace App\Http\Controllers;

use App\Models\brands;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Exception;
use App\Models\models;

class ModelController extends Controller
{
    //
    public function Index()
    {
        try {
            $data = models::with(['getBrand'])->where('status', 1)->orderby('id', 'desc')->get();
            return view('Admin.Model.Index')->with(compact('data'));
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }

    public function Inactive()
    {
        $data = models::with(['getBrand'])->where('status', 0)->orderby('id', 'desc')->get();
        return view('Admin.Model.Inactive')->with(compact('data'));
    }

    public function Create(Request $req)
    {
        try {
            $brand = brands::where('status', 1)->orderBy('brand_name')->get();
            return view('Admin.Model.Create')->with(compact('brand'));
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }

    public function Submit(Request $req)
    {
        try {
            $req->validate([
                'brand_id' => 'required',
                'model_pic' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed,
                'model_name' => 'required'
            ]);
            $file = $req->file('model_pic');
            $slug = Str::slug($req->model_name);
            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $timestamp = now()->format('Y-m-d_H-i-s');
                $fileName = $timestamp . '_' . $slug . '.' . $extension;

                // Create a folder if it doesn't exist
                $folderPath = './models/';
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                // Move the file to the folder
                $file->move($folderPath, $fileName);
            } else {
                $fileName = '';
            }
            $form = [
                'brand_id' => $req->brand_id,
                'model_name' => $req->model_name,
                'model_pic' => $fileName,
                'slug' => $slug,
                'created_by' => Session::get('adminSession')['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1
            ];
            $val = models::insertGetId($form);
            if ($val == 0) {
                throw new Exception('Something worng in Model add');
            }
            return redirect()
                ->route("model.index")
                ->with("flash_message_success", "Model added successfully!!!");
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            )->withInput();
        }
    }

    public function Edit($id)
    {
        try {
            $brand = brands::where('status', 1)->orderBy('brand_name')->get();
            $data = models::where('status', 1)->where('id', $id)->first();
            return view('Admin.Model.Edit')->with(compact(['data', 'brand']));
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }

    public function Update(Request $req)
    {
        try {
            $req->validate([
                'brand_id' => 'required',
                'model_pic' => 'file|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed,
                'model_name' => 'required'
            ]);
            $file = $req->file('model_pic');
            $slug = Str::slug($req->model_name);
            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $timestamp = now()->format('Y-m-d_H-i-s');
                $fileName = $timestamp . '_' . $slug . '.' . $extension;

                // Create a folder if it doesn't exist
                $folderPath = './models/';
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                // Move the file to the folder
                $file->move($folderPath, $fileName);
            } else {
                $fileName = $req->pre_model_pic;
            }
            models::where('id', $req->mid)->update([
                'brand_id' => $req->brand_id,
                'model_name' => $req->model_name,
                'model_pic' => $fileName,
                'slug' => $slug,
                'modified_by' => Session::get('adminSession')['id'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()
                ->route("model.index")
                ->with("flash_message_success", "Model updated successfully!!!");
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }

    public function Destroy($id){
        try {
            $data = models::where('id', $id)->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'modified_by' => Session::get('adminSession')['id'],
                'status'=>0
            ]);
            return redirect()
                ->route("model.index")
                ->with("flash_message_warning", "Model deleted successfully!!!");
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }
    
    public function Active($id){ 
        try {
            $data = models::where('id', $id)->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'modified_by' => Session::get('adminSession')['id'],
                'status'=>1
            ]);
            return redirect()
                ->route("model.index")
                ->with("flash_message_success", "Model Active successfully!!!");
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }
}
