<?php

namespace App\Services;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class MedicineService
{
    /**
     * Get all medicines
     */
    public function getAll()
    {
        return Medicine::orderBy('created_at', 'desc')->get();
    }

    /**
     * Get single medicine by ID with reviews
     */
    public function getById(int $id)
    {
        return Medicine::with('reviews')->findOrFail($id);
    }

    /**
     * Create a new medicine
     * Accepts Request object or plain array
     */
    public function create($input): Medicine
    {
        $data = $this->normalizeInput($input);

        // Handle image if present
        if (isset($input['image']) || ($input instanceof Request && $input->hasFile('image'))) {
            $file = $input instanceof Request ? $input->file('image') : $input['image'];
            $data['image'] = $this->uploadImage($file);
        }

        return Medicine::create($data);
    }

    /**
     * Update existing medicine
     * Accepts Request object or plain array
     */
    public function update(Medicine $medicine, $input): Medicine
    {
        $data = $this->normalizeInput($input);

        if (isset($input['image']) || ($input instanceof Request && $input->hasFile('image'))) {
            // Delete old image if exists
            if ($medicine->image && Storage::disk('public')->exists($medicine->image)) {
                Storage::disk('public')->delete($medicine->image);
            }

            $file = $input instanceof Request ? $input->file('image') : $input['image'];
            $data['image'] = $this->uploadImage($file);
        }

        $medicine->update($data);

        return $medicine;
    }

    /**
     * Delete a medicine and its image
     */
    public function delete(Medicine $medicine): bool
    {
        if ($medicine->image && Storage::disk('public')->exists($medicine->image)) {
            Storage::disk('public')->delete($medicine->image);
        }

        return $medicine->delete();
    }

    /**
     * Search medicines by query
     */
    public function search(string $query)
    {
        return Medicine::where('name', 'LIKE', "%{$query}%")
                       ->orWhere('category', 'LIKE', "%{$query}%")
                       ->limit(10)
                       ->get(['id', 'name', 'category', 'price', 'image']);
    }

    /* -------------------
       Helper Methods
       ------------------- */

    /**
     * Normalize input: Request or array to plain array
     */
    protected function normalizeInput($input): array
    {
        if ($input instanceof Request) {
            return $input->only(['name', 'category', 'price', 'description']);
        }

        // Plain array
        return [
            'name' => $input['name'] ?? null,
            'category' => $input['category'] ?? null,
            'price' => $input['price'] ?? 0,
            'description' => $input['description'] ?? null,
        ];
    }

    /**
     * Handle image upload
     */
    protected function uploadImage($image): string
    {
        return $image->store('medicines', 'public');
    }
}
