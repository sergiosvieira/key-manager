<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\Sector;
use App\Models\SectorSubSector;
use App\Models\SubSector;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    private $key;
    public function __construct(Key $key)
    {
        $this->key = $key;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keys = $this->key->paginate(10);
        $sector_sub_sectors = \App\Models\SectorSubSector::all();
        $sectors = Sector::pluck('name', 'id');
        $sub_sectors = SubSector::pluck('name', 'id');
        // dd($sector_sub_sectors);
        return view('keys.index', compact(['keys', 'sector_sub_sectors', 'sectors', 'sub_sectors']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = \App\Models\Sector::pluck('name', 'id');
        $sub_sectors = \App\Models\SubSector::pluck('name', 'id');
        return view('keys.create', compact(['sectors', 'sub_sectors']));
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
            $key = new Key([
                'name' => $data['name'],
                'sector_id' => $data['sector_id'],
                'sub_sector_id' => $data['sub_sector_id'],
                'available' => true,

            ]);
            $key->save();
            flash('Registro criado com sucesso')->success();
            return redirect()->route('keys.index');
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
            $key = $this->key->findOrFail($id);
            $sector_sub_sector = App\Models\SectorSubSector::findOrFail($key->sector_subsector_id);
            $sector = App\Models\Sector::findOrFail($sector_sub_sector->sector_id)->name;
            $sub_sector = App\Models\SubSector::findOrFail($sector_sub_sector->sub_sector_id)->name;
            return view('keys.edit', compact(['key', 'sector', 'sub_sector']));
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
            $key = $this->key->findOrFail($id);
            $key->update($data);
            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('keys.index');
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
            $key = $this->key->findOrFail($id);
            $key->delete();
            flash('Registro removido com sucesso!')->success();
            return redirect()->route('keys.index');

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
