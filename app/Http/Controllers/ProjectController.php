<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Project;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_project)
    {
//        dd('dsvs');

//        if (Request::isMethod('get'))
//        {
//
//            dd('dsvs');
//        };
//        $data = $request->all();
        return view('projects.index')
            ->with('id_project', $id_project);

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...
            $user = Auth::user();
            $id_user = Auth::id();//
            $data = $request->all();
            $data = array_add($data,'id_user',$id_user);
//            dd($data);


            $this->validate($request, [

                'id_project' => 'required',

                'comment' => 'required',

            ]);

            $create = Comment::create($data);


            return response()->json($create);
        }
//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        dd('dddddddddddddddd');
//        $items = Comment::latest()->paginate(5);
//
//
//        $response = [
//
//            'pagination' => [
//
//                'total' => $items->total(),
//
//                'per_page' => $items->perPage(),
//
//                'current_page' => $items->currentPage(),
//
//                'last_page' => $items->lastPage(),
//
//                'from' => $items->firstItem(),
//
//                'to' => $items->lastItem()
//
//            ],
//
//            'data' => $items
//
//        ];
//        dd($id);
//        $phone = Comment::with('user')
//            ->where('id_project', 4)
//            ->get();
//        print('<pre>');
//        print_r($phone[0]['user']['name']);
//        die();

        $projects = Project::get();

        $comments = Comment::with('user')
        ->where('id_project', $id)
            ->get();

//        dd($comments);

        $response = [
            'projects' => $projects,
            'data' => $comments
        ];


        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'id_comment' => 'required',

            'comment' => 'required',

        ]);


        $edit = Comment::find($id)->update($request->all());


        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_comment = $id;
//        dd($id_comment);

        Comment::find($id)->delete();

        return response()->json(['done']);

    }
}
