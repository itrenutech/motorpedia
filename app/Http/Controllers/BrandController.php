<?php

namespace App\Http\Controllers;

use App\Models\brands;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Exception;

class BrandController extends Controller
{
    //
    public function Index()
    {
        $data = brands::where('status', 1)->get();
        return view('Admin.Brand.Index')->with(compact('data'));
    }

    public function Inactive()
    {
        $data = brands::where('status', 0)->get();
        return view('Admin.Brand.Inactive')->with(compact('data'));
    }

    public function Create()
    {
        return view('Admin.Brand.Create');
    }

    public function Submit(Request $req)
    {
        try {
            $req->validate([
                'brand_logo' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed,
                'brand_name' => 'required'
            ]);
            $slug = str::slug($req->brand_name);
            $timestamp = now()->format('Y-m-d_H-i-s');
            $fileName = $timestamp . '_' . $slug;
            if ($req->file('brand_logo')->isValid()) {
                $file = $req->file('brand_logo');
                $file->move(public_path('brand'), $fileName);
            }
            $form = [
                'brand_name' => $req->brand_name,
                'brand_logo' => $fileName,
                'slug' => $slug,
                'created_by' => Session::get('adminSession')['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1
            ];
            $val = Brands::insertGetId($form);
            if ($val == 0) {
                throw new Exception('Something worng in brand add');
            }
            return redirect()
                ->route("brand.index")
                ->with("flash_message_success", "Brand added successfully!!!");
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }

    public function Edit($id)
    {
        try {
            $data = brands::where('status', 1)->where('id', $id)->first();
            return view('Admin.Brand.Edit')->with(compact('data'));
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
                'brand_name' => 'required',
                'brand_logo' => 'file|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $slug = str::slug($req->brand_name);
            if ($req->hasFile('brand_logo')) {
                if ($req->file('brand_logo')->isValid()) {
                    $timestamp = now()->format('Y-m-d_H-i-s');
                    $fileName = $timestamp . '_' . $slug;
                }
            } else {
                $fileName = $req->pre_brand_logo;
            }

            if ($fileName == '') {
                throw new Exception('Image is missing');
            }

            $data = brands::where('id', $req->bid)->update([
                'brand_name' => $req->brand_name,
                'slug' => $slug,
                'brand_logo' => $fileName,
                'updated_at' => date('Y-m-d H:i:s'),
                'modified_by' => Session::get('adminSession')['id']
            ]);
            return redirect()
                ->route("brand.index")
                ->with("flash_message_success", "Brand updated successfully!!!");
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            )->withInput();
        }
    }

    public function Destroy($id){
        try {
            $data = brands::where('id', $id)->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'modified_by' => Session::get('adminSession')['id'],
                'status'=>0
            ]);
            return redirect()
                ->route("brand.index")
                ->with("flash_message_warning", "Brand deleted successfully!!!");
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }

    public function Active($id){ 
        try {
            $data = brands::where('id', $id)->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'modified_by' => Session::get('adminSession')['id'],
                'status'=>1
            ]);
            return redirect()
                ->route("brand.index")
                ->with("flash_message_success", "Brand Active successfully!!!");
        } catch (Exception $ex) {
            return \Redirect::back()->with(
                "error",
                $ex->getMessage()
            );
        }
    }
}
