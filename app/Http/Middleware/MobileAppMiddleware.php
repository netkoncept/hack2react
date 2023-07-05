<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MobileAppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     *
     * @return Response
     * @throws BindingResolutionException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('x-api-device') && $request->hasHeader('x-api-type')) {
            try {
                $deviceData = $this->prepareDeviceDataFromRequest($request);
                $request->attributes->add(['device' => $this->setDevice($deviceData)]);
                return $next($request);
            } catch (ModelNotFoundException) {
                return response()->json(['message' => 'Unauthorized', 'code' => 401], 401);
            }
        }

        return response()->json(['message' => 'Unauthorized', 'code' => 401], 401);
    }

    private function setDevice(array $deviceData)
    {
        $device = Device::where('uuid', $deviceData['uuid'])->first();

        $deviceData['last_used'] = date('Y-m-d H:i:s');

        if ($device) {
            $device->fill($deviceData);
            $device->save();
        } else {
            $device = new Device();
            $device->fill($deviceData);
            $device->save();
        }

        return $device;
    }

    private function prepareDeviceDataFromRequest(Request $request): array
    {
        return [
            'uuid' => $request->header('x-api-device'),
            'os' => $request->header('x-api-type'),
            'os_version' => $request->header('x-api-version', ''),
            'model' => $request->header('x-api-model', ''),
            'push_id' => $request->header('x-api-push', ''),
            'can_force_localization' => $request->header('x-api-can_force_localization', 0),
            'citizen' => $request->header('x-api-citizen', 0),
            'tourist' => $request->header('x-api-tourist', 0),
        ];
    }
}
