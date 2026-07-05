<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfilePermission
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não autenticado.',
                'data' => null,
                'errors' => null,
            ], Response::HTTP_UNAUTHORIZED);
        }

        $actionName = $request->route()?->getActionName() ?? '';

        $permission = class_basename(
                str_contains($actionName, '@')
                    ? substr($actionName, 0, strrpos($actionName, '@'))
                    : $actionName
            ) . '@' . substr($actionName, strrpos($actionName, '@') + 1);

        $hasPermission = $user
            ->profiles()
            ->with('permissions')
            ->get()
            ->flatMap(fn($profile) => $profile->permissions)
            ->pluck('name')
            ->contains($permission);

        if (!$hasPermission) {
            return response()->json([
                'status' => 'error',
                'message' => "Acesso negado. Permissão requerida: {$permission}",
                'data' => null,
                'errors' => null,
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
