<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    private $sector;
    public function __construct(Sector $sector)
    {
        $this->sector = $sector;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = $this->sector->paginate(10);
        return view('sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_sectors = \App\Models\SubSector::pluck('name', 'id');
        return view('sectors.create', compact(['sub_sectors']));
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
            $sector = new Sector([
                'name' => $data['name'],
            ]);
            $sector->save();
            $sector->sub_sector()->attach($data['sub_sectors']);
            flash('Registro criado com sucesso')->success();
            return redirect()->route('sectors.index');
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
            $sector = $this->sector->findOrFail($id);
            // Retornar todos os subsetores cadastrados
            $sub_sectors = \App\Models\SubSector::pluck('name', 'id')->toArray();
            // Retornar as ids do subsetores selecionados
            $aux = $sector->sub_sector()->get();
            foreach ($aux as $key => $value) {
                $id = $value->toArray()['id'];
                $current[] = $id;
            }
            if (empty($current)) {
                $current = '';
            }
            return view('sectors.edit', compact(['sector', 'sub_sectors', 'current']));
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
            $sector = $this->sector->findOrFail($id);
            $sector->update($data);
            $sector->sub_sector()->sync($data['sub_sectors']);
            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('sectors.index');
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
            $sector = $this->sector->findOrFail($id);
            $sector->delete();

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('sectors.index');

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
