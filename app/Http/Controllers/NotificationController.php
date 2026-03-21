<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(string $id)
    {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();

        return response()->noContent();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->noContent();
    }
}
