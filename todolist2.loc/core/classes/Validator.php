<?

class Validator
{
    protected $errors = [];

    protected $validatorList = ['required', 'min', 'max', 'email', 'match', 'in', 'no_spaces'];
    protected $data_items;

    protected $messages = [
        'required' => 'Поле :fieldname: обязательно для заполнения',
        'min' => 'Поле :fieldname: должно содержать не менее :rulevalue: символов',
        'max' => 'Поле :fieldname: должно содержать не более :rulevalue: символов',
        'email' => 'Поле :fieldname: должно быть электронной почтой',
        'match' => 'Поле :fieldname: должно совпадать с полем :rulevalue:',
        'in' => 'Поле :fieldname: должно быть одним из следующих значений: :rulevalue:',
        'no_spaces' => 'Поле :fieldname: не должно содержать пробелы',
    ];

    public function validate($data = [], $rules = [])
    {
        $this->data_items = $data;
        foreach ($data as $fieldname => $value) {
            if (in_array($fieldname, array_keys($rules))) {
                //нужно валидировать это поле
                $this->checkValidator([
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $rules[$fieldname],
                ]);
            }
        }
        return $this;
    }

    protected function checkValidator($field)
    {
        //dd($field);
        foreach ($field['rules'] as $rule => $ruleValue) {
            if (in_array($rule, $this->validatorList)) {
                $isValid = call_user_func_array([$this, $rule], [$field['value'], $ruleValue]);
                if (!$isValid) {
                    $errMessage = str_replace(
                        [':fieldname:', ':rulevalue:'],
                        [$field['fieldname'], $ruleValue],
                        $this->messages[$rule]
                    );
                    $this->addError($field['fieldname'], $errMessage);
                }
            }
        }
    }

    protected function addError($fieldname, $error)
    {
        $this->errors[$fieldname][] = $error;
    }

    //true - валидация пройдена
    protected function required($value, $ruleValue)
    {
        return !empty($value);
    }

    protected function min($value, $ruleValue)
    {
        return stl($value) >= $ruleValue;
    }

    protected function max($value, $ruleValue)
    {
        return stl($value) <= $ruleValue;
    }

    public function hasErrors()
    {
        //dump($this->errors);
        return !empty($this->errors);
    }

    public function listErrors($fieldname)
    {
        $errorsList = '';
        if (isset($this->errors[$fieldname])) {
            $errorsList .= "<div class='invalid-feedback d-block'><ul class='class='list-unstyled''>";

            foreach ($this->errors[$fieldname] as $errorMessage) {
                $errorsList .= "<li>{$errorMessage}</li>";
            }

            $errorsList .= "</ul></div>";
        }
        return $errorsList;


    }

    protected function email($value, $ruleValue) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function match($value, $ruleValue) {
        return $value === $this->data_items[$ruleValue];
    }

    protected function in($value, $ruleValue) {
        $allowedValues = explode(',', $ruleValue);
        return in_array($value, $allowedValues);
    }

    protected function no_spaces($value, $ruleValue) {
        return strpos($value, ' ') === false;
    }

    public function getErrors() {
        return $this->errors;
    }
}

    







