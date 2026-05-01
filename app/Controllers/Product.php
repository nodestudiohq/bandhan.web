<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController
{
    protected ProductModel $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function index(): string
    {
        $q = $this->request->getGet('q') ?? '';
        $category = $this->request->getGet('category') ?? '';
        $status = $this->request->getGet('status') ?? '';

        $builder = $this->model;

        if ($q) {
            $builder = $builder->groupStart()
                ->like('name', $q)->orLike('code', $q)->orLike('category', $q)
                ->groupEnd();
        }
        if ($category) {
            $builder = $builder->where('category', $category);
        }
        if ($status === 'active') {
            $builder = $builder->where('is_active', 1);
        } elseif ($status === 'inactive') {
            $builder = $builder->where('is_active', 0);
        }

        $products = $builder->orderBy('category')->orderBy('name')->findAll();
        $categories = $this->model->getCategories();

        return view('product/index', [
            'title' => 'Products & Services',
            'products' => $products,
            'categories' => $categories,
            'filters' => compact('q', 'category', 'status'),
        ]);
    }

    public function create(): string
    {
        return view('product/form', [
            'title' => 'Add Product',
            'product' => [],
            'categories' => $this->model->getCategories(),
            'editing' => false,
        ]);
    }

    public function store()
    {
        if (
            !$this->validate([
                'name' => 'required|min_length[2]',
                'unit_price' => 'required|decimal',
                'category' => 'required|min_length[2]',
            ])
        ) {
            return redirect()->back()->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $this->model->insert($this->buildData());
        return redirect()->to(base_url('products'))
            ->with('success', 'Product "' . $this->request->getPost('name') . '" added.');
    }

    public function edit(int $id): string
    {
        $product = $this->model->findOrFail($id);
        return view('product/form', [
            'title' => 'Edit Product',
            'product' => $product,
            'categories' => $this->model->getCategories(),
            'editing' => true,
        ]);
    }

    public function update(int $id)
    {
        $this->model->findOrFail($id);

        if (
            !$this->validate([
                'name' => 'required|min_length[2]',
                'unit_price' => 'required|decimal',
                'category' => 'required|min_length[2]',
            ])
        ) {
            return redirect()->back()->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $this->model->update($id, $this->buildData());
        return redirect()->to(base_url('products'))
            ->with('success', 'Product updated.');
    }

    public function toggleStatus(int $id)
    {
        $product = $this->model->findOrFail($id);
        $this->model->update($id, ['is_active' => $product['is_active'] ? 0 : 1]);
        return redirect()->back()
            ->with('success', '"' . $product['name'] . '" ' . ($product['is_active'] ? 'deactivated' : 'activated') . '.');
    }

    public function delete(int $id)
    {
        $product = $this->model->findOrFail($id);
        $this->model->delete($id);
        return redirect()->to(base_url('products'))
            ->with('success', '"' . $product['name'] . '" deleted.');
    }

    private function buildData(): array
    {
        $post = $this->request->getPost();
        // Allow custom typed category
        $category = trim($post['category_custom'] ?? '') ?: trim($post['category'] ?? '');

        return [
            'name' => trim($post['name']),
            'code' => trim($post['code'] ?? ''),
            'category' => $category,
            'description' => trim($post['description'] ?? ''),
            'unit_price' => (float) $post['unit_price'],
            'unit' => trim($post['unit'] ?? 'Nos'),
            'tax_percent' => (float) ($post['tax_percent'] ?? 0),
            'is_active' => isset($post['is_active']) ? 1 : 0,
        ];
    }
}