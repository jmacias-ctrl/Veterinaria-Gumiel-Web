<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\whereyoucanfind;
use App\Models\landingpage_config;
use App\Models\LandingPageInicio;
use App\Models\LandingPageGaleria;
use App\Models\AboutUs;
use App\Models\DisponibilidadVeterinaria;
use Illuminate\Support\Carbon;
use Exception;

class LandingPageController extends Controller
{
    public static function getLandingPageDetails()
    {
        $landingMaps = whereYouCanFind::first();
        return  $landingMaps;
    }
    public static function getLogoLandingPage()
    {
        $logo = LandingPageInicio::find(1)->logo_1;
        return $logo;
    }

    public static function getLogoPanel()
    {
        $logo = LandingPageInicio::find(1)->logo_2;
        return $logo;
    }
    public function index_landingpage()
    {
        $data_index = LandingPageInicio::find(1);
        $gallery_index = LandingPageGaleria::all()->toArray();
        $carrousel_index = LandingPageGaleria::skip(0)->take(4)->get();
        $landingMaps = whereYouCanFind::first();
        $setDay = [
            0 => 'Lunes',
            1 => 'Martes',
            2 => 'Miercoles',
            3 => 'Jueves',
            4 => 'Viernes',
            5 => 'Sabado',
            6 => 'Domingo',
        ];
        $disponibilidad = DisponibilidadVeterinaria::all()->map(function ($item) {
            $setDay = [
                0 => 'Lunes',
                1 => 'Martes',
                2 => 'Miercoles',
                3 => 'Jueves',
                4 => 'Viernes',
                5 => 'Sabado',
                6 => 'Domingo',
            ];
            $item->day = $setDay[$item->day];
            $item->morning_start = Carbon::parse($item->morning_start)->format('H:i');
            $item->morning_end = Carbon::parse($item->morning_end)->format('H:i');
            $item->afternoon_start = Carbon::parse($item->afternoon_start)->format('H:i');
            $item->afternoon_end = Carbon::parse($item->afternoon_end)->format('H:i');
            return $item;
        });
        return view('welcome', compact('data_index', 'gallery_index', 'carrousel_index', 'disponibilidad', 'landingMaps'));
    }
    public function modify_horario_landingpage()
    {
        $horario = DisponibilidadVeterinaria::all();

        if (count($horario) > 0) {
            $horario->map(function ($horarios) {
                $horarios->morning_start = (new Carbon($horarios->morning_start))->format('H:i');
                $horarios->morning_end = (new Carbon($horarios->morning_end))->format('H:i');
                $horarios->afternoon_start = (new Carbon($horarios->afternoon_start))->format('H:i');
                $horarios->afternoon_end = (new Carbon($horarios->afternoon_end))->format('H:i');
            });
        }

        return view('landingpage.ubication.disponibilidad_veterinaria', compact('horario'));
    }

    public function update_horario_landingpage(Request $request)
    {
        $active = $request->input('active') ?: [];
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors = [];

        for ($i = 0; $i < 7; ++$i) {
            if ($morning_start[$i] > $morning_end[$i]) {
                $errors[] = 'Inconsistencia en el intervalo de las horas del turno de la mañana del día : ' . $this->days[$i] . '.';
            }
            if ($afternoon_start[$i] > $afternoon_end[$i]) {
                $errors[] = 'Inconsistencia en el intervalo de las horas del turno de la tarde del día : ' . $this->days[$i] . '.';
            }


            DisponibilidadVeterinaria::updateOrCreate(
                [
                    'day' => $i,
                ],
                [
                    'active' => in_array($i, $active),
                    'morning_start' => $morning_start[$i],
                    'morning_end' => $morning_end[$i],
                    'afternoon_start' => $afternoon_start[$i],
                    'afternoon_end' => $afternoon_end[$i],
                ],
            );
        }
        if (count($errors) > 0)
            return back()->with(compact('errors'));

        $notification = 'Los cambios se han guardado correctamente.';
        return back()->with(compact('notification'));
    }
    public function modify_landingpage_ubication()
    {
        $landingMaps = \App\Models\whereYouCanFind::first();
        $landingpageconfig = \App\Models\landingpage_config::first();

        $data = [
            'landingMaps' => $landingMaps,
            'landingpage_config' => $landingpageconfig
        ];

        return view('landingpage.ubication.modify', $data);
    }
    public function aboutUs()
    {
        $aboutUs = AboutUs::first();
        return view('nosotros', compact('aboutUs'));
    }
    public function modify_aboutus()
    {
        $aboutUs = AboutUs::first();
        return view('landingpage.ubication.nosotros_modify', compact('aboutUs'));
    }
    public function modify_website()
    {
        $data_index = LandingPageInicio::find(1);
        $gallery_index = LandingPageGaleria::all();
        return view('landingpage.ubication.landing_page_modify', compact('data_index', 'gallery_index'));
    }
    public function update_website(Request $request)
    {
        $rules = [
            'titulo_bienvenida' => 'required|string',
            'agenda_hora_texto' => 'required|string',
            'agenda_hora_titulo' => 'required|string',
            'agenda_hora_imagen' => 'mimes:jpg,jpeg,png',
            'logo_1' => 'mimes:jpg,jpeg,png',
            'logo_2' => 'mimes:jpg,jpeg,png',
        ];

        $attributes = [
            'titulo_bienvenida' => 'Titulo de Bienvenida',
            'agenda_hora_texto' => 'Agenda tu Hora Texto',
            'agenda_hora_titulo' => 'Titulo Agenda tu Hora',
            'agenda_hora_imagen' => 'Imagen Agenda tu Hora',
            'logo_1' => 'Logo de Landing Page',
            'logo_2' => 'Logo de Panel de Usuario',
        ];

        $message = [
            'required' => ':attribute es obligatorio.',
            'string' => ':attribute debe ser un texto',
            'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg',
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $index_data = LandingPageInicio::find(1);
            $index_data->titulo_bienvenida = $request->titulo_bienvenida;
            $index_data->agenda_hora_titulo = $request->agenda_hora_titulo;
            $index_data->agenda_hora_texto = $request->agenda_hora_texto;
            if ($request->hasFile('logo_1')) {
                if (isset($index_data->logo_1)) {
                    Storage::delete('public/images/logos/' . $index_data->logo_1);
                }
                $imagen_path = $request->file('logo_1');
                $filename = time() . '.' . $imagen_path->getClientOriginalExtension();
                $imagen_path->storeAs('public/images/logos', $filename);
                $index_data->logo_1 = $filename;
            }
            if ($request->hasFile('agenda_hora_imagen')) {
                if (isset($index_data->agenda_hora_imagen)) {
                    Storage::delete('public/images/' . $index_data->agenda_hora_imagen);
                }
                $imagen_path2 = $request->file('agenda_hora_imagen');
                $filename2 = time() . '2.' . $imagen_path2->getClientOriginalExtension();
                $imagen_path2->storeAs('public/images', $filename2);
                $index_data->agenda_hora_imagen = $filename2;
            }
            if ($request->hasFile('logo_2')) {
                if (isset($index_data->logo_2)) {
                    Storage::delete('public/images/logos/' . $index_data->logo_2);
                }
                $imagen_path3 = $request->file('logo_2');
                $filename3 = time() . '3.' . $imagen_path3->getClientOriginalExtension();
                $imagen_path3->storeAs('public/images/logos', $filename3);
                $index_data->logo_2 = $filename3;
            }
            $index_data->save();
            return redirect()->route('landing.website.edit')->with('success', 'La información de la website fue subido exitosamente');
        }
        return back()->withErrors($validator)->withInput();
    }
    public function add_photo_gallery(Request $request)
    {
        $rules = [
            'imagen' => 'required|mimes:jpg,jpeg,png',
            'titulo_imagen' => 'required|string',
        ];

        $attributes = [
            'imagen' => 'Imagen',
            'titulo_imagen' => 'Titulo de Imagen',
        ];

        $message = [
            'required' => ':attribute es obligatorio.',
            'string' => ':attribute debe ser un texto',
            'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg',
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $photo = new LandingPageGaleria();
            $imagen_path = $request->file('imagen');
            $filename = time() . '.' . $imagen_path->getClientOriginalExtension();
            $imagen_path->storeAs('public/images/galeria', $filename);
            $photo->imagen = $filename;
            $photo->titulo_imagen = $request->titulo_imagen;
            $photo->save();
            return redirect()->route('landing.website.edit')->with('success', 'La foto fue subido exitosamente');
        }
        return back()->withErrors($validator)->withInput();
    }
    public function delete_photo_gallery(Request $request)
    {

        $photo = LandingPageGaleria::find($request->id);
        Storage::delete($photo->imagen);
        $photo->delete();
        return redirect()->route('landing.website.edit')->with('success', 'La foto fue eliminado exitosamente');
    }
    public function update_aboutus(Request $request)
    {
        $rules = [
            'title1' => 'required|string',
            'title2' => 'required|string',
            'title3' => 'required|string',
            'paragraph1' => 'required|string',
            'paragraph2' => 'required|string',
            'paragraph3' => 'required|string',
            'image_1' => 'mimes:jpg,jpeg,png',
            'image_2' => 'mimes:jpg,jpeg,png',
        ];

        $attributes = [
            'title1' => 'Direccion',
            'title2' => 'Telefono',
            'title3' => 'Instagram',
            'paragraph1' => 'Parrafo 1',
            'paragraph2' => 'Parrafo 2',
            'paragraph3' => 'Parrafo 3',
            'image_1' => 'Imagen 1',
            'image_2' => 'Imagen 2',
        ];

        $message = [
            'required' => ':attribute es obligatorio.',
            'string' => ':attribute debe ser un texto',
            'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg',
        ];

        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $aboutUs = AboutUs::find(1);
            $aboutUs->title1 = $request->title1;
            $aboutUs->title2 = $request->title2;
            $aboutUs->title3 = $request->title3;
            $aboutUs->paragraph1 = $request->paragraph1;
            $aboutUs->paragraph2 = $request->paragraph2;
            $aboutUs->paragraph3 = $request->paragraph3;
            if ($request->hasFile('image_1')) {
                $imagen_path = $request->file('image_1');
                if (isset($aboutUs->image_1)) {
                    Storage::delete('public/images/aboutus/' . $aboutUs->image_1);
                }
                $filename = time() . '.' . $imagen_path->getClientOriginalExtension();
                $imagen_path->storeAs('public/images/aboutus', $filename);
                $aboutUs->image_1 = $filename;
            }
            if ($request->hasFile('image_2')) {
                $imagen_path2 = $request->file('image_2');
                $filename2 = time() . '2.' . $imagen_path2->getClientOriginalExtension();
                if (isset($aboutUs->image_2)) {
                    Storage::delete('public/images/aboutus/' . $aboutUs->image_2);
                }
                $imagen_path2->storeAs('public/images/aboutus', $filename2);
                $aboutUs->image_2 = $filename2;
            }
            $aboutUs->save();
            return redirect()->route('landing.nosotros.edit')->with('success', 'La sección "Nosotros" fueron modificado exitosamente');
        }
        return back()->withErrors($validator)->withInput();
    }
    public function update_landingpage_ubication(Request $request)
    {

        $rules = (new \App\Models\WhereYouCanFind())->rules;
        // dd($rules);
        $attributes = (new \App\Models\WhereYouCanFind())->attributes;
        $message = (new \App\Models\WhereYouCanFind())->message;

        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {

            try {

                $landingMaps = whereyoucanfind::find(1);
                $landingMaps->nombre = $request->nombre;
                $landingMaps->direccion = $request->direccion;
                $landingMaps->telefono = $request->telefono;
                $landingMaps->horario_header = $request->horario_header;
                $landingMaps->correo = $request->correo;
                $landingMaps->whatsapp = $request->whatsapp;
                $landingMaps->facebook = $request->facebook;
                $landingMaps->instagram = $request->instagram;
                $landingMaps->save();
                db::commit();
                return redirect()->route('landing.ubication.edit')->with('success', 'La información del sitio web fueron modificado exitosamente');
            } catch (QueryException $exception) {
                DB::rollBack();
                toastr()->error('Oops! Something went wrong!', 'Oops!');
                return back()->withInput();
            }
        }
        return back()->withErrors($validator)->withInput();
    }

    public function update_landingpage(Request $request)
    {

        $rules = (new \App\Models\landingpage_config())->rules;
        $attributes = (new \App\Models\landingpage_config())->attributes;
        $message = (new \App\Models\landingpage_config())->message;

        $validator = Validator::make($request->all(), $rules, $message, $attributes);

        if ($validator->passes()) {

            try {
                $landingMaps = landingpage_config::find(1);
                $landingMaps->aboutUs = $request->aboutUs;
                $landingMaps->save();
                db::commit();
                return redirect()->route('landing.ubication.edit')->with('success', 'Tus datos fueron modificado exitosamente');
            } catch (QueryException $exception) {
                DB::rollBack();
                toastr()->error('Oops! Something went wrong!', 'Oops!');
                return back()->withInput();
            }
        }
        return back()->withErrors($validator)->withInput();
    }
}
