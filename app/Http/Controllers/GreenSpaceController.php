<?php

namespace App\Http\Controllers;

use App\Models\GreenSpace;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GreenSpaceController extends Controller
{
    public function index()
    {
        return GreenSpace::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'surface' => 'required|numeric',
            'availability' => 'boolean',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        return GreenSpace::create($validated);
    }

    public function show($id)
    {
        return GreenSpace::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $greenSpace = GreenSpace::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'surface' => 'sometimes|required|numeric',
            'availability' => 'boolean',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
        ]);
        $greenSpace->update($validated);

        return $greenSpace;
    }

    public function destroy($id)
    {
        $greenSpace = GreenSpace::findOrFail($id);
        $greenSpace->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function book(Request $request, $id)
    {
        try {
            $request->validate([
                'phone_number' => 'required|string|min:8|max:20',
            ]);

            $greenSpace = GreenSpace::findOrFail($id);

            if (! $greenSpace->availability) {
                return response()->json(['error' => 'This green space is not available'], 400);
            }

            $phoneNumber = $request->input('phone_number');
            $smsService = new SmsService;

            $formattedPhone = $smsService->formatPhoneNumber($phoneNumber);

            if (! $smsService->validatePhoneNumber($formattedPhone)) {
                return response()->json([
                    'error' => 'Format de numéro de téléphone invalide. Veuillez utiliser le format international (ex: +21612345678)',
                ], 400);
            }

            // Mettre à jour la disponibilité avant l'envoi
            $greenSpace->update(['availability' => false]);

            $smsResult = $smsService->sendBookingConfirmation(
                $formattedPhone,
                $greenSpace->name,
                $greenSpace->location
            );

            $response = [
                'message' => 'Green space booked successfully',
                'greenSpace' => $greenSpace,
                'sms_sent' => (bool) ($smsResult['ok'] ?? false),
            ];

            if (! ($smsResult['ok'] ?? false)) {
                $response['warning'] = 'La réservation a été effectuée mais l\'envoi du SMS a échoué.';
                if (! empty($smsResult['error'])) {
                    $response['sms_error'] = $smsResult['error'];
                }
                Log::warning('SMS non envoyé pour la réservation', [
                    'green_space_id' => $greenSpace->id,
                    'to' => $formattedPhone,
                    'error' => $smsResult['error'] ?? null,
                ]);
            }

            return response()->json($response);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Données invalides',
                'details' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la réservation: '.$e->getMessage());

            return response()->json([
                'error' => 'Une erreur est survenue lors de la réservation',
            ], 500);
        }
    }
}
