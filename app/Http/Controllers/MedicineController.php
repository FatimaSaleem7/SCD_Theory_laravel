<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Services\MedicineService;
use Exception;

class MedicineController extends Controller
{
    protected $service;

    public function __construct(MedicineService $medicineService)
    {
        $this->service = $medicineService;
    }

    /* -------------------
       Web Admin Methods
       ------------------- */

    public function index()
    {
        $medicines = $this->service->getAll();
        return view('admin.medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view('admin.medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        try {
            $this->service->create($request);
            return redirect()->route('admin.medicines.index')
                             ->with('success','Medicine added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()
                             ->with('error','Error: '.$e->getMessage());
        }
    }

    public function edit(Medicine $medicine)
    {
        return view('admin.medicines.edit', compact('medicine'));
    }

    
        public function update(Medicine $medicine, array $data): Medicine
{
    // Image handling (optional)
    if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
        if ($medicine->image && Storage::disk('public')->exists($medicine->image)) {
            Storage::disk('public')->delete($medicine->image);
        }
        $data['image'] = $data['image']->store('medicines','public');
    }

    $medicine->update($data);

    return $medicine;
}


    public function destroy(Medicine $medicine)
    {
        try {
            $this->service->delete($medicine);
            return redirect()->route('admin.medicines.index')
                             ->with('success','Medicine deleted.');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Error: '.$e->getMessage());
        }
    }

    /* -------------------
       Frontend Methods
       ------------------- */

    public function showAllFrontend()
    {
        $medicines = $this->service->getAll();
        return view('pages.medicines', compact('medicines'));
    }

    public function showFrontend($id)
    {
        $product = $this->service->getById($id);
        return view('pages.medicinedetail', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if (empty($query)) {
            return response()->json([]);
        }

        $medicines = $this->service->search($query);

        return response()->json($medicines);
    }

    /* -------------------
       API Methods
       ------------------- */

    public function apiIndex()
    {
        return response()->json($this->service->getAll());
    }

    public function apiShow($id)
    {
        return response()->json($this->service->getById($id));
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'nullable|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $medicine = $this->service->create($request);

        return response()->json($medicine, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $medicine = $this->service->getById($id);

        $request->validate([
            'name' => 'sometimes|string',
            'category' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'description' => 'sometimes|string',
            'image' => 'sometimes|image|max:4096',
        ]);

        $this->service->update($medicine, $request);

        return response()->json($medicine);
    }

    public function apiDelete($id)
    {
        $medicine = $this->service->getById($id);
        $this->service->delete($medicine);

        return response()->json(['message' => 'Medicine deleted']);
    }
}
