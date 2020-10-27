<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Persona;
use App\Solicitud;
use App\Laico;
use App\UbicacionActa;
use App\Acta;
use App\ActaBautizo;
use App\ActaConfirma;
use App\ActaMatrimonio;
use App\ActaDefuncion;
use App\Parroquia;
use App\Solicitud_Acta;

class ActaUsuarioController extends Controller
{

    public function homeUsuario()
    {
        $parroquias = \App\Parroquia::all();
        return view('UserViews.mainActas', ['parroquias' => $parroquias]);
    }


    public function crearActa(Request $request)
    {
        try {
            $Persona = new Persona;
            if ($request->has('nombrePadre')) {

                $Persona->Cedula = $request->numCedula;
                $Persona->Nombre = $request->nombre;
                $Persona->PrimerApellido = $request->apellido1;
                $Persona->SegundoApellido = $request->apellido2;

                $Persona->save();

                $Laico = new Laico;

                $Laico->IDPersona = $Persona->IDPersona;
                $Laico->IDTipo_Hijo = 2;
                $Laico->NombreMadre = $request->nombreMadre;
                $Laico->NombrePadre = $request->nombrePadre;
                $Laico->LugarNacimiento = $request->lugarNac;
                $Laico->FechaNacimiento = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaNac));

                $Laico->save();
            } else {

                $Persona->Cedula = $request->numCedula;
                $Persona->Nombre = $request->nombre;
                $Persona->PrimerApellido = $request->apellido1;
                $Persona->SegundoApellido = $request->apellido2;

                $Persona->save();


                $Laico = new Laico;

                $Laico->IDPersona = $Persona->IDPersona;
                $Laico->IDTipo_Hijo = 1;
                $Laico->NombreMadre = $request->nombreMadre;
                $Laico->LugarNacimiento = $request->lugarNac;
                $Laico->FechaNacimiento = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaNac));


                $Laico->save();
            }

            //------------------------------------------------------------------------------
            $Acta = new Acta;


            if ($request->has('checkBautizo') || $request->has('checkConfirma') || $request->has('checkMatrimonio') || $request->has('checkDefuncion')) {

                //------------------------------------------------------------------------------

                if ($request->has('checkBautizo')) {
                    $UbicacionActaB = new UbicacionActa;

                    $UbicacionActaB->Libro = $request->numLibroB;
                    $UbicacionActaB->Folio = $request->numFolioB;
                    $UbicacionActaB->Asiento = $request->numAsientoB;

                    $UbicacionActaB->save();

                    $ActaBautizo = new ActaBautizo;

                    if ($request->lugarBautizo != "") {
                        $ActaBautizo->LugarBautismo = $request->lugarBautizo;
                    } else {
                        $ActaBautizo->IDParroquiaBautismo = $request->parroquiaBautismo;
                    }
                    $ActaBautizo->FechaBautismo = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaBautizo));
                    $ActaBautizo->PadrinoBau1 = $request->nombreMadrinaB;
                    $ActaBautizo->PadrinoBau2 = $request->nombrePadrinoB;
                    $ActaBautizo->IDUbicacionActaBau = $UbicacionActaB->IDUbicacionActa;
                    $ActaBautizo->IDUserRegistra = Auth::user()->IDUser;
                    $ActaBautizo->IDParroquiaRegistra = Auth::user()->IDParroquia;
                    $ActaBautizo->save();

                    $Acta->IDBautismo = $ActaBautizo->IDBautismo;
                    //-------------------------------------------------------
                }

                if ($request->has('checkConfirma')) {
                    $UbicacionActaC = new UbicacionActa;

                    $UbicacionActaC->Libro = $request->numLibroC;
                    $UbicacionActaC->Folio = $request->numFolioC;
                    $UbicacionActaC->Asiento = $request->numAsientoC;
                    $UbicacionActaC->save();

                    $ActaConfirma = new ActaConfirma;

                    if ($request->lugarConfirma != "") {
                        $ActaConfirma->LugarConfirma = $request->lugarConfirma;
                    } else {
                        $ActaConfirma->IDParroquiaConfirma = $request->parroquiaConfirma;
                    }
                    $ActaConfirma->FechaConfirma = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaConfirma));
                    $ActaConfirma->PadrinoCon1 = $request->nombrePadrinoC1;
                    $ActaConfirma->IDUbicacionActaCon = $UbicacionActaC->IDUbicacionActa;
                    $ActaConfirma->IDUserRegistra = Auth::user()->IDUser;
                    $ActaConfirma->IDParroquiaRegistra = Auth::user()->IDParroquia;
                    $ActaConfirma->save();

                    $Acta->IDConfirma = $ActaConfirma->IDConfirma;
                }
                if ($request->has('checkMatrimonio')) {
                    $UbicacionActaM = new UbicacionActa;

                    $UbicacionActaM->Libro = $request->numLibroM;
                    $UbicacionActaM->Folio = $request->numFolioM;
                    $UbicacionActaM->Asiento = $request->numAsientoM;

                    $UbicacionActaM->save();

                    $ActaMatrimonio = new ActaMatrimonio;

                    if ($request->lugarMatrimonio != "") {
                        $ActaMatrimonio->LugarMatrimonio = $request->lugarMatrimonio;
                    } else {
                        $ActaMatrimonio->IDParroquiaMatrimonio = $request->parroquiaMatrimonio;
                    }
                    $ActaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaMatrimonio));
                    $ActaMatrimonio->NombreConyugue = $request->nombreConyuge;
                    $ActaMatrimonio->IDUbicacionActaMat = $UbicacionActaM->IDUbicacionActa;
                    $ActaMatrimonio->IDUserRegistra = Auth::user()->IDUser;
                    $ActaMatrimonio->IDParroquiaRegistra = Auth::user()->IDParroquia;
                    $ActaMatrimonio->save();

                    $Acta->IDMatrimonio = $ActaMatrimonio->IDMatrimonio;
                }
                if ($request->has('checkDefuncion')) {
                    $UbicacionActaD = new UbicacionActa;

                    $UbicacionActaD->Libro = $request->numLibroD;
                    $UbicacionActaD->Folio = $request->numFolioD;
                    $UbicacionActaD->Asiento = $request->numAsientoD;
                    $UbicacionActaD->save();

                    $ActaDefuncion = new ActaDefuncion;

                    if ($request->lugarDefuncion != "") {
                        $ActaDefuncion->LugarDefuncion = $request->lugarDefuncion;
                    } else {
                        $ActaDefuncion->IDParroquiaDefuncion = $request->parroquiaDefuncion;
                    }
                    $ActaDefuncion->LugarDefuncion = $request->lugarDefuncion;
                    $ActaDefuncion->FechaDefuncion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaDefuncion));
                    $ActaDefuncion->CausaMuerte = $request->causaDefuncion;
                    $ActaDefuncion->IDUbicacionActaDef = $UbicacionActaD->IDUbicacionActa;
                    $ActaDefuncion->IDUserRegistra = Auth::user()->IDUser;
                    $ActaDefuncion->IDParroquiaRegistra = Auth::user()->IDParroquia;
                    $ActaDefuncion->save();

                    $Acta->IDDefuncion = $ActaDefuncion->IDDefuncion;
                }
                if ($request->has('notasMarginales')) {
                    $Acta->NotasMarginales = $request->notasMarginales;
                }
            }//fin if acta

            $Acta->IDPersona = $Persona->IDPersona;
            $Acta->save();

            return back()->with('msjBueno', "Se agregó el acta correctamente");

        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error. Intente nuevamente!");
        }
    }


    public function EditarActa($id)
    {
        try {
            $acta = null;
            $persona = null;
            $source = 'consulta';
            $isEditableArray = array(true, true, true, true);
            $usuarioParroquia = Auth::user()->IDParroquia;
            if ($source == 'notificaciones') {
                $sol_acta = \App\Solicitud_Acta::find($id);
                $acta = Acta::find($sol_acta->IDActa);
                $persona = Persona::findOrFail($acta->persona->IDPersona);
            } else {
                $acta = Acta::where('IDPersona', $id)->first();
                $persona = Persona::findOrFail($id);
            }
            $parroquias = \App\Parroquia::all();

            $idBautismo = $acta->IDBautismo;
            $idConfirma = $acta->IDConfirma;
            $idMatrimonio = $acta->IDMatrimonio;
            $idDefuncion = $acta->IDDefuncion;

            $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
            $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
            $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
            $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();

            # bautismo
            $idUbicacionActaBau = null;
            $UbicacionActaBautismo = null;
            if ($idBautismo != null) {
                $idUbicacionActaBau = $actaBautismo->IDUbicacionActaBau;
                $UbicacionActaBautismo = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaBau)->first();
                if ($actaBautismo->IDParroquiaRegistra != $usuarioParroquia) {
                    if ($actaBautismo->IDParroquiaBautismo != null) {
                        $parroquia = Parroquia::find($actaBautismo->IDParroquiaBautismo);
                        $actaBautismo->LugarBautismo = $parroquia->NombreParroquia;
                    }
                    $date = date('d/m/Y', strtotime($actaBautismo->FechaBautismo));
                    $actaBautismo->FechaBautismo = $date;
                    $isEditableArray[0] = false;
                }
            }

            # confirma
            $idUbicacionActaCon = null;
            $UbicacionActaConfirma = null;
            if ($idConfirma != null) {
                $idUbicacionActaCon = $actaConfirma->IDUbicacionActaCon;
                $UbicacionActaConfirma = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaCon)->first();
                if ($actaConfirma->IDParroquiaRegistra != $usuarioParroquia) {
                    if ($actaConfirma->IDParroquiaConfirma != null) {
                        $parroquia = Parroquia::find($actaConfirma->IDParroquiaConfirma);
                        $actaConfirma->LugarConfirma = $parroquia->NombreParroquia;
                    }
                    $date = date('d/m/Y', strtotime($actaConfirma->FechaConfirma));
                    $actaConfirma->FechaConfirma = $date;
                    $isEditableArray[1] = false;
                }
            }

            # matrimonio
            $idUbicacionActaMat = null;
            $UbicacionActaMatrimonio = null;
            if ($idMatrimonio != null) {
                $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                if ($actaMatrimonio->IDParroquiaRegistra != $usuarioParroquia) {
                    if ($actaMatrimonio->IDParroquiaMatrimonio != null) {
                        $parroquia = Parroquia::find($actaMatrimonio->IDParroquiaMatrimonio);
                        $actaMatrimonio->LugarMatrimonio = $parroquia->NombreParroquia;
                    }
                    $date = date('d/m/Y', strtotime($actaMatrimonio->FechaMatrimonio));
                    $actaMatrimonio->FechaMatrimonio = $date;
                    $isEditableArray[2] = false;
                }
            }

            # defuncion
            $idUbicacionActaDef = null;
            $UbicacionActaDefuncion = null;
            if ($idDefuncion != null) {
                $idUbicacionActaDef = $actaDefuncion->IDUbicacionActaDef;
                $UbicacionActaDefuncion = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaDef)->first();
                if ($actaDefuncion->IDParroquiaRegistra != $usuarioParroquia) {
                    if ($actaDefuncion->IDParroquiaDefuncion != null) {
                        $parroquia = Parroquia::find($actaDefuncion->IDParroquiaDefuncion);
                        $actaDefuncion->LugarDefuncion = $parroquia->NombreParroquia;
                    }
                    $date = date('d/m/Y', strtotime($actaDefuncion->FechaDefuncion));
                    $actaDefuncion->FechaDefuncion = $date;
                    $isEditableArray[3] = false;
                }
            }

            $laico = Laico::findOrFail($persona->IDPersona);

            return view('UserViews.editarActa', ['source' => $source, 'idSolicitud' => $id, 'persona' => $persona, 'laico' => $laico,
                'acta' => $acta, 'actaBautismo' => $actaBautismo, 'actaConfirma' => $actaConfirma, 'actaMatrimonio' => $actaMatrimonio,
                'actaDefuncion' => $actaDefuncion, 'UbicacionActaBautismo' => $UbicacionActaBautismo, 'UbicacionActaConfirma' => $UbicacionActaConfirma,
                'UbicacionActaMatrimonio' => $UbicacionActaMatrimonio, 'UbicacionActaDefuncion' => $UbicacionActaDefuncion, 'parroquias' => $parroquias,
                'isEditableArray' => $isEditableArray]);
        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error. Intente nuevamente!");
        }
    } // fin EditarActa


    public function actualizarActa(Request $request)
    {
        try {
            $id = $_POST['IDPersona'];

            $persona = Persona::find($id);
            $persona->Cedula = $request->numCedulaEdit;
            $persona->Nombre = $request->nombreEdit;
            $persona->PrimerApellido = $request->apellido1Edit;
            $persona->SegundoApellido = $request->apellido2Edit;
            $persona->save();

            $laico = Laico::find($id);
            $laico->IDTipo_Hijo = $request->tipoHijo;
            $laico->NombreMadre = $request->nombreMadreEdit;
            $laico->NombrePadre = $request->nombrePadreEdit;
            $laico->LugarNacimiento = $request->lugarNacEdit;
            $laico->FechaNacimiento = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaNacEdit));
            $laico->save();

            $acta = Acta::where('IDPersona', $id)->first();
            $acta->NotasMarginales = $request->notasMarginalesEdit;
            $idBautismo = $acta->IDBautismo;
            $idConfirma = $acta->IDConfirma;
            $idMatrimonio = $acta->IDMatrimonio;
            $idDefuncion = $acta->IDDefuncion;

            $usuarioParroquia = Auth::user()->IDParroquia;

            if ($idBautismo != null) {
                $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
                if ($actaBautismo->IDParroquiaRegistra == $usuarioParroquia) {
                    if ($request->parroquiaBautismo != 'otro') {
                        $actaBautismo->IDParroquiaBautismo = $request->parroquiaBautismo;
                        $actaBautismo->LugarBautismo = null;
                    } else {
                        $actaBautismo->IDParroquiaBautismo = null;
                        $actaBautismo->LugarBautismo = $request->lugarBautizo;
                    }
                    $actaBautismo->FechaBautismo = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaBautizo));
                    $actaBautismo->PadrinoBau1 = $request->nombreMadrinaB;
                    $actaBautismo->PadrinoBau2 = $request->nombrePadrinoB;
                    $actaBautismo->save();

                    $idUbicacionActaBau = $actaBautismo->IDUbicacionActaBau;
                    $UbicacionActaBautismo = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaBau)->first();
                    $UbicacionActaBautismo->Libro = $request->numLibroB;
                    $UbicacionActaBautismo->Folio = $request->numFolioB;
                    $UbicacionActaBautismo->Asiento = $request->numAsientoB;
                    $UbicacionActaBautismo->save();
                }
            } else if ($request->has('fechaBautizo')) {
                $UbicacionActaBautismo = new UbicacionActa;
                $UbicacionActaBautismo->Libro = $request->numLibroB;
                $UbicacionActaBautismo->Folio = $request->numFolioB;
                $UbicacionActaBautismo->Asiento = $request->numAsientoB;
                $UbicacionActaBautismo->save();

                $actaBautismo = new ActaBautizo;
                if ($request->has('parroquiaBautismo') && $request->parroquiaBautismo != 'otro') {
                    $actaBautismo->IDParroquiaBautismo = $request->parroquiaBautismo;
                } else {
                    $actaBautismo->LugarBautismo = $request->lugarBautizo;
                }
                $actaBautismo->FechaBautismo = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaBautizo));
                $actaBautismo->PadrinoBau1 = $request->nombreMadrinaB;
                $actaBautismo->PadrinoBau2 = $request->nombrePadrinoB;
                $actaBautismo->IDUbicacionActaBau = $UbicacionActaBautismo->IDUbicacionActa;
                $actaBautismo->IDUserRegistra = Auth::user()->IDUser;
                $actaBautismo->IDParroquiaRegistra = Auth::user()->IDParroquia;
                $actaBautismo->save();

                $acta->IDBautismo = $actaBautismo->IDBautismo;
            }

            if ($idConfirma != null) {
                $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
                if ($actaConfirma->IDParroquiaRegistra == $usuarioParroquia) {
                    if ($request->parroquiaConfirma != 'otro') {
                        $actaConfirma->IDParroquiaConfirma = $request->parroquiaConfirma;
                        $actaConfirma->LugarConfirma = null;
                    } else {
                        $actaConfirma->IDParroquiaConfirma = null;
                        $actaConfirma->LugarConfirma = $request->lugarConfirma;
                    }
                    $actaConfirma->FechaConfirma = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaConfirma));
                    $actaConfirma->PadrinoCon1 = $request->nombrePadrinoC1;
                    $actaConfirma->save();

                    $idUbicacionActaCon = $actaConfirma->IDUbicacionActaCon;
                    $UbicacionActaConfirma = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaCon)->first();
                    $UbicacionActaConfirma->Libro = $request->numLibroC;
                    $UbicacionActaConfirma->Folio = $request->numFolioC;
                    $UbicacionActaConfirma->Asiento = $request->numAsientoC;
                    $UbicacionActaConfirma->save();
                }
            } else if ($request->has('fechaConfirma') && $request->fechaConfirma != null) {
                $UbicacionActaConfirma = new UbicacionActa;
                $UbicacionActaConfirma->Libro = $request->numLibroC;
                $UbicacionActaConfirma->Folio = $request->numFolioC;
                $UbicacionActaConfirma->Asiento = $request->numAsientoC;
                $UbicacionActaConfirma->save();

                $actaConfirma = new ActaConfirma;
                if ($request->has('parroquiaConfirma') && $request->parroquiaConfirma != 'otro') {
                    $actaConfirma->IDParroquiaConfirma = $request->parroquiaConfirma;
                } else {
                    $actaConfirma->LugarConfirma = $request->lugarConfirma;
                }
                $actaConfirma->FechaConfirma = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaConfirma));
                $actaConfirma->PadrinoCon1 = $request->nombrePadrinoC1;
                $actaConfirma->IDUbicacionActaCon = $UbicacionActaConfirma->IDUbicacionActa;
                $actaConfirma->IDUserRegistra = Auth::user()->IDUser;
                $actaConfirma->IDParroquiaRegistra = Auth::user()->IDParroquia;
                $actaConfirma->save();

                $acta->IDConfirma = $actaConfirma->IDConfirma;
            }

            if ($idMatrimonio != null) {
                $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
                if ($actaMatrimonio->IDParroquiaRegistra == $usuarioParroquia) {
                    if ($request->parroquiaBautismo != 'otro') {
                        $actaMatrimonio->IDParroquiaMatrimonio = $request->parroquiaMatrimonio;
                        $actaMatrimonio->LugarMatrimonio = null;
                    } else {
                        $actaMatrimonio->IDParroquiaMatrimonio = null;
                        $actaMatrimonio->LugarMatrimonio = $request->lugarMatrimonio;
                    }
                    $actaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaMatrimonio));
                    $actaMatrimonio->NombreConyugue = $request->nombreConyuge;
                    $actaMatrimonio->save();

                    $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                    $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                    $UbicacionActaMatrimonio->Libro = $request->numLibroM;
                    $UbicacionActaMatrimonio->Folio = $request->numFolioM;
                    $UbicacionActaMatrimonio->Asiento = $request->numAsientoM;
                    $UbicacionActaMatrimonio->save();
                }
            } else if ($request->has('fechaMatrimonio') && $request->fechaMatrimonio != null) {
                $UbicacionActaMatrimonio = new UbicacionActa;
                $UbicacionActaMatrimonio->Libro = $request->numLibroM;
                $UbicacionActaMatrimonio->Folio = $request->numFolioM;
                $UbicacionActaMatrimonio->Asiento = $request->numAsientoM;
                $UbicacionActaMatrimonio->save();

                $actaMatrimonio = new ActaMatrimonio;
                if ($request->has('parroquiaMatrimonio') && $request->parroquiaMatrimonio != 'otro') {
                    $actaMatrimonio->IDParroquiaMatrimonio = $request->parroquiaMatrimonio;
                } else {
                    $actaMatrimonio->LugarMatrimonio = $request->lugarMatrimonio;
                }
                $actaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaMatrimonio));
                $actaMatrimonio->NombreConyugue = $request->nombreConyuge;
                $actaMatrimonio->IDUbicacionActaMat = $UbicacionActaMatrimonio->IDUbicacionActa;
                $actaMatrimonio->IDUserRegistra = Auth::user()->IDUser;
                $actaMatrimonio->IDParroquiaRegistra = Auth::user()->IDParroquia;
                $actaMatrimonio->save();

                $acta->IDMatrimonio = $actaMatrimonio->IDMatrimonio;
            }

            if ($idDefuncion != null) {
                $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();
                if ($actaDefuncion->IDParroquiaRegistra == $usuarioParroquia) {
                    if ($request->parroquiaDefuncion != 'otro') {
                        $actaDefuncion->IDParroquiaDefuncion = $request->parroquiaDefuncion;
                        $actaDefuncion->LugarDefuncion = null;
                    } else {
                        $actaDefuncion->IDParroquiaDefuncion = null;
                        $actaDefuncion->LugarDefuncion = $request->lugarDefuncion;
                    }
                    $actaDefuncion->FechaDefuncion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaDefuncion));
                    $actaDefuncion->CausaMuerte = $request->causaDefuncion;
                    $actaDefuncion->save();

                    $idUbicacionActaDef = $actaDefuncion->IDUbicacionActaDef;
                    $UbicacionActaDefuncion = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaDef)->first();
                    $UbicacionActaDefuncion->Libro = $request->numLibroD;
                    $UbicacionActaDefuncion->Folio = $request->numFolioD;
                    $UbicacionActaDefuncion->Asiento = $request->numAsientoD;
                    $UbicacionActaDefuncion->save();
                }
            } else if ($request->has('fechaDefuncion') && $request->fechaDefuncion != null) {
                $UbicacionActaDefuncion = new UbicacionActa;
                $UbicacionActaDefuncion->Libro = $request->numLibroD;
                $UbicacionActaDefuncion->Folio = $request->numFolioD;
                $UbicacionActaDefuncion->Asiento = $request->numAsientoD;
                $UbicacionActaDefuncion->save();

                $actaDefuncion = new ActaDefuncion;
                if ($request->has('parroquiaDefuncion') && $request->parroquiaDefuncion != 'otro') {
                    $actaDefuncion->IDParroquiaDefuncion = $request->parroquiaDefuncion;
                } else {
                    $actaDefuncion->LugarDefuncion = $request->lugarDefuncion;
                }
                $actaDefuncion->FechaDefuncion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaDefuncion));
                $actaDefuncion->CausaMuerte = $request->causaDefuncion;
                $actaDefuncion->IDUbicacionActaDef = $UbicacionActaDefuncion->IDUbicacionActa;
                $actaDefuncion->IDUserRegistra = Auth::user()->IDUser;
                $actaDefuncion->IDParroquiaRegistra = Auth::user()->IDParroquia;
                $actaDefuncion->save();

                $acta->IDDefuncion = $actaDefuncion->IDDefuncion;
            }

            $acta->save();
            return back()->with('msjBueno', "Se ha modificado la partida correctamente");

        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error al modificar la partida");
        }
    }//Fin actualizar acta


    public function DetalleActa($id)
    {
        try {
            $acta = Acta::where('IDPersona', $id)->first();

            $idBautismo = $acta->IDBautismo;
            $idConfirma = $acta->IDConfirma;
            $idMatrimonio = $acta->IDMatrimonio;
            $idDefuncion = $acta->IDDefuncion;

            $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
            $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
            $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
            $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();
            $laico = Laico::findOrFail($id);

            $date = $laico->FechaNacimiento;
            $laico->FechaNacimiento = $this->formatDateToString($date);

            if ($laico->IDTipo_Hijo == 1) {
                $tipoHijo = "Natural";
            } else {
                $tipoHijo = "Legítimo";
            }

            if ($idBautismo != null) {
                $idUbicacionActaBau = $actaBautismo->IDUbicacionActaBau;
                $date = $actaBautismo->FechaBautismo;
                $actaBautismo->FechaBautismo = $this->formatDatetoString($date);
                $UbicacionActaBautismo = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaBau)->first();
                if ($actaBautismo->IDParroquiaBautismo != null) {
                    $parroquia = Parroquia::find($actaBautismo->IDParroquiaBautismo);
                    $actaBautismo->LugarBautismo = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionActaBau = null;
                $UbicacionActaBautismo = null;
            }

            if ($idConfirma != null) {
                $idUbicacionActaCon = $actaConfirma->IDUbicacionActaCon;
                $date = $actaConfirma->FechaConfirma;
                $actaConfirma->FechaConfirma = $this->formatDatetoString($date);
                $UbicacionActaConfirma = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaCon)->first();
                if ($actaConfirma->IDParroquiaConfirma != null) {
                    $parroquia = Parroquia::find($actaConfirma->IDParroquiaConfirma);
                    $actaConfirma->LugarConfirma = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionActaCon = null;
                $UbicacionActaConfirma = null;
            }

            if ($idMatrimonio != null) {
                $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                $date = $actaMatrimonio->FechaMatrimonio;
                $actaMatrimonio->FechaMatrimonio = $this->formatDatetoString($date);
                $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                if ($actaMatrimonio->IDParroquiaMatrimonio != null) {
                    $parroquia = Parroquia::find($actaMatrimonio->IDParroquiaMatrimonio);
                    $actaMatrimonio->LugarMatrimonio = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionActaMat = null;
                $UbicacionActaMatrimonio = null;
            }

            if ($idDefuncion != null) {
                $idUbicacionActaDef = $actaDefuncion->IDUbicacionActaDef;
                $date = $actaDefuncion->FechaDefuncion;
                $actaDefuncion->FechaDefuncion = $this->formatDatetoString($date);
                $UbicacionActaDefuncion = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaDef)->first();
                if ($actaDefuncion->IDParroquiaDefuncion != null) {
                    $parroquia = Parroquia::find($actaDefuncion->IDParroquiaDefuncion);
                    $actaDefuncion->LugarDefuncion = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionActaDef = null;
                $UbicacionActaDefuncion = null;
            }

            return view('UserViews.DetalleActa', ['persona' => Persona::findOrFail($id), 'laico' => $laico,
                'acta' => $acta, 'actaBautismo' => $actaBautismo, 'actaConfirma' => $actaConfirma, 'actaMatrimonio' => $actaMatrimonio,
                'actaDefuncion' => $actaDefuncion, 'UbicacionActaBautismo' => $UbicacionActaBautismo, 'UbicacionActaConfirma' => $UbicacionActaConfirma,
                'UbicacionActaMatrimonio' => $UbicacionActaMatrimonio, 'UbicacionActaDefuncion' => $UbicacionActaDefuncion, 'tipoHijo' => $tipoHijo]);

        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error " + $e);
        }
    } // fin DetalleActa


    public function EliminarActa(Request $request)
    {
        try {
            $acta = Acta::where('IDPersona', $request->idPersona)->first();

            $solicitudes = Solicitud_Acta::where('IDActa', $acta->IDActa)->get();
            foreach ($solicitudes as $s) {
                $solici = Solicitud::where('IDSolicitud', $s->IDSolicitud)->first();
                if ($solici->IDEstado_Solicitud == 4) {
                    $solicitud = new Solicitud;
                    $solicitud->IDUser = Auth::user()->IDUser;
                    $solicitud->IDTipo_Solicitud = 1;
                    $solicitud->IDEstado_Solicitud = 3;

                    $solicitud->save();


                    $solicitud_acta = new Solicitud_Acta;
                    $solicitud_acta->IDSolicitud = $solicitud->IDSolicitud;
                    $solicitud_acta->IDActa = $acta->IDActa;
                    $solicitud_acta->Descripcion = $request->descripcion;

                    $solicitud_acta->save();

                    return back()->with('msjBueno', "Se envió la solicitud correctamente!");
                } else {
                    return back()->with('msjMalo', "Ya existe una solicitud para esta acta sin finalizar!");
                }
            }

            $solicitud = new Solicitud;
            $solicitud->IDUser = Auth::user()->IDUser;
            $solicitud->IDTipo_Solicitud = 1;
            $solicitud->IDEstado_Solicitud = 3;

            $solicitud->save();


            $solicitud_acta = new Solicitud_Acta;
            $solicitud_acta->IDSolicitud = $solicitud->IDSolicitud;
            $solicitud_acta->IDActa = $acta->IDActa;
            $solicitud_acta->Descripcion = $request->descripcion;

            $solicitud_acta->save();

            return back()->with('msjBueno', "Se envió la solicitud correctamente!");

        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error al enviar la solicitud!");
        }
    } // fin EliminarActa

    function formatDate($dateString)
    {
        $dd = substr($dateString, 0, 2);
        $mm = substr($dateString, 3, 2);
        $yyyy = substr($dateString, 6, 4);
        return $yyyy . '-' . $mm . '-' . $dd . ' 00:00:00';
    }

    function formatDateToString($dateString)
    {
        $yyyy = substr($dateString, 0, 4);
        $mm = substr($dateString, 5, 2);
        $dd = substr($dateString, 8, 2);
        return $dd . '/' . $mm . '/' . $yyyy;
    }
}
