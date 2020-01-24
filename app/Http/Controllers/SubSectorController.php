<?php

namespace App\Http\Controllers;

use App\Models\SubSector;
use Illuminate\Http\Request;

class SubSectorController extends Controller
{
    private $subsector;
    public function __construct(SubSector $subsector)
    {
        $this->subsector = $subsector;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsectors = $this->subsector->paginate(10);
        return view('subsectors.index', compact('subsectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subsectors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $subsector = $this->subsector->create($data);
            flash('Registro criado com sucesso')->success();
            return redirect()->route('subsectors.index');
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }

            flash('Ocorreu um erro ao tentar salvar o registro!')->warning();
            return redirect()->back();
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
        try {
            $subsector = $this->subsector->findOrFail($id);
            return view('subsectors.edit', compact('subsector'));

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }

            flash('Registro não encontrado...')->warning();
            return redirect()->back();
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
        try {
            $data = $request->all();
            $subsector = $this->subsector->findOrFail($id);
            $subsector->update($data);
            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('subsectors.index');

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }
            flash('Registro não foi atualizado...')->warning();
            return redirect()->back();
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
            $subsector = $this->subsector->findOrFail($id);
            $subsector->delete();

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('subssector.index');

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }

            flash('Registro não pode ser removido...')->warning();
            return redirect()->back();
        }
    }
}
