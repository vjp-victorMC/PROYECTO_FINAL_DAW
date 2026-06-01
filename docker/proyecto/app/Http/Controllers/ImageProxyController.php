<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageProxyController extends Controller
{
    // Proxy simple para evitar problemas de CORS al cargar imágenes externas
    public function proxy(Request $request)
    {
        $url = $request->query('url');
        if (!$url) {
            return response()->json(['status' => 'error', 'message' => 'Parámetro url requerido'], 400);
        }

        // Validar que la URL sea http o https
        if (!preg_match('#^https?://#i', $url)) {
            return response()->json(['status' => 'error', 'message' => 'URL no válida'], 400);
        }

        try {
            // Realizamos la petición externa (timeout y seguir redirects)
            $res = Http::timeout(10)->withOptions(['verify' => false])->get($url);

            if (!$res->successful()) {
                return response()->json(['status' => 'error', 'message' => 'No se pudo obtener la imagen remota'], 502);
            }

            $contentType = $res->header('Content-Type', 'application/octet-stream');
            $body = $res->body();

            return response($body, 200)
                    ->header('Content-Type', $contentType)
                    ->header('Cache-Control', 'public, max-age=86400')
                    ->header('Access-Control-Allow-Origin', '*');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error al obtener la imagen: ' . $e->getMessage()], 500);
        }
    }
}
