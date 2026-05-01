<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'code',
        'category',
        'description',
        'unit_price',
        'unit',
        'tax_percent',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    /**
     * Autocomplete search — returns id, name, code, category, unit_price, unit, tax_percent.
     * Used by invoice form AJAX.
     */
    public function search(string $q, int $limit = 10, string $category = ''): array
    {
        $builder = $this->select('id, name, code, category, unit_price, unit, tax_percent')
            ->where('is_active', 1)
            ->groupStart()
            ->like('name', $q)
            ->orLike('code', $q)
            ->orLike('category', $q)
            ->groupEnd();

        if ($category !== '') {
            $builder = $builder->where('category', $category);
        }

        return $builder->orderBy('category')
            ->orderBy('name')
            ->limit($limit)
            ->findAll();
    }

    /**
     * All active categories for filter dropdown.
     */
    public function getCategories(): array
    {
        $rows = $this->select('category')
            ->where('is_active', 1)
            ->where('deleted_at IS NULL')
            ->distinct()
            ->orderBy('category')
            ->findAll();
        return array_column($rows, 'category');
    }
}