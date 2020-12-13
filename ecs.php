<?php

declare(strict_types=1);

//config for 9+
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [__DIR__ . '/src', __DIR__ . '/config', __DIR__ . '/ecs.php']);

    $parameters->set(
        Option::SETS,
        [
            SetList::SPACES,
            SetList::CLEAN_CODE,
            SetList::DEAD_CODE,
            SetList::ARRAY,
            SetList::COMMENTS,
            SetList::STRICT,
            SetList::NAMESPACES,
            SetList::CONTROL_STRUCTURES,
            SetList::PSR_12,
            SetList::PHP_70,
            SetList::PHP_71,
        ]
    );
};

/*
// config for 8+
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $containerConfigurator): void
{
    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/clean-code.php');
    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/dead-code.php');
    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/psr12.php');
    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/php70.php');
    $containerConfigurator->import(__DIR__ . '/vendor/symplify/easy-coding-standard/config/set/php71.php');

    $services = $containerConfigurator->services();

    $services->set(\SlevomatCodingStandard\Sniffs\Variables\UselessVariableSniff::class);
    $services->set(\SlevomatCodingStandard\Sniffs\Functions\UnusedInheritedVariablePassedToClosureSniff::class);
    $services->set(\SlevomatCodingStandard\Sniffs\PHP\UselessSemicolonSniff::class);
    $services->set(\SlevomatCodingStandard\Sniffs\PHP\UselessParenthesesSniff::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer::class)
        ->call('configure', [['syntax' => 'short']]);
    $services->set(\PhpCsFixer\Fixer\Import\NoUnusedImportsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Import\OrderedImportsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\ProtectedToPrivateFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\NoUnneededCurlyBracesFixer::class);
    $services->set(\SlevomatCodingStandard\Sniffs\ControlStructures\RequireShortTernaryOperatorSniff::class);
    $services->set(\SlevomatCodingStandard\Sniffs\Operators\RequireCombinedAssignmentOperatorSniff::class);

    $containerConfigurator->parameters();
};
*/