<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    
    public function rules(): array
    {
        $id = $this->route('product') ? $this->route('product')->id : null;
        return [
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|max:255',
            'sku' => 'required|unique:products,sku,' . $id . '|max:100',
            'description' => 'nullable|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ];
    }
}
