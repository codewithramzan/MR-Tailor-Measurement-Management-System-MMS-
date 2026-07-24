<?php

class Validator
{
    private $errors = [];

    public function required($field, $value, $label)
    {
        if (empty(trim($value))) {
            $this->errors[$field] = "$label is required.";
        }

        return $this;
    }

    public function phone($field, $value)
    {
        if (!empty($value) && !preg_match('/^[0-9]{11}$/', $value)) {
            $this->errors[$field] = "Phone number must be 11 digits.";
        }

        return $this;
    }
        public function numeric($field, $value, $label)
    {
        if (!empty($value) && !is_numeric($value)) {
            $this->errors[$field] = "$label must be a valid number.";
        }

        return $this;
    }

    public function min($field, $value, $min, $label)
    {
        if (!empty($value) && is_numeric($value) && $value < $min) {
            $this->errors[$field] = "$label must be at least $min.";
        }

        return $this;
    }

    public function max($field, $value, $length, $label)
    {
        if (strlen($value) > $length) {
            $this->errors[$field] = "$label must not exceed $length characters.";
        }

        return $this;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function first()
    {
        return reset($this->errors);
    }
}