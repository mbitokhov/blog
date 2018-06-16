<?php

require_once realpath(__DIR__.'/vendor/autoload.php');

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('storage')
    ->exclude('misc')
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setIndent('    ')
    ->setLineEnding("\n")
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PSR2' => true,
        '@PHP71Migration' => true,
        '@Symfony:risky' => true,
        '@PHP71Migration:risky' => true,

        // Disabling shitty rules

        // null === $foo but still allow for $foo === null
        'is_null' => [
            'use_yoda_style' => false
        ],
        // self explanatory
        'protected_to_private' => false,
        // 0 === $foo
        'yoda_style' => false,
        // Type hints function to return void
        'void_return' => false,
        // Stops declare(strict=1)
        'declare_strict_types' => false,

        // Enabling good rules

        // <?
        'no_short_echo_tag' => true,
        // self explanatory
        'array_indentation' => true, 
        // use imports ordering
        'ordered_imports' => [
            'sortAlgorithm' => 'length'
        ],
        // [] instead of array()
        'array_syntax' => [
            'syntax' => 'short'
        ],
        // Orders class elements
        'ordered_class_elements' => [
            'use_trait',
            'constant',
            'property',
            'construct',
            'destruct',
            'method',
            'magic',
        ],
        // stops `protected $foo = null` since it's null by default
        'no_null_property_initialization' => true,
        // stops # for comments
        'hash_to_slash_comment' => true,
        // multibyte functions instead
        'mb_str_functions' => true,
        // align stuff
        'binary_operator_spaces' => [
            'default' => 'align',
            'operators' => [
                '=>' => 'align',
                '=' => 'align',
            ]
        ],
        // `! true`
        'not_operator_with_successor_space' => true,
        // stop removing @return void
        'phpdoc_no_empty_return' => false,
        // stop adding dot
        'phpdoc_summary' => false,
        // stop removing @package
        'phpdoc_no_package' => false,


    ]);

