<?php

namespace App\Http\Controllers;

use App\Models\GreenSpace;
use App\Services\SmsService;
use Illuminate\Http\Request;

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
                'phone_number' => 'required|string|min:8|max:20'
            ]);

            $greenSpace = GreenSpace::findOrFail($id);

            if (!$greenSpace->availability) {
                return response()->json(['error' => 'This green space is not available'], 400);
            }

            $phoneNumber = $request->input('phone_number');
            $smsService = new SmsService();

            // Formater le numéro pour Twilio (validation sera faite dans le service)
            $formattedPhone = $smsService->formatPhoneNumber($phoneNumber);

            // Valider le format du numéro de téléphone après formatage
            if (!$smsService->validatePhoneNumber($formattedPhone)) {
                return response()->json([
                    'error' => 'Format de numéro de téléphone invalide. Veuillez utiliser le format international (ex: +21612345678)'
                ], 400);
            }

            // Mettre à jour la disponibilité
            $greenSpace->update(['availability' => false]);

            // Envoyer le SMS de confirmation
            $smsSent = $smsService->sendBookingConfirmation(
                $formattedPhone,
                $greenSpace->name,
                $greenSpace->location
            );

            $response = [
                'message' => 'Green space booked successfully',
                'greenSpace' => $greenSpace,
                'sms_sent' => $smsSent
            ];

            if (!$smsSent) {
                $response['warning'] = 'La réservation a été effectuée mais l\'envoi du SMS a échoué.';
            }

            return response()->json($response);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Données invalides',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la réservation: ' . $e->getMessage());
            return response()->json([
                'error' => 'Une erreur est survenue lors de la réservation'
            ], 500);
        }
    }
}
