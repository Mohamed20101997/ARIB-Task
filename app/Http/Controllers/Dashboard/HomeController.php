<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\HomeImage;
use App\Models\Owners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    public function index()
    {
        $homes = Home::whenSearch(Request()->search)->paginate(5);
        return view('dashboard.homes.index',compact('homes'));
    }

    public function create()
    {
        $owners = Owners::where('state',1)->get();
        return view('dashboard.homes.create',compact('owners'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'country'  => 'required',
            'city'  => 'required',
            'rent_type'  => 'required',
            'cover'  => 'required|image',
            'images'  => 'required|array',
            'address'  => 'required',
            'floor'  => 'required',
            'number_of_bathroom'  => 'required',
            'number_of_bedroom'  => 'required',
            'number_of_beds'  => 'required',
            'owner_id'  => 'required|exists:owners,id',
        ]);

        try{
            DB::beginTransaction();

            if (!$request->has('state'))
                $request->request->add(['state' => 0]);
            else
                $request->request->add(['state' => 1]);

            if (!$request->has('reserved'))
                $request->request->add(['reserved' => 0]);
            else
                $request->request->add(['reserved' => 1]);

            if (!$request->has('garage'))
                $request->request->add(['garage' => 0]);
            else
                $request->request->add(['garage' => 1]);

            $data = $request->except('_token','images');


            if ($request->has('cover')) {
                $data['cover'] = uploadImage('public_uploads', $request->file('cover'));
            }

            $home = Home::create($data);

            if($home){
                if ($request->has('images')) {
                    foreach ($request->images  as $image){
                        $image_name = uploadImage('public_uploads', $image);
                        HomeImage::create([
                           'image' => $image_name,
                           'home_id' => $home->id
                        ]);
                    }

                }

            }


            DB::commit();
            session()->flash('success', 'تم الاضافه بنجاح');
            return redirect()->route('home.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $home = Home::find($id);

        $owners = Owners::where('state',1)->get();
        return view('dashboard.homes.edite',compact('owners','home'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'country'  => 'required',
            'city'  => 'required',
            'rent_type'  => 'required',
            'cover'  => 'image',
            'images'  => 'array',
            'address'  => 'required',
            'floor'  => 'required',
            'number_of_bathroom'  => 'required',
            'number_of_bedroom'  => 'required',
            'number_of_beds'  => 'required',
            'owner_id'  => 'required|exists:owners,id',
        ]);
        try{

            DB::beginTransaction();

            $home =  Home::find($id);

            if (!$request->has('state'))
                $request->request->add(['state' => 0]);
            else
                $request->request->add(['state' => 1]);

            if (!$request->has('reserved'))
                $request->request->add(['reserved' => 0]);
            else
                $request->request->add(['reserved' => 1]);

            if (!$request->has('garage'))
                $request->request->add(['garage' => 0]);
            else
                $request->request->add(['garage' => 1]);

            $data = $request->except('_token','images');


            if ($request->has('cover')) {
                remove_previous($home->cover);

                $data['cover'] = uploadImage('public_uploads', $request->file('cover'));
            }

            $home_update = $home->update($data);
            if($home_update){
                if ($request->has('images')) {

                    $home_image  = HomeImage::where('home_id', $id)->get();

                    if(count($home_image) > 0){
                        HomeImage::where('home_id', $id)->delete();

                        foreach ($home_image as $image){
                            remove_previous($image->image);
                        }
                    }

                    foreach ($request->images  as $image){
                        $image_name = uploadImage('public_uploads', $image);

                        HomeImage::create([
                            'image' => $image_name,
                            'home_id' => $id
                        ]);
                    }

                }

            }


            DB::commit();
            session()->flash('success', 'تم التحديث بنجاح');
            return redirect()->route('home.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $home =  Home::find($id);

            if(!$home)
            {
                return redirect()->back()->with(['error'=>'لا يوجد شقق']);
            }

            remove_previous($home->cover);

            $home->delete();

            $home_image  = HomeImage::where('home_id', $id)->get();

            if(count($home_image) > 0){
                foreach ($home_image as $image){
                    remove_previous($image->image);
                }

                HomeImage::where('home_id', $id)->delete();
            }

            DB::commit();

            session()->flash('success', 'تم الحذف بنجاح');
            return redirect()->route('home.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }
}
