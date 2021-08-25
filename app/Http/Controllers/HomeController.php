<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SportCenter;
use App\Models\Images;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $centers = SportCenter::where('user_id', Auth::id())->get();

        return view('home', [
            'center' => $centers,
            // 'name' => $centers->name,
            // 'description' => $centers->description,
            // 'address' => $centers->address,
        ]);
    }
    public function add_center()
    {
        return view('create');
    }
    public function show($id)
    {
        $centers = SportCenter::find($id);
        // return $centers->Images;

        return view('show', [
            'id' => $centers->id,
            'name' => $centers->name,
            'description' => $centers->description,
            'address' => $centers->address,
            'images' => $centers->Images,
        ]);
    }

    public function fetch_image(Request $request)
    {

        $centers = SportCenter::find($request->input('center_id'));
        $images = $centers->images;

        if (count($images) > 0) {
            return response()->json($images, 201);
        }
        return response()->json(['message' => "No Images Found"], 404);
    }
    public function add(Request $request)
    {

        $center = new SportCenter;

        $center->user_id = Auth::id();
        $center->name = $request->name;
        $center->description = $request->description;
        $center->address = $request->address;
        $center->save();

        if (count($request->document) > 0) {

            foreach ($request->document as $image) {
                $imageM = new Images();
                $imageM->user_id = Auth::id();
                $imageM->sport_center_id = $center->id;
                $imageM->name = $image;

                $imageM->save();
            }
            // return  1;
        }

        return redirect('/home');
    }
    public function delete(Request $request)
    {
        $filename =  $request->get('name');
        if ($request->input('type') && $request->input('type') == 'update') {
            Images::where('name', '=', $filename)->delete();
        }
        // $path=  storage_path('uploads/'). $filename;
        $path = storage_path('app/public/uploads/' . $filename);
        // Storage::delete('uploads/'. $filename);
        //  return $path;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => 'File Deleted']);
    }
    public function destroy($id)
    {
        $centers = SportCenter::find($id);
        $images = Images::where('sport_center_id', $id)->get();
        
        if (count($images) > 0) {
            foreach ($images as $image) {
                $filename =  $image->name;
                Images::where('name', '=', $filename)->delete();

                $path = storage_path('app/public/uploads/' . $filename);

                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
        $centers->delete();
        return redirect('/home');
    }
    public function edit($id)
    {
        $centers = SportCenter::find($id);
        // $image = Images::where('sport_center_id', $id)->get();
        return view('edit', [
            'images' => $centers->images,
            'center' => $centers,
        ]);
    }
    public function update(Request $request, $id)
    {

        $sportcenter = SportCenter::find($id);
        $sportcenter->name = $request->name;
        $sportcenter->description = $request->description;
        $sportcenter->address = $request->address;

        $sportcenter->save();

        if ($request->document && count($request->document) > 0) {

            foreach ($request->document as $image) {
                $imageM = new Images();
                $imageM->user_id = Auth::id();
                $imageM->sport_center_id = $sportcenter->id;
                $imageM->name = $image;

                $imageM->save();
            }
        }
        return redirect('home');
    }
    public function upload(Request $request)
    {
        if ($request->file('file')) {
            $filePath = $request->file('file');
            $fileName = $filePath->getClientOriginalName();
            $path = $request->file('file')->storeAs('uploads', $fileName, 'public');
        }
        return response()->json(['success' => $fileName]);
    }
    public function settings()
    {
        return view('setting');
    }

    public function changesetting(Request $request)
    {
        $user = Auth::user();
        if ($request->password != $request->password_confirmation) {
            return back()->with('error', 'Password Not Confirmed');
        }
        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }
        if ($request->name != "") {
            $user->Company_Name = $request->name;
        }
        $user->save();
        return redirect('home');
    }
}
