<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Helpers\JsonFormatter;
use Illuminate\Http\Request;
use Exception;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::all();

        if ($data) {
            return JsonFormatter::createJson(200, 'Success', $data);
        } else {
            return JsonFormatter::createJson(400, 'Failed');
        }
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
        try{
            $request->validate([
                'title' => 'required',
                'author' => 'required',
                'page'  => 'required'
            ]);

            $book = Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'page'  => intval($request->page),
            ]);

            $data = Book::whereId($book->id)->get();

            if ($data) {
                return JsonFormatter::createJson(200, 'Success', $data);
            } else {
                return JsonFormatter::createJson(400, 'Failed');
            }
        } catch (Exception $error) {
            return JsonFormatter::createJson(400, 'Failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Book::whereId($id)->get();

        if ($data) {
            return JsonFormatter::createJson(200, 'Success', $data);
        } else {
            return JsonFormatter::createJson(400, 'Failed');
        }
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
        try{
            $request->validate([
                'title' => 'required',
                'author' => 'required',
                'page'  => 'required'
            ]);

            $book = Book::findOrFail($id);

            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'page'  => intval($request->page),
            ]);

            $data = Book::whereId($id)->get();

            if ($data) {
                return JsonFormatter::createJson(200, 'Success', $data);
            } else {
                return JsonFormatter::createJson(400, 'Failed');
            }
        } catch (Exception $error) {
            return JsonFormatter::createJson(400, 'Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
        
            $data = $book->delete();
    
            if ($data) {
                return JsonFormatter::createJson(200, 'Delete Success'
            );
            } else {
                return JsonFormatter::createJson(400, 'Failed');
            }
        } catch (Exception $error) {
            return JsonFormatter::createJson(400, 'Failed');
        }
    }
}
