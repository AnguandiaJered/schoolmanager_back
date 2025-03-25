<?php

namespace Modules\Auth\App\resources\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $data = $this->resource->toArray();

        $data = array_merge($data,$this->getRoles());

        $data = array_merge($data,[
            'unreadNotificationsCount' => $this->unreadNotifications->count(),
            // 'unreadNotifications' => $this->unreadNotifications
        ]);

        return $data;
    }

    public function getRoles(): array
    {
        return [
            'roles' => $this->getRoleNames(),
            'permissions' => $this->getAllPermissions()->pluck('name')
        ];
    }
}
