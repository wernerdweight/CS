<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use SlevomatCodingStandard\Sniffs\Arrays\TrailingArrayCommaSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassConstantVisibilitySniff;
use SlevomatCodingStandard\Sniffs\Classes\UnusedPrivateElementsSniff;
use SlevomatCodingStandard\Sniffs\Commenting\InlineDocCommentDeclarationSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\AssignmentInConditionSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowEqualOperatorsSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\LanguageConstructWithParenthesesSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\ReferenceThrowableOnlySniff;
use SlevomatCodingStandard\Sniffs\Namespaces\AlphabeticallySortedUsesSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\DisallowGroupUseSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\MultipleUsesPerLineSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseDoesNotStartWithBackslashSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UseFromSameNamespaceSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\LongTypeHintsSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullableTypeForNullDefaultValueSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSpacingSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSpacingSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\ArrayNotation\StandaloneLineInMultilineArrayFixer;
use Symplify\CodingStandard\Fixer\Commenting\ParamReturnAndVarTagMalformsFixer;
use Symplify\CodingStandard\Fixer\Commenting\RemoveEmptyDocBlockFixer;
use Symplify\CodingStandard\Fixer\Commenting\RemoveSuperfluousDocBlockWhitespaceFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Order\PropertyOrderByComplexityFixer;
use Symplify\CodingStandard\Fixer\Php\ClassStringToClassConstantFixer;
use Symplify\CodingStandard\Fixer\Property\ArrayPropertyDefaultValueFixer;
use Symplify\CodingStandard\Fixer\Solid\FinalInterfaceFixer;
use Symplify\CodingStandard\Fixer\Strict\BlankLineAfterStrictTypesFixer;
use Symplify\CodingStandard\Sniffs\Architecture\ExplicitExceptionSniff;
use Symplify\CodingStandard\Sniffs\CleanCode\ForbiddenReferenceSniff;
use Symplify\CodingStandard\Sniffs\CleanCode\ForbiddenStaticFunctionSniff;
use Symplify\CodingStandard\Sniffs\Commenting\AnnotationTypeExistsSniff;
use Symplify\CodingStandard\Sniffs\Commenting\VarConstantCommentSniff;
use Symplify\CodingStandard\Sniffs\ControlStructure\ForbiddenDoubleAssignSniff;
use Symplify\CodingStandard\Sniffs\ControlStructure\SprintfOverContactSniff;
use Symplify\CodingStandard\Sniffs\Debug\CommentedOutCodeSniff;
use Symplify\CodingStandard\Sniffs\Debug\DebugFunctionCallSniff;
use Symplify\CodingStandard\Sniffs\Naming\AbstractClassNameSniff;
use Symplify\CodingStandard\Sniffs\Naming\ClassNameSuffixByParentSniff;
use Symplify\CodingStandard\Sniffs\Naming\InterfaceNameSniff;
use Symplify\CodingStandard\Sniffs\Naming\TraitNameSniff;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../symplify/easy-coding-standard/config/set/psr12.php');

    $containerConfigurator->import(__DIR__ . '/../../../symplify/easy-coding-standard/config/set/symfony.php');

    $parameters = $containerConfigurator->parameters();

    $parameters->set('skip', [BlankLineAfterOpeningTagFixer::class => null, DeclareEqualNormalizeFixer::class => null, 'Symplify\CodingStandard\Sniffs\CleanCode\ForbiddenStaticFunctionSniff' => ['*/Composer/*Script*.php']]);

    $services = $containerConfigurator->services();

    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [['syntax' => 'short']]);

    $services->set(BlankLineBeforeStatementFixer::class)
        ->call('configure', [['statements' => ['declare']]]);

    $services->set(ConcatSpaceFixer::class)
        ->call('configure', [['spacing' => 'one']]);

    $services->set(IncrementStyleFixer::class)
        ->call('configure', [['style' => 'post']]);

    $services->set(PhpdocAlignFixer::class);

    $services->set(VisibilityRequiredFixer::class);

    $services->set(YodaStyleFixer::class);

    $services->set(CastSpacesFixer::class)
        ->call('configure', [['space' => 'none']]);

    $services->set(TrailingArrayCommaSniff::class);

    $services->set(ClassConstantVisibilitySniff::class);

    $services->set(UnusedPrivateElementsSniff::class);

    $services->set(InlineDocCommentDeclarationSniff::class);

    $services->set(GeneralPhpdocAnnotationRemoveFixer::class)
        ->call('configure', [['annotations' => ['author', 'created', 'version', 'package', 'copyright', 'license']]]);

    $services->set(AssignmentInConditionSniff::class);

    $services->set(DisallowEqualOperatorsSniff::class);

    $services->set(LanguageConstructWithParenthesesSniff::class);

    $services->set(DeadCatchSniff::class);

    $services->set(ReferenceThrowableOnlySniff::class);

    $services->set(AlphabeticallySortedUsesSniff::class);

    $services->set(DisallowGroupUseSniff::class);

    $services->set(MultipleUsesPerLineSniff::class);

    $services->set(UseDoesNotStartWithBackslashSniff::class);

    $services->set('SlevomatCodingStandard\Sniffs\Namespaces\UnusedUsesSniff')
        ->property('searchAnnotations', true);

    $services->set(UseFromSameNamespaceSniff::class);

    $services->set('SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff')
        ->property('newlinesCountBetweenOpenTagAndDeclare', 1)
        ->property('spacesCountAroundEqualsSign', 0);

    $services->set(LongTypeHintsSniff::class);

    $services->set(NullableTypeForNullDefaultValueSniff::class);

    $services->set(ParameterTypeHintSpacingSniff::class);

    $services->set(ReturnTypeHintSpacingSniff::class);

    $services->set('SlevomatCodingStandard\Sniffs\Classes\EmptyLinesAroundClassBracesSniff')
        ->property('linesCountAfterOpeningBrace', 0)
        ->property('linesCountBeforeClosingBrace', 0);

    $services->set(AnnotationTypeExistsSniff::class);

    $services->set(ParamReturnAndVarTagMalformsFixer::class);

    $services->set(PropertyOrderByComplexityFixer::class);

    $services->set(StandaloneLineInMultilineArrayFixer::class);

    $services->set(RemoveEmptyDocBlockFixer::class);

    $services->set(RemoveSuperfluousDocBlockWhitespaceFixer::class);

    $services->set(LineLengthFixer::class)
        ->call('configure', [['inline_short_lines' => false]]);

    $services->set(ClassStringToClassConstantFixer::class);

    $services->set(ArrayPropertyDefaultValueFixer::class);

    $services->set(BlankLineAfterStrictTypesFixer::class);

    $services->set(FinalInterfaceFixer::class);

    $services->set(ExplicitExceptionSniff::class);

    $services->set(ForbiddenReferenceSniff::class);

    $services->set(ForbiddenStaticFunctionSniff::class);

    $services->set(VarConstantCommentSniff::class);

    $services->set(ForbiddenDoubleAssignSniff::class);

    $services->set(SprintfOverContactSniff::class);

    $services->set(CommentedOutCodeSniff::class);

    $services->set(DebugFunctionCallSniff::class);

    $services->set(AbstractClassNameSniff::class);

    $services->set(ClassNameSuffixByParentSniff::class);

    $services->set(InterfaceNameSniff::class);

    $services->set(TraitNameSniff::class);
};
