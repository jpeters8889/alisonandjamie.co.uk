<?php

$rules = [
    '@Symfony' => true,
    'array_syntax' => ['syntax' => 'short'],
    'no_empty_comment' => false,
    'ordered_imports' => [ 'sort_algorithm' => 'alpha' ],
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'yoda_style' => false,
    'declare_strict_types' => true,
    'no_superfluous_phpdoc_tags' => false,
    '@PSR2' => true,
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
    'trailing_comma_in_multiline_array' => true,
    'phpdoc_scalar' => true,
    'unary_operator_spaces' => true,
    'binary_operator_spaces' => true,
    'blank_line_before_statement' => [
        'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
    ],
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_var_without_name' => true,
    'class_attributes_separation' => [
        'elements' => [
            'method',
        ],
    ],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
        'keep_multiple_spaces_after_comma' => true,
    ],
    'single_trait_insert_per_statement' => true,
];

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules($rules);
