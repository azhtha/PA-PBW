<?php
namespace App\Core;

class Validator {
    protected $data;
    protected $errors = [];

    public function validate(array $data, array $rules) {
        $this->data = $data;

        foreach ($rules as $field => $rule) {
            $this->validateField($field, $rule);
        }

        return empty($this->errors);
    }

    protected function validateField($field, $rule) {
        $rules = explode('|', $rule);
        $value = $this->data[$field] ?? null;

        foreach ($rules as $r) {
            $this->applyRule($field, $value, trim($r));
        }
    }

    protected function applyRule($field, $value, $rule) {
        if (strpos($rule, ':') !== false) {
            [$ruleName, $params] = explode(':', $rule, 2);
        } else {
            $ruleName = $rule;
            $params = null;
        }

        switch ($ruleName) {
            case 'required':
                if (empty($value)) $this->addError($field, "Field {$field} is required");
                break;
            case 'email':
                if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "Field {$field} must be a valid email");
                }
                break;
            case 'min':
                if (strlen($value) < (int)$params) {
                    $this->addError($field, "Field {$field} must be at least {$params} characters");
                }
                break;
            case 'max':
                if (strlen($value) > (int)$params) {
                    $this->addError($field, "Field {$field} cannot exceed {$params} characters");
                }
                break;
            case 'numeric':
                if ($value && !is_numeric($value)) {
                    $this->addError($field, "Field {$field} must be numeric");
                }
                break;
        }
    }

    protected function addError($field, $message) {
        $this->errors[$field] = $message;
    }

    public function getErrors() {
        return $this->errors;
    }
}