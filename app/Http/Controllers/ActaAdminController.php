<?php

namespace App\Http\Controllers;

use App\IntermediaActaMatrimonio;
use App\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Redirect;
use Validator;

use App\Persona;
use App\Laico;
use App\UbicacionActa;
use App\Acta;
use App\ActaBautizo;
use App\ActaPrimeraComunion;
use App\ActaConfirma;
use App\ActaMatrimonio;
use App\ActaDefuncion;
use App\Parroquia;


class ActaAdminController extends Controller
{

    public function index()
    {
        $personas = \App\Persona::All();
        return view('AdminViews.ConsultaActaAdmin', compact('personas'));
    }

    public function home()
    {
        $parroquias = \App\Parroquia::all();
        return view('AdminViews.mainActasAdmin', ['parroquias' => $parroquias, 'parroquiaUser' => Auth::user()->IDParroquia]);
    }

    public function crearActa(Request $request)
    {
        try {
            if ($request->has('numCedula') and $request->numCedula != '') {
                $persona = \App\Persona::where('Cedula', $request->numCedula)->first();
                if ($persona != null) {
                    return back()->with('msjMalo', "El número de cédula ingresado ya se encuentra registrado");
                }
            }

            $Persona = new Persona;
            $Laico = new Laico;
            if ($request->has('nombrePadre')) {

                $Persona->Cedula = $request->numCedula;
                $Persona->Nombre = $request->nombre;
                $Persona->PrimerApellido = $request->apellido1;
                $Persona->SegundoApellido = $request->apellido2;

                $Laico->IDTipo_Hijo = 2;
                $Laico->NombreMadre = $request->nombreMadre;
                $Laico->NombrePadre = $request->nombrePadre;
                $Laico->LugarNacimiento = $request->lugarNac;
                if ($request->fechaNac != "") {
                    $Laico->FechaNacimiento = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaNac));
                } else {
                    $Laico->FechaNacimiento = null;
                }
            } else {

                $Persona->Cedula = $request->numCedula;
                $Persona->Nombre = $request->nombre;
                $Persona->PrimerApellido = $request->apellido1;
                $Persona->SegundoApellido = $request->apellido2;

                $Laico->IDTipo_Hijo = 1;
                $Laico->NombreMadre = $request->nombreMadre;
                $Laico->LugarNacimiento = $request->lugarNac;
                if ($request->fechaNac != "") {
                    $Laico->FechaNacimiento = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaNac));
                } else {
                    $Laico->FechaNacimiento = null;
                }
            }
            $idsMatrimonios = [];

            //------------------------------------------------------------------------------
            $Acta = new Acta;

            $CURIA_DIOCESANA_PARROQUIA = -1; //curia diocesana

            if ($request->has('checkBautizo') || $request->has('checkPrimeraComunion') || $request->has('checkConfirma') || $request->has('checkMatrimonio') || $request->has('checkDefuncion')) {

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
                    if ($request->fechaBautizo != "") {
                        $ActaBautizo->FechaBautismo = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaBautizo));
                    }
                    $ActaBautizo->AbuelosPaternos = $request->nombreAbuelosPaternos;
                    $ActaBautizo->AbuelosMaternos = $request->nombreAbuelosMaternos;
                    $ActaBautizo->PadrinoBau1 = $request->nombreMadrinaB;
                    $ActaBautizo->PadrinoBau2 = $request->nombrePadrinoB;
                    $ActaBautizo->SacerdoteBautiza = $request->nombreSacerdoteBau;
                    $ActaBautizo->NotasMarginales = $request->notasMarginalesBau;
                    $ActaBautizo->IDUbicacionActaBau = $UbicacionActaB->IDUbicacionActa;
                    $ActaBautizo->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                    $ActaBautizo->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                    $ActaBautizo->save();

                    $Acta->IDBautismo = $ActaBautizo->IDBautismo;
                    //-------------------------------------------------------
                }

                if ($request->has('checkPrimeraComunion')) {
                    $UbicacionPrimeraComunion = new UbicacionActa;

                    $UbicacionPrimeraComunion->Libro = $request->numLibroPC;
                    $UbicacionPrimeraComunion->Folio = $request->numFolioPC;
                    $UbicacionPrimeraComunion->Asiento = $request->numAsientoPC;

                    $UbicacionPrimeraComunion->save();

                    $ActaPrimeraComunion = new ActaPrimeraComunion;

                    if ($request->lugarPrimeraComunion != "") {
                        $ActaPrimeraComunion->LugarPrimeraComunion = $request->lugarPrimeraComunion;
                    } else {
                        $ActaPrimeraComunion->IDParroquiaPrimeraComunion = $request->parroquiaPrimeraComunion;
                    }
                    if ($request->fechaPrimeraComunion != "") {
                        $ActaPrimeraComunion->FechaPrimeraComunion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaPrimeraComunion));
                    }
                    $ActaPrimeraComunion->NotasMarginales = $request->notasMarginalesPrimeraC;
                    $ActaPrimeraComunion->IDUbicacionPrimeraComunion = $UbicacionPrimeraComunion->IDUbicacionActa;
                    $ActaPrimeraComunion->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                    $ActaPrimeraComunion->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                    $ActaPrimeraComunion->save();

                    $Acta->IDPrimeraComunion = $ActaPrimeraComunion->IDPrimeraComunion;
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
                    if ($request->fechaConfirma != "") {
                        $ActaConfirma->FechaConfirma = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaConfirma));
                    }
                    $ActaConfirma->PadrinoCon1 = $request->nombrePadrinoC1;
                    $ActaConfirma->NotasMarginales = $request->notasMarginalesConf;
                    $ActaConfirma->IDUbicacionActaCon = $UbicacionActaC->IDUbicacionActa;
                    $ActaConfirma->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                    $ActaConfirma->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
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
                    if ($request->fechaMatrimonio != "") {
                        $ActaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaMatrimonio));
                    }
                    $ActaMatrimonio->NombreConyugue = $request->nombreConyuge;
                    $ActaMatrimonio->NotasMarginales = $request->notasMarginalesMat;
                    $ActaMatrimonio->IDUbicacionActaMat = $UbicacionActaM->IDUbicacionActa;
                    $ActaMatrimonio->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                    $ActaMatrimonio->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                    $ActaMatrimonio->save();

                    $Acta->IDMatrimonio = $ActaMatrimonio->IDMatrimonio;

                    // ************** agregar otros matrimonios **************
                    $matrimonioCount = $request->input('matrimonioCount'); // variable para contar cuántos matrimonios hay

                    for ($i = 1; $i <= $matrimonioCount; $i++) {
                        // Comprobar si los datos del matrimonio actual existen
                        if ($request->has('nombreConyuge_' . $i)) {
                            $UbicacionActaMat = new UbicacionActa;

                            $UbicacionActaMat->Libro = $request->input('numLibroM_' . $i);
                            $UbicacionActaMat->Folio = $request->input('numFolioM_' . $i);
                            $UbicacionActaMat->Asiento = $request->input('numAsientoM_' . $i);

                            $UbicacionActaMat->save();

                            $ActaMatrimonio = new ActaMatrimonio;

                            // Aquí procesas los demás campos como lugarMatrimonio y fechaMatrimonio
                            if ($request->input('lugarMatrimonio_' . $i) != "") {
                                $ActaMatrimonio->LugarMatrimonio = $request->input('lugarMatrimonio_' . $i);
                            } else {
                                $ActaMatrimonio->IDParroquiaMatrimonio = $request->input('parroquiaMatrimonio_' . $i);
                            }
                            if ($request->input('fechaMatrimonio_' . $i) != "") {
                                $ActaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->input('fechaMatrimonio_' . $i)));
                            }

                            $ActaMatrimonio->NombreConyugue = $request->input('nombreConyuge_' . $i);
                            $ActaMatrimonio->NotasMarginales = $request->input('notasMarginalesMat_' . $i);
                            $ActaMatrimonio->IDUbicacionActaMat = $UbicacionActaMat->IDUbicacionActa;
                            $ActaMatrimonio->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                            $ActaMatrimonio->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;

                            $ActaMatrimonio->save();

                            // guardar ids para luego guardarlos en la tabla intermedia_matrimonio
                            $idsMatrimonios[] = $ActaMatrimonio->IDMatrimonio;
                        }
                    }
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
                    if ($request->fechaDefuncion != "") {
                        $ActaDefuncion->FechaDefuncion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaDefuncion));
                    }
                    $ActaDefuncion->CausaMuerte = $request->causaDefuncion;
                    $ActaDefuncion->NotasMarginales = $request->notasMarginalesDef;
                    $ActaDefuncion->IDUbicacionActaDef = $UbicacionActaD->IDUbicacionActa;
                    $ActaDefuncion->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                    $ActaDefuncion->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                    $ActaDefuncion->save();

                    $Acta->IDDefuncion = $ActaDefuncion->IDDefuncion;
                }
            }//fin if acta

            $Persona->save();

            $Laico->IDPersona = $Persona->IDPersona;
            $Laico->save();

            $Acta->IDPersona = $Persona->IDPersona;
            $Acta->save();

            // Código para guardar la relación en la tabla intermedia matrimonio
            foreach ($idsMatrimonios as $idMatrimonio) {
                $relacion = new IntermediaActaMatrimonio;
                $relacion->IDPersona = $Persona->IDPersona;
                $relacion->IDMatrimonio = $idMatrimonio;
                $relacion->save();
            }

            return back()->with('msjBueno', "Se agregó la partida correctamente");
        } catch (Exception $e) {
            error_log('Ha ocurrido un error: '.$e);
            return back()->with('msjMalo', "Ha ocurrido un error. Intente nuevamente!");
        }
    }

    // Metodo para cargar la pantalla de Editar con la informacion del acta
    public function EditarActa($id)
    {
        try {
            $acta = null;
            $persona = null;
            $source = 'consulta';
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
            $idPrimeraComunion = $acta->IDPrimeraComunion;
            $idConfirma = $acta->IDConfirma;
            $idMatrimonio = $acta->IDMatrimonio;
            $idDefuncion = $acta->IDDefuncion;

            $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
            $actaPrimeraComunion = ActaPrimeraComunion::where('IDPrimeraComunion', $idPrimeraComunion)->first();
            $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
            $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
            $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();
            $intermediaMatrimonio = IntermediaActaMatrimonio::where('IDPersona', $id)->get();

            $matrimoniosInfo = [];

            $nomParroquiaBauRegistra = null;
            if ($idBautismo != null) {
                if ($actaBautismo->IDParroquiaRegistra != -1) {
                    $parroquiaBauRegistra = Parroquia::find($actaBautismo->IDParroquiaRegistra);
                    $nomParroquiaBauRegistra = $parroquiaBauRegistra->NombreParroquia;
                } else {
                    $nomParroquiaBauRegistra = 'Archivo Diocesano de Alajuela';
                }
                $idUbicacionActaBau = $actaBautismo->IDUbicacionActaBau;
                $UbicacionActaBautismo = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaBau)->first();
                if ($actaBautismo->IDParroquiaBautismo != null) {
                    $parroquia = Parroquia::find($actaBautismo->IDParroquiaBautismo);
                    $actaBautismo->LugarBautismo = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionActaBau = null;
                $UbicacionActaBautismo = null;
            }

            $nomParroquiaPrimeraCRegistra = null;
            if ($idPrimeraComunion != null) {
                if ($actaPrimeraComunion->IDParroquiaRegistra != -1) {
                    $parroquiaPrimeraCRegistra = Parroquia::find($actaPrimeraComunion->IDParroquiaRegistra);
                    $nomParroquiaPrimeraCRegistra = $parroquiaPrimeraCRegistra->NombreParroquia;
                } else {
                    $nomParroquiaPrimeraCRegistra = 'Archivo Diocesano de Alajuela';
                }
                $idUbicacionPrimeraComunion = $actaPrimeraComunion->IDUbicacionPrimeraComunion;
                $UbicacionPrimeraComunion = UbicacionActa::where('IDUbicacionActa', $idUbicacionPrimeraComunion)->first();
                if ($actaPrimeraComunion->IDParroquiaPrimeraComunion != null) {
                    $parroquia = Parroquia::find($actaPrimeraComunion->IDParroquiaPrimeraComunion);
                    $actaPrimeraComunion->LugarPrimeraComunion = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionPrimeraComunion = null;
                $UbicacionPrimeraComunion = null;
            }

            $nomParroquiaConfRegistra = null;
            if ($idConfirma != null) {
                if ($actaConfirma->IDParroquiaRegistra != -1) {
                    $parroquiaConfRegistra = Parroquia::find($actaConfirma->IDParroquiaRegistra);
                    $nomParroquiaConfRegistra = $parroquiaConfRegistra->NombreParroquia;
                } else {
                    $nomParroquiaConfRegistra = 'Archivo Diocesano de Alajuela';
                }
                $idUbicacionActaCon = $actaConfirma->IDUbicacionActaCon;
                $UbicacionActaConfirma = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaCon)->first();
                if ($actaConfirma->IDParroquiaConfirma != null) {
                    $parroquia = Parroquia::find($actaConfirma->IDParroquiaConfirma);
                    $actaConfirma->LugarConfirma = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionActaCon = null;
                $UbicacionActaConfirma = null;
            }

            $nomParroquiaMatRegistra = null;
            if ($idMatrimonio != null) {
                if ($actaMatrimonio->IDParroquiaRegistra != -1) {
                    $parroquiaMatRegistra = Parroquia::find($actaMatrimonio->IDParroquiaRegistra);
                    $nomParroquiaMatRegistra = $parroquiaMatRegistra->NombreParroquia;
                } else {
                    $nomParroquiaMatRegistra = 'Archivo Diocesano de Alajuela';
                }
                $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                if ($actaMatrimonio->IDParroquiaMatrimonio != null) {
                    $parroquia = Parroquia::find($actaMatrimonio->IDParroquiaMatrimonio);
                    $actaMatrimonio->LugarMatrimonio = $parroquia->NombreParroquia;
                }

                if ($intermediaMatrimonio != null) {
                    foreach ($intermediaMatrimonio as $intermedia) {
                        $actaMatrimonioInter = ActaMatrimonio::find($intermedia->IDMatrimonio);
                        if ($actaMatrimonioInter->IDParroquiaRegistra != -1) {
                            $parroquiaMatRegistraInter = Parroquia::find($actaMatrimonioInter->IDParroquiaRegistra);
                            $nomParroquiaMatRegistraInter = $parroquiaMatRegistraInter->NombreParroquia;
                        } else {
                            $nomParroquiaMatRegistraInter = 'Archivo Diocesano de Alajuela';
                        }
                        $UbicacionActaMatrimonioInter = UbicacionActa::where('IDUbicacionActa', $actaMatrimonioInter->IDUbicacionActaMat)->first();

                        if ($actaMatrimonioInter->IDParroquiaMatrimonio != null) {
                            $parroquiaInter = Parroquia::find($actaMatrimonioInter->IDParroquiaMatrimonio);
                            $actaMatrimonioInter->LugarMatrimonio = $parroquiaInter->NombreParroquia;
                        }

                        // Agrega la información procesada al array
                        $matrimoniosInfo[] = [
                            'nomParroquiaMatRegistra' => $nomParroquiaMatRegistraInter,
                            'UbicacionActaMatrimonio' => $UbicacionActaMatrimonioInter,
                            'actaMatrimonio' => $actaMatrimonioInter
                        ];
                    }
                }
            } else {
                $idUbicacionActaMat = null;
                $UbicacionActaMatrimonio = null;
            }

            $nomParroquiaDefRegistra = null;
            if ($idDefuncion != null) {
                if ($actaDefuncion->IDParroquiaRegistra != -1) {
                    $parroquiaDefRegistra = Parroquia::find($actaDefuncion->IDParroquiaRegistra);
                    $nomParroquiaDefRegistra = $parroquiaDefRegistra->NombreParroquia;
                } else {
                    $nomParroquiaDefRegistra = 'Archivo Diocesano de Alajuela';
                }
                $idUbicacionActaDef = $actaDefuncion->IDUbicacionActaDef;
                $UbicacionActaDefuncion = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaDef)->first();
                if ($actaDefuncion->IDParroquiaDefuncion != null) {
                    $parroquia = Parroquia::find($actaDefuncion->IDParroquiaDefuncion);
                    $actaDefuncion->LugarDefuncion = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionActaDef = null;
                $UbicacionActaDefuncion = null;
            }

            $laico = Laico::findOrFail($persona->IDPersona);

            return view('AdminViews.EditarActaAdmin', ['source' => $source, 'idSolicitud' => $id, 'persona' => $persona, 'laico' => $laico,
                'acta' => $acta, 'actaBautismo' => $actaBautismo, 'actaPrimeraComunion' =>$actaPrimeraComunion, 'actaConfirma' => $actaConfirma,
                'actaMatrimonio' => $actaMatrimonio, 'actaDefuncion' => $actaDefuncion, 'UbicacionActaBautismo' => $UbicacionActaBautismo,
                'UbicacionPrimeraComunion' =>$UbicacionPrimeraComunion, 'UbicacionActaConfirma' => $UbicacionActaConfirma,
                'UbicacionActaMatrimonio' => $UbicacionActaMatrimonio, 'UbicacionActaDefuncion' => $UbicacionActaDefuncion,
                'parroquias' => $parroquias, 'parroquiaUser' => Auth::user()->IDParroquia, 'nomParroquiaBauRegistra'=>$nomParroquiaBauRegistra,
                'nomParroquiaPrimeraCRegistra' => $nomParroquiaPrimeraCRegistra, 'nomParroquiaConfRegistra'=>$nomParroquiaConfRegistra,
                'nomParroquiaMatRegistra'=>$nomParroquiaMatRegistra, 'nomParroquiaDefRegistra'=>$nomParroquiaDefRegistra,
                'matrimoniosInfo' => $matrimoniosInfo]);

        } catch (\Exception $e) {
            error_log('Ha ocurrido un error: '.$e);
            return back()->with('msjMalo', "Ha ocurrido un error");
        }
    } // fin EditarActa

    // Metodo para actualizar los datos del acta editada
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
            if ($request->fechaNacEdit != "") {
                $laico->FechaNacimiento = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaNacEdit));
            } else {
                $laico->FechaNacimiento = null;
            }
            $laico->save();

            $acta = Acta::where('IDPersona', $id)->first();
            $idBautismo = $acta->IDBautismo;
            $idPrimeraComunion = $acta->IDPrimeraComunion;
            $idConfirma = $acta->IDConfirma;
            $idMatrimonio = $acta->IDMatrimonio;
            $idDefuncion = $acta->IDDefuncion;

            $CURIA_DIOCESANA_PARROQUIA = -1; //curia diocesana
            $idsMatrimoniosPorGuardar = [];

            if ($idBautismo != null) {
                $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
                if ($request->parroquiaBautismo != 'otro') {
                    $actaBautismo->IDParroquiaBautismo = $request->parroquiaBautismo;
                    $actaBautismo->LugarBautismo = null;
                } else {
                    $actaBautismo->IDParroquiaBautismo = null;
                    $actaBautismo->LugarBautismo = $request->lugarBautizo;
                }
                if ($request->fechaBautizo != "") {
                    $actaBautismo->FechaBautismo = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaBautizo));
                } else {
                    $actaBautismo->FechaBautismo = null;
                }
                $actaBautismo->AbuelosPaternos = $request->nombreAbuelosPaternos;
                $actaBautismo->AbuelosMaternos = $request->nombreAbuelosMaternos;
                $actaBautismo->PadrinoBau1 = $request->nombreMadrinaB;
                $actaBautismo->PadrinoBau2 = $request->nombrePadrinoB;
                $actaBautismo->SacerdoteBautiza = $request->nombreSacerdoteBau;
                $actaBautismo->NotasMarginales = $request->notasMarginalesBauEdit;
                $actaBautismo->save();

                $idUbicacionActaBau = $actaBautismo->IDUbicacionActaBau;
                $UbicacionActaBautismo = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaBau)->first();
                $UbicacionActaBautismo->Libro = $request->numLibroB;
                $UbicacionActaBautismo->Folio = $request->numFolioB;
                $UbicacionActaBautismo->Asiento = $request->numAsientoB;
                $UbicacionActaBautismo->save();
            } else if ($request->has('checkBautismo')) {
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
                if ($request->fechaBautizo != "") {
                    $actaBautismo->FechaBautismo = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaBautizo));
                } else {
                    $actaBautismo->FechaBautismo = null;
                }
                $actaBautismo->AbuelosPaternos = $request->nombreAbuelosPaternos;
                $actaBautismo->AbuelosMaternos = $request->nombreAbuelosMaternos;
                $actaBautismo->PadrinoBau1 = $request->nombreMadrinaB;
                $actaBautismo->PadrinoBau2 = $request->nombrePadrinoB;
                $actaBautismo->SacerdoteBautiza = $request->nombreSacerdoteBau;
                $actaBautismo->NotasMarginales = $request->notasMarginalesBauEdit;
                $actaBautismo->IDUbicacionActaBau = $UbicacionActaBautismo->IDUbicacionActa;
                $actaBautismo->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                $actaBautismo->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                $actaBautismo->save();

                $acta->IDBautismo = $actaBautismo->IDBautismo;
            }

            if ($idPrimeraComunion != null) {
                $actaPrimeraComunion = ActaPrimeraComunion::where('IDPrimeraComunion', $idPrimeraComunion)->first();
                if ($request->parroquiaPrimeraComunion != 'otro') {
                    $actaPrimeraComunion->IDParroquiaPrimeraComunion = $request->parroquiaPrimeraComunion;
                    $actaPrimeraComunion->LugarPrimeraComunion = null;
                } else {
                    $actaPrimeraComunion->IDParroquiaPrimeraComunion = null;
                    $actaPrimeraComunion->LugarPrimeraComunion = $request->lugarPrimeraComunion;
                }
                if ($request->fechaPrimeraComunion != "") {
                    $actaPrimeraComunion->FechaPrimeraComunion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaPrimeraComunion));
                } else {
                    $actaPrimeraComunion->FechaPrimeraComunion = null;
                }
                $actaPrimeraComunion->NotasMarginales = $request->notasMarginalesPrimeraCEdit;
                $actaPrimeraComunion->save();

                $idUbicacionPrimeraComunion = $actaPrimeraComunion->IDUbicacionPrimeraComunion;
                $UbicacionPrimeraComunion = UbicacionActa::where('IDUbicacionActa', $idUbicacionPrimeraComunion)->first();
                $UbicacionPrimeraComunion->Libro = $request->numLibroPC;
                $UbicacionPrimeraComunion->Folio = $request->numFolioPC;
                $UbicacionPrimeraComunion->Asiento = $request->numAsientoPC;
                $UbicacionPrimeraComunion->save();
            } else if ($request->has('checkPrimeraComunion')) {
                $UbicacionPrimeraComunion = new UbicacionActa;
                $UbicacionPrimeraComunion->Libro = $request->numLibroPC;
                $UbicacionPrimeraComunion->Folio = $request->numFolioPC;
                $UbicacionPrimeraComunion->Asiento = $request->numAsientoPC;
                $UbicacionPrimeraComunion->save();

                $actaPrimeraComunion = new ActaPrimeraComunion();
                if ($request->has('parroquiaPrimeraComunion') && $request->parroquiaPrimeraComunion != 'otro') {
                    $actaPrimeraComunion->IDParroquiaPrimeraComunion = $request->parroquiaPrimeraComunion;
                } else {
                    $actaPrimeraComunion->LugarPrimeraComunion = $request->lugarPrimeraComunion;
                }
                if ($request->fechaPrimeraComunion != "") {
                    $actaPrimeraComunion->FechaPrimeraComunion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaPrimeraComunion));
                } else {
                    $actaPrimeraComunion->FechaPrimeraComunion = null;
                }
                $actaPrimeraComunion->NotasMarginales = $request->notasMarginalesPrimeraCEdit;
                $actaPrimeraComunion->IDUbicacionPrimeraComunion = $UbicacionPrimeraComunion->IDUbicacionActa;
                $actaPrimeraComunion->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                $actaPrimeraComunion->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                $actaPrimeraComunion->save();

                $acta->IDPrimeraComunion = $actaPrimeraComunion->IDPrimeraComunion;
            }

            if ($idConfirma != null) {
                $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
                if ($request->parroquiaConfirma != 'otro') {
                    $actaConfirma->IDParroquiaConfirma = $request->parroquiaConfirma;
                    $actaConfirma->LugarConfirma = null;
                } else {
                    $actaConfirma->IDParroquiaConfirma = null;
                    $actaConfirma->LugarConfirma = $request->lugarConfirma;
                }
                if ($request->fechaConfirma != "") {
                    $actaConfirma->FechaConfirma = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaConfirma));
                } else {
                    $actaConfirma->FechaConfirma = null;
                }
                $actaConfirma->PadrinoCon1 = $request->nombrePadrinoC1;
                $actaConfirma->NotasMarginales = $request->notasMarginalesConfEdit;
                $actaConfirma->save();

                $idUbicacionActaCon = $actaConfirma->IDUbicacionActaCon;
                $UbicacionActaConfirma = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaCon)->first();
                $UbicacionActaConfirma->Libro = $request->numLibroC;
                $UbicacionActaConfirma->Folio = $request->numFolioC;
                $UbicacionActaConfirma->Asiento = $request->numAsientoC;
                $UbicacionActaConfirma->save();
            } else if ($request->has('checkConfirma')) {
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
                if ($request->fechaConfirma != "") {
                    $actaConfirma->FechaConfirma = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaConfirma));
                } else {
                    $actaConfirma->FechaConfirma = null;
                }
                $actaConfirma->PadrinoCon1 = $request->nombrePadrinoC1;
                $actaConfirma->NotasMarginales = $request->notasMarginalesConfEdit;
                $actaConfirma->IDUbicacionActaCon = $UbicacionActaConfirma->IDUbicacionActa;
                $actaConfirma->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                $actaConfirma->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                $actaConfirma->save();

                $acta->IDConfirma = $actaConfirma->IDConfirma;
            }

            if ($idMatrimonio != null) {
                $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
                if ($request->parroquiaMatrimonio != 'otro') {
                    $actaMatrimonio->IDParroquiaMatrimonio = $request->parroquiaMatrimonio;
                    $actaMatrimonio->LugarMatrimonio = null;
                } else {
                    $actaMatrimonio->IDParroquiaMatrimonio = null;
                    $actaMatrimonio->LugarMatrimonio = $request->lugarMatrimonio;
                }
                if ($request->fechaMatrimonio != "") {
                    $actaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaMatrimonio));
                } else {
                    $actaMatrimonio->FechaMatrimonio = null;
                }
                $actaMatrimonio->NombreConyugue = $request->nombreConyuge;
                $actaMatrimonio->NotasMarginales = $request->notasMarginalesMatEdit;
                $actaMatrimonio->save();

                $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                $UbicacionActaMatrimonio->Libro = $request->numLibroM;
                $UbicacionActaMatrimonio->Folio = $request->numFolioM;
                $UbicacionActaMatrimonio->Asiento = $request->numAsientoM;
                $UbicacionActaMatrimonio->save();

                // ************** agregar otros matrimonios cuando ya existen otros matrimonios **************
                $matrimonioCount = $request->input('matrimonioCount'); // variable para contar cuántos matrimonios hay
                $idsMatrimonios = $this->extraerIdsMatrimonios($request);; // este array guardará los IDs de los matrimonios
                $idsMatrimoniosNuevos = $this->extraerIdsMatrimoniosNuevos($request);

                // editar matrimonios
                foreach ($idsMatrimonios as $id) {
//                    error_log("Prueba: ".$id);
                    $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $id)->first();
                    if ($request->input("parroquiaMatrimonio_".$id) != 'otro') {
                        $actaMatrimonio->IDParroquiaMatrimonio = $request->input("parroquiaMatrimonio_".$id);
                        $actaMatrimonio->LugarMatrimonio = null;
                    } else {
                        $actaMatrimonio->IDParroquiaMatrimonio = null;
                        $actaMatrimonio->LugarMatrimonio = $request->input("lugarMatrimonio_".$id);
                    }
                    if ($request->input("fechaMatrimonio_".$id) != "") {
                        $actaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->input("fechaMatrimonio_".$id)));
                    } else {
                        $actaMatrimonio->FechaMatrimonio = null;
                    }
                    $actaMatrimonio->NombreConyugue = $request->input("nombreConyuge_".$id);
                    $actaMatrimonio->NotasMarginales = $request->input("notasMarginalesMatEdit_".$id);
                    $actaMatrimonio->save();

                    $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                    $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                    $UbicacionActaMatrimonio->Libro = $request->input("numLibroM_".$id);
                    $UbicacionActaMatrimonio->Folio = $request->input("numFolioM_".$id);
                    $UbicacionActaMatrimonio->Asiento = $request->input("numAsientoM_".$id);
                    $UbicacionActaMatrimonio->save();
                }

                // agregar nuevos matrimonios con matrimonios ya existentes
                foreach ($idsMatrimoniosNuevos as $id) {
                    // Comprobar si los datos del matrimonio actual existen
                    if ($request->has('nombreConyuge_nuevo_' . $id)) {
                        $UbicacionActaMat = new UbicacionActa;

                        $UbicacionActaMat->Libro = $request->input('numLibroM_nuevo_' . $id);
                        $UbicacionActaMat->Folio = $request->input('numFolioM_nuevo_' . $id);
                        $UbicacionActaMat->Asiento = $request->input('numAsientoM_nuevo_' . $id);

                        $UbicacionActaMat->save();

                        $ActaMatrimonio = new ActaMatrimonio;

                        // Aquí procesas los demás campos como lugarMatrimonio y fechaMatrimonio
                        if ($request->input('lugarMatrimonio_nuevo_' . $id) != "") {
                            $ActaMatrimonio->LugarMatrimonio = $request->input('lugarMatrimonio_nuevo_' . $id);
                        } else {
                            $ActaMatrimonio->IDParroquiaMatrimonio = $request->input('parroquiaMatrimonio_nuevo_' . $id);
                        }
                        if ($request->input('fechaMatrimonio_nuevo_' . $id) != "") {
                            $ActaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->input('fechaMatrimonio_nuevo_' . $id)));
                        }

                        $ActaMatrimonio->NombreConyugue = $request->input('nombreConyuge_nuevo_' . $id);
                        $ActaMatrimonio->NotasMarginales = $request->input('notasMarginalesMat_nuevo_' . $id);
                        $ActaMatrimonio->IDUbicacionActaMat = $UbicacionActaMat->IDUbicacionActa;
                        $ActaMatrimonio->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                        $ActaMatrimonio->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;

                        $ActaMatrimonio->save();

                        // guardar ids para luego guardarlos en la tabla intermedia_matrimonio
                        $idsMatrimoniosPorGuardar[] = $ActaMatrimonio->IDMatrimonio;
                    }
                }
            } else if ($request->has('checkMatrimonio')) {
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
                if ($request->fechaMatrimonio != "") {
                    $actaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaMatrimonio));
                } else {
                    $actaMatrimonio->FechaMatrimonio = null;
                }
                $actaMatrimonio->NombreConyugue = $request->nombreConyuge;
                $actaMatrimonio->NotasMarginales = $request->notasMarginalesMatEdit;
                $actaMatrimonio->IDUbicacionActaMat = $UbicacionActaMatrimonio->IDUbicacionActa;
                $actaMatrimonio->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                $actaMatrimonio->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                $actaMatrimonio->save();

                $acta->IDMatrimonio = $actaMatrimonio->IDMatrimonio;

                // ************** agregar otros matrimonios **************
                $matrimonioCount = $request->input('matrimonioCount'); // variable para contar cuántos matrimonios hay

                for ($i = 1; $i <= $matrimonioCount; $i++) {
                    // Comprobar si los datos del matrimonio actual existen
                    if ($request->has('nombreConyuge_' . $i)) {
                        $UbicacionActaMat = new UbicacionActa;

                        $UbicacionActaMat->Libro = $request->input('numLibroM_' . $i);
                        $UbicacionActaMat->Folio = $request->input('numFolioM_' . $i);
                        $UbicacionActaMat->Asiento = $request->input('numAsientoM_' . $i);

                        $UbicacionActaMat->save();

                        $ActaMatrimonio = new ActaMatrimonio;

                        // Aquí procesas los demás campos como lugarMatrimonio y fechaMatrimonio
                        if ($request->input('lugarMatrimonio_' . $i) != "") {
                            $ActaMatrimonio->LugarMatrimonio = $request->input('lugarMatrimonio_' . $i);
                        } else {
                            $ActaMatrimonio->IDParroquiaMatrimonio = $request->input('parroquiaMatrimonio_' . $i);
                        }
                        if ($request->input('fechaMatrimonio_' . $i) != "") {
                            $ActaMatrimonio->FechaMatrimonio = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->input('fechaMatrimonio_' . $i)));
                        }

                        $ActaMatrimonio->NombreConyugue = $request->input('nombreConyuge_' . $i);
                        $ActaMatrimonio->NotasMarginales = $request->input('notasMarginalesMat_' . $i);
                        $ActaMatrimonio->IDUbicacionActaMat = $UbicacionActaMat->IDUbicacionActa;
                        $ActaMatrimonio->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                        $ActaMatrimonio->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;

                        $ActaMatrimonio->save();

                        // guardar ids para luego guardarlos en la tabla intermedia_matrimonio
                        $idsMatrimoniosPorGuardar[] = $ActaMatrimonio->IDMatrimonio;
                    }
                }
            }

            if ($idDefuncion != null) {
                $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();
                if ($request->parroquiaDefuncion != 'otro') {
                    $actaDefuncion->IDParroquiaDefuncion = $request->parroquiaDefuncion;
                    $actaDefuncion->LugarDefuncion = null;
                } else {
                    $actaDefuncion->IDParroquiaDefuncion = null;
                    $actaDefuncion->LugarDefuncion = $request->lugarDefuncion;
                }
                if ($request->fechaDefuncion != "") {
                    $actaDefuncion->FechaDefuncion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaDefuncion));
                } else {
                    $actaDefuncion->FechaDefuncion = null;
                }
                $actaDefuncion->CausaMuerte = $request->causaDefuncion;
                $actaDefuncion->NotasMarginales = $request->notasMarginalesDefEdit;
                $actaDefuncion->save();

                $idUbicacionActaDef = $actaDefuncion->IDUbicacionActaDef;
                $UbicacionActaDefuncion = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaDef)->first();
                $UbicacionActaDefuncion->Libro = $request->numLibroD;
                $UbicacionActaDefuncion->Folio = $request->numFolioD;
                $UbicacionActaDefuncion->Asiento = $request->numAsientoD;
                $UbicacionActaDefuncion->save();
            } else if ($request->has('checkDefuncion')) {
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
                if ($request->fechaDefuncion != "") {
                    $actaDefuncion->FechaDefuncion = Carbon::createFromFormat('Y-m-d H:i:s', $this->formatDate($request->fechaDefuncion));
                } else {
                    $actaDefuncion->FechaDefuncion = null;
                }
                $actaDefuncion->CausaMuerte = $request->causaDefuncion;
                $actaDefuncion->NotasMarginales = $request->notasMarginalesDefEdit;
                $actaDefuncion->IDUbicacionActaDef = $UbicacionActaDefuncion->IDUbicacionActa;
                $actaDefuncion->NombreUserRegistra = Auth::user()->Nombre . ' ' . Auth::user()->PrimerApellido . ' ' . Auth::user()->SegundoApellido;
                $actaDefuncion->IDParroquiaRegistra = $CURIA_DIOCESANA_PARROQUIA;
                $actaDefuncion->save();

                $acta->IDDefuncion = $actaDefuncion->IDDefuncion;
            }
            $acta->save();

            // Código para guardar la relación en la tabla intermedia matrimonio
            foreach ($idsMatrimoniosPorGuardar as $idMatrimonio) {
                $relacion = new IntermediaActaMatrimonio;
                $relacion->IDPersona = $_POST['IDPersona'];
                $relacion->IDMatrimonio = $idMatrimonio;
                $relacion->save();
            }

            // solicitud aceptada
            if ($request->source == 'notificaciones') {
                $solicitud = \App\Solicitud::find($request->idSolicitud);
                $solicitud->IDEstado_Solicitud = 1;
                $solicitud->save();

                return Redirect::to('/notificacionesAdmin');
            }

            return back()->with('msjBueno', "Se ha modificado la partida correctamente");

        } catch (\Exception $e) {
            error_log('Ha ocurrido un error: '.$e);
            return back()->with('msjMalo', "Ha ocurrido un error al modificar la partida.");
        }
    } // fin actualizarActa

    public function DetalleActa($id)
    {
        try {
            $acta = Acta::where('IDPersona', $id)->first();

            $idBautismo = $acta->IDBautismo;
            $idPrimeraComunion = $acta->IDPrimeraComunion;
            $idConfirma = $acta->IDConfirma;
            $idMatrimonio = $acta->IDMatrimonio;
            $idDefuncion = $acta->IDDefuncion;

            $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
            $actaPrimeraComunion = ActaPrimeraComunion::where('IDPrimeraComunion', $idPrimeraComunion)->first();
            $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
            $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
            $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();
            $laico = Laico::findOrFail($id);
            $intermediaMatrimonio = IntermediaActaMatrimonio::where('IDPersona', $id)->get();

            $parroquias = \App\Parroquia::all();

            $date = $laico->FechaNacimiento;
            $laico->FechaNacimiento = $this->formatDatetoString($date);

            if ($laico->IDTipo_Hijo == 1) {
                $tipoHijo = "no reconocido";
            } else {
                $tipoHijo = "legítimo";
            }

            $matrimoniosInfo = [];

            $nomParroquiaBauRegistra = null;
            if ($idBautismo != null) {
                if ($actaBautismo->IDParroquiaRegistra != -1) {
                    $parroquiaBauRegistra = Parroquia::find($actaBautismo->IDParroquiaRegistra);
                    $nomParroquiaBauRegistra = $parroquiaBauRegistra->NombreParroquia;
                } else {
                    $nomParroquiaBauRegistra = 'Archivo Diocesano de Alajuela';
                }
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

            $nomParroquiaPrimeraCRegistra = null;
            if ($idPrimeraComunion != null) {
                if ($actaPrimeraComunion->IDParroquiaRegistra != -1) {
                    $nomParroquiaPrimeraCRegistra = Parroquia::find($actaPrimeraComunion->IDParroquiaRegistra);
                    $nomParroquiaPrimeraCRegistra = $nomParroquiaPrimeraCRegistra->NombreParroquia;
                } else {
                    $nomParroquiaPrimeraCRegistra = 'Archivo Diocesano de Alajuela';
                }
                $idUbicacionPrimeraComunion = $actaPrimeraComunion->IDUbicacionPrimeraComunion;
                $date = $actaPrimeraComunion->FechaPrimeraComunion;
                $actaPrimeraComunion->FechaPrimeraComunion = $this->formatDatetoString($date);
                $UbicacionPrimeraComunion = UbicacionActa::where('IDUbicacionActa', $idUbicacionPrimeraComunion)->first();
                if ($actaPrimeraComunion->IDParroquiaPrimeraComunion != null) {
                    $parroquia = Parroquia::find($actaPrimeraComunion->IDParroquiaPrimeraComunion);
                    $actaPrimeraComunion->LugarPrimeraComunion = $parroquia->NombreParroquia;
                }
            } else {
                $idUbicacionPrimeraComunion = null;
                $UbicacionPrimeraComunion = null;
            }

            $nomParroquiaConfRegistra = null;
            if ($idConfirma != null) {
                if ($actaConfirma->IDParroquiaRegistra != -1) {
                    $parroquiaConfRegistra = Parroquia::find($actaConfirma->IDParroquiaRegistra);
                    $nomParroquiaConfRegistra = $parroquiaConfRegistra->NombreParroquia;
                } else {
                    $nomParroquiaConfRegistra = 'Archivo Diocesano de Alajuela';
                }
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

            $nomParroquiaMatRegistra = null;
            if ($idMatrimonio != null) {
                if ($actaMatrimonio->IDParroquiaRegistra != -1) {
                    $parroquiaMatRegistra = Parroquia::find($actaMatrimonio->IDParroquiaRegistra);
                    $nomParroquiaMatRegistra = $parroquiaMatRegistra->NombreParroquia;
                } else {
                    $nomParroquiaMatRegistra = 'Archivo Diocesano de Alajuela';
                }
                $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                $date = $actaMatrimonio->FechaMatrimonio;
                $actaMatrimonio->FechaMatrimonio = $this->formatDatetoString($date);
                $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                if ($actaMatrimonio->IDParroquiaMatrimonio != null) {
                    $parroquia = Parroquia::find($actaMatrimonio->IDParroquiaMatrimonio);
                    $actaMatrimonio->LugarMatrimonio = $parroquia->NombreParroquia;
                }

                if ($intermediaMatrimonio != null) {
                    foreach ($intermediaMatrimonio as $intermedia) {
                        $actaMatrimonioInter = ActaMatrimonio::find($intermedia->IDMatrimonio);
                        if ($actaMatrimonioInter) {
                            if ($actaMatrimonioInter->IDParroquiaRegistra != -1) {
                                $parroquiaMatRegistra = Parroquia::find($actaMatrimonioInter->IDParroquiaRegistra);
                                $nomParroquiaMatRegistraInter = $parroquiaMatRegistra->NombreParroquia;
                            } else {
                                $nomParroquiaMatRegistraInter = 'Archivo Diocesano de Alajuela';
                            }

                            $date = $actaMatrimonioInter->FechaMatrimonio;
                            $actaMatrimonioInter->FechaMatrimonio = $this->formatDatetoString($date);

                            $UbicacionActaMatrimonioInter = UbicacionActa::where('IDUbicacionActa', $actaMatrimonioInter->IDUbicacionActaMat)->first();

                            if ($actaMatrimonioInter->IDParroquiaMatrimonio != null) {
                                $parroquia = Parroquia::find($actaMatrimonioInter->IDParroquiaMatrimonio);
                                $actaMatrimonioInter->LugarMatrimonio = $parroquia->NombreParroquia;
                            }

                            // Agrega la información procesada al array
                            $matrimoniosInfo[] = [
                                'nomParroquiaMatRegistra' => $nomParroquiaMatRegistraInter,
                                'UbicacionActaMatrimonio' => $UbicacionActaMatrimonioInter,
                                'actaMatrimonio' => $actaMatrimonioInter
                            ];
                        }
                    }
                }
            } else {
                $idUbicacionActaMat = null;
                $UbicacionActaMatrimonio = null;
            }

            $nomParroquiaDefRegistra = null;
            if ($idDefuncion != null) {
                if ($actaDefuncion->IDParroquiaRegistra != -1) {
                    $parroquiaDefRegistra = Parroquia::find($actaDefuncion->IDParroquiaRegistra);
                    $nomParroquiaDefRegistra = $parroquiaDefRegistra->NombreParroquia;
                } else {
                    $nomParroquiaDefRegistra = 'Archivo Diocesano de Alajuela';
                }
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

            $parroquiaUser = Auth::user()->puesto->IDPuesto <= 2 ? -1 : Auth::user()->IDParroquia;

            return view('AdminViews.DetalleActaAdmin', ['persona' => Persona::findOrFail($id), 'laico' => $laico,
                'acta' => $acta, 'actaBautismo' => $actaBautismo, 'actaPrimeraComunion' => $actaPrimeraComunion,
                'actaConfirma' => $actaConfirma, 'actaMatrimonio' => $actaMatrimonio, 'actaDefuncion' => $actaDefuncion,
                'UbicacionActaBautismo' => $UbicacionActaBautismo, 'UbicacionPrimeraComunion' => $UbicacionPrimeraComunion,
                'UbicacionActaConfirma' => $UbicacionActaConfirma, 'UbicacionActaMatrimonio' => $UbicacionActaMatrimonio,
                'UbicacionActaDefuncion' => $UbicacionActaDefuncion, 'tipoHijo' => $tipoHijo,
                'nomParroquiaBauRegistra'=>$nomParroquiaBauRegistra, 'nomParroquiaPrimeraCRegistra' => $nomParroquiaPrimeraCRegistra,
                'nomParroquiaConfRegistra'=>$nomParroquiaConfRegistra, 'nomParroquiaMatRegistra'=>$nomParroquiaMatRegistra,
                'nomParroquiaDefRegistra'=>$nomParroquiaDefRegistra, 'parroquias' => $parroquias, 'parroquiaUser' => $parroquiaUser,
                'matrimoniosInfo' => $matrimoniosInfo]);

        } catch (Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error");
        }
    } // fin DetalleActa

    public function EliminarActa($id)
    {
        try {
            $acta = Acta::where('IDPersona', $id)->first();

            $solicitudes = Solicitud::where('IDActa', $acta->IDActa)->get();

            $idBautismo = $acta->IDBautismo;
            $idPrimeraComunion = $acta->IDPrimeraComunion;
            $idConfirma = $acta->IDConfirma;
            $idMatrimonio = $acta->IDMatrimonio;
            $idDefuncion = $acta->IDDefuncion;

            if ($idBautismo != null) {
                $actaBautismo = ActaBautizo::where('IDBautismo', $idBautismo)->first();
                $idUbicacionActaBau = $actaBautismo->IDUbicacionActaBau;
                $UbicacionActaBautismo = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaBau)->first();
                $UbicacionActaBautismo->delete();
                $actaBautismo->delete();
            }

            if ($idPrimeraComunion != null) {
                $actaPrimeraComunion = ActaPrimeraComunion::where('IDPrimeraComunion', $idPrimeraComunion)->first();
                $idUbicacionPrimeraC = $actaPrimeraComunion->IDUbicacionPrimeraComunion;
                $UbicacionPrimeraComunion = UbicacionActa::where('IDUbicacionActa', $idUbicacionPrimeraC)->first();
                $UbicacionPrimeraComunion->delete();
                $actaPrimeraComunion->delete();
            }

            if ($idConfirma != null) {
                $actaConfirma = ActaConfirma::where('IDConfirma', $idConfirma)->first();
                $idUbicacionActaCon = $actaConfirma->IDUbicacionActaCon;
                $UbicacionActaConfirma = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaCon)->first();
                $UbicacionActaConfirma->delete();
                $actaConfirma->delete();
            }

            if ($idMatrimonio != null) {
                $actaMatrimonio = ActaMatrimonio::where('IDMatrimonio', $idMatrimonio)->first();
                $idUbicacionActaMat = $actaMatrimonio->IDUbicacionActaMat;
                $UbicacionActaMatrimonio = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaMat)->first();
                $UbicacionActaMatrimonio->delete();
                $actaMatrimonio->delete();
            }

            if ($idDefuncion != null) {
                $actaDefuncion = ActaDefuncion::where('IDDefuncion', $idDefuncion)->first();
                $idUbicacionActaDef = $actaDefuncion->IDUbicacionActaDef;
                $UbicacionActaDefuncion = UbicacionActa::where('IDUbicacionActa', $idUbicacionActaDef)->first();
                $UbicacionActaDefuncion->delete();
                $actaDefuncion->delete();
            }

            foreach ($solicitudes as $solicitud) {
                Solicitud::destroy($solicitud->IDSolicitud);
            }

            $acta->delete();
            Laico::destroy($id);
            Persona::destroy($id);
            return back()->with('msjBueno', "Se ha eliminado el acta correctamente");

        } catch (\Exception $e) {
            return back()->with('msjMalo', "Ha ocurrido un error al eliminar el acta" . $e);
        }
    }


    function formatDate($dateString)
    {
        $dd = substr($dateString, 0, 2);
        $mm = substr($dateString, 3, 2);
        $yyyy = substr($dateString, 6, 4);
        return $yyyy . '-' . $mm . '-' . $dd . ' 00:00:00';
    }

    function formatDatetoString($dateString)
    {
        $yyyy = substr($dateString, 0, 4);
        $mm = substr($dateString, 5, 2);
        $dd = substr($dateString, 8, 2);
        return $dd . '/' . $mm . '/' . $yyyy;
    }

    private function extraerIdsMatrimonios($request): array
    {
        $elementNames = array_keys($request->all());

        // Filtrar solo los nombres que siguen el formato "nombreConyuge_N"
        $filteredNames = array_filter($elementNames, function($name) {
            return preg_match('/^nombreConyuge_(\d+)$/', $name);
        });

        // Extraer los identificadores numéricos
        return array_map(function($name) {
            preg_match('/^nombreConyuge_(\d+)$/', $name, $matches);
            return $matches[1];
        }, $filteredNames);
    }

    private function extraerIdsMatrimoniosNuevos($request): array
    {
        $elementNames = array_keys($request->all());

        // Filtrar solo los nombres que siguen el formato "nombreConyuge_N"
        $filteredNames = array_filter($elementNames, function($name) {
            return preg_match('/^nombreConyuge_nuevo_(\d+)$/', $name);
        });

        // Extraer los identificadores numéricos
        return array_map(function($name) {
            preg_match('/^nombreConyuge_nuevo_(\d+)$/', $name, $matches);
            return $matches[1];
        }, $filteredNames);
    }
}
