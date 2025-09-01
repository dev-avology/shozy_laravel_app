<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function index()
    {
        // For now, return a simple view with placeholder data
        // In a real application, you would have an Attribute model
        $attributes = collect([
            (object) [
                'id' => 1,
                'name' => 'Color',
                'type' => 'select',
                'values' => ['Red', 'Blue', 'Green', 'Black', 'White'],
                'is_required' => true,
                'is_active' => true,
                'created_at' => now(),
            ],
            (object) [
                'id' => 2,
                'name' => 'Size',
                'type' => 'select',
                'values' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
                'is_required' => true,
                'is_active' => true,
                'created_at' => now(),
            ],
            (object) [
                'id' => 3,
                'name' => 'Material',
                'type' => 'text',
                'values' => [],
                'is_required' => false,
                'is_active' => true,
                'created_at' => now(),
            ],
        ]);

        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        $attributeTypes = [
            'text' => 'Text Input',
            'textarea' => 'Text Area',
            'select' => 'Dropdown Select',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio Buttons',
            'number' => 'Number Input',
            'date' => 'Date Picker',
        ];

        return view('admin.attributes.create', compact('attributeTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,textarea,select,checkbox,radio,number,date',
            'values' => 'nullable|array',
            'is_required' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // In a real application, you would save to database
        // For now, just redirect with success message
        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute created successfully!');
    }

    public function show($id)
    {
        // Placeholder attribute data
        $attribute = (object) [
            'id' => $id,
            'name' => 'Sample Attribute',
            'type' => 'select',
            'values' => ['Value 1', 'Value 2', 'Value 3'],
            'is_required' => true,
            'is_active' => true,
            'created_at' => now(),
        ];

        return view('admin.attributes.show', compact('attribute'));
    }

    public function edit($id)
    {
        // Placeholder attribute data
        $attribute = (object) [
            'id' => $id,
            'name' => 'Sample Attribute',
            'type' => 'select',
            'values' => ['Value 1', 'Value 2', 'Value 3'],
            'is_required' => true,
            'is_active' => true,
        ];

        $attributeTypes = [
            'text' => 'Text Input',
            'textarea' => 'Text Area',
            'select' => 'Dropdown Select',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio Buttons',
            'number' => 'Number Input',
            'date' => 'Date Picker',
        ];

        return view('admin.attributes.edit', compact('attribute', 'attributeTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,textarea,select,checkbox,radio,number,date',
            'values' => 'nullable|array',
            'is_required' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // In a real application, you would update in database
        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute updated successfully!');
    }

    public function destroy($id)
    {
        // In a real application, you would delete from database
        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute deleted successfully!');
    }
}
