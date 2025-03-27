<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ValidationService
{
    public static function validate(array $data, array $rules, ?string $id = null): array
    {
        // Modify unique rules for update (ignore the current record)
        foreach ($rules as $field => $rule) {
            if (is_array($rule)) {
                foreach ($rule as $key => $value) {
                    if (strpos($value, 'unique:') === 0 && $id !== null) {
                        // Extract table name from "unique:table,column"
                        $ruleParts = explode(',', str_replace('unique:', '', $value));
                        $table = $ruleParts[0] ?? '';
                        $column = $ruleParts[1] ?? $field;
                        $rules[$field][$key] = "unique:$table,$column,$id";
                    }
                }
            } elseif (is_string($rule) && strpos($rule, 'unique:') === 0 && $id !== null) {
                $ruleParts = explode(',', str_replace('unique:', '', $rule));
                $table = $ruleParts[0] ?? '';
                $column = $ruleParts[1] ?? $field;
                $rules[$field] = "unique:$table,$column,$id";
            }
        }
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
