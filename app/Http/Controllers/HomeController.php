<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Todo;
use Response;
use Input;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Todo::where('user_id', Auth::id()) ->orderBy('updated_at', 'asc') -> paginate(7);
        return view('home')->with('data',$data);
    }


       public function search(Request $request)
    {
        if ($request->ajax()) {
            $output="";
            $data = Todo::where('name','LIKE','%'.$request->search.'%')
                         ->orWhere('desc','LIKE','%'.$request->search.'%')
                        ->orWhere('user_id','LIKE','%'.$request->search)
                        ->get();
            if ($data)

            {


               return $data->toJson();
            }
        }
    }

     public function save(Request $request)
    {
        $name = $request->input('name');
        $desc = $request->input('desc');
        $updated_at = Carbon::now();

        $insert = new Todo;
        $insert->name = $name;
        $insert->user_id = Auth::id();
        $insert->desc = $desc;
        $insert->save();

        $id = $insert->id;

        return response()->json([

                    'id'=> $id,
                    'name'=>$name,
                    'desc'=>$desc,
                    'complete'=>0,
                    'updated_at'=>$updated_at->diffForHumans(),


        ]);

    }


     public function edit(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');

        $insert = Todo::find($id);
        $insert->name = $name;
        $insert->desc = $desc;
        $insert->save();

        $id = $insert->id;

        return response()->json([

                    'id'=> $id,
                    'name'=>$name,
                    'desc'=>$desc,

        ]);

    }

    public function delete(Request $request)

    {
        $id = $request->input('id');


        $delete = Todo::find($id);
        $delete->delete();

         return response()->json([

                    'id'=> $id

        ]);


    }


    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        Todo::create([
            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect('home');
    }



     public function change(divid $request)
    {
        $id = $request->input('id');



        $data = Todo::find($id);
        $data->complete = !$data->complete;
        $data->save();

        $id = $insert->id;

        return response()->json([

                    'id'=> $id


        ]);

    }

}
