<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Service $service)
    {
        $serviceOffer = $service->serviceOffers()
            ->where('status', 'completed')
            ->first();

        $serviceRequest = $serviceOffer ? $serviceOffer->serviceRequest : null;

        // Создаем отзыв
        Review::create([
            'user_id' => auth()->id(),
            'service_id' => $service->id,
            'rating' => $request->rating,
            'service_request_id' => $serviceRequest ? $serviceRequest->id : null,
        ]);


        $service->update(['rating' => $service->averageRating()]);



            $serviceRequest->status = 'completed';
            $serviceRequest->save();

        $serviceRequest->refresh();
        return redirect()->route('client.requests')->with('status', 'Отзыв успешно добавлен!');
    }
}
