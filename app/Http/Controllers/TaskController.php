<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\models\app;

use App\Http\Requests;

use App\Http\Resources\Task as TaskResource;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

               // Get articles
               $Tasks = app::orderBy('created_at', 'desc')->paginate(100);

               // Return collection of articles as a resource
               return new TaskResource($Tasks);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $abx = new app;

        //  $article->id = $request->input('article_id');
          $abx->username = $request->input('a');
          $abx->type = $request->input('b');
          $abx->details = $request->input('c');

          $abx->save();
         //     return new TaskResource($abx);



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
      

              $ert = app::findOrFail($id);

              //  $article->id = $request->input('article_id');
                $ert->username = $request->input('d');
                $ert->type = $request->input('e');
                $ert->details = $request->input('f');

                $ert->save();
              //      return new TaskResource($ert);
                
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        $article = app::findOrFail($id);

    $article->delete();
        //    return new TaskResource($article);
        


    }
}



