<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Service $service)
    {
        // Ищем соответствующий serviceOffer
        $serviceOffer = $service->serviceOffers()
            ->where('status', 'completed')
            ->where('service_request_id', $request->service_request_id) // получаем service_request_id из запроса
            ->where('service_id', $service->id) // фильтруем по текущему сервису
            ->first();

        // Проверяем, что мы нашли нужный оффер
        if (!$serviceOffer) {
            return redirect()->route('client.requests')->with('error', 'Nie można znaleźć kompletnej oferty usług dla tego żądania.');
        }

        $serviceRequest = $serviceOffer->serviceRequest; // Получаем связанный с этим оффером запрос

        // Создаем отзыв
        Review::create([
            'user_id' => auth()->id(),
            'service_id' => $service->id,
            'rating' => $request->rating,
            'service_request_id' => $serviceRequest ? $serviceRequest->id : null,
        ]);

        // Обновляем рейтинг сервиса
        $service->update(['rating' => $service->averageRating()]);

        // Обновляем статус serviceRequest на 'completed', если это возможно
        if ($serviceRequest) {
            $serviceRequest->status = 'completed';
            $serviceRequest->save();
        }

        return redirect()->route('client.requests')->with('status', 'Recenzja dodana pomyślnie!');
    }


}
