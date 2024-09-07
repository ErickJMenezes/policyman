<?php

declare(strict_types=1);

namespace ErickJMenezes\Policyman;

use ErickJMenezes\PolicymanParser\LexerInterface;

/**
 * The CSPLexer class implements the LexerInterface to tokenize a Content-Security-Policy (CSP) string.
 */
final class CSPLexer implements LexerInterface
{
    /**
     * @var array<int, string>
     */
    private readonly array $words;
    private int $currentIndex = -1;
    private ?string $tokenizedValue = null;
    private readonly int $maxIndex;
    /**
     * @var array<int, string>
     */
    private array $errorMessages = [];

    public function __construct(string $input)
    {
        $this->words = $this->separateWords($input);
        $this->maxIndex = count($this->words) - 1;
    }

    /**
     * Separates the given input string into an array of words and semicolon characters.
     *
     * @param string $input The input string to be separated.
     *
     * @return array<int, string> An array containing words and semicolon characters.
     */
    private function separateWords(string $input): array
    {
        $words = preg_split(
            '/\s+/',
            trim(preg_replace('/[\'"]]/', "'", $input)),
        );
        $cleanWords = [];
        foreach ($words as $word) {
            preg_match('/([^;]*)(;*)/', $word, $result);
            $cleanWords = [...$cleanWords, $result[1], ...array_fill(0, mb_strlen($result[2]), ';')];
        }
        return $cleanWords;
    }

    /**
     * Retrieves the tokenized value.
     *
     * @return string|null The tokenized value stored in the instance.
     */
    public function getLVal(): ?string
    {
        return $this->tokenizedValue;
    }

    /**
     * Lexical analyzer function that processes the input and returns the next token.
     *
     * @return int The token type or end-of-file indicator.
     */
    public function yylex(): int
    {
        if ($this->currentIndex === $this->maxIndex) {
            return self::YYEOF;
        }
        $this->tokenizedValue = $this->next();
        return $this->tokenize($this->tokenizedValue);
    }

    /**
     * Advances the current index and returns the next word in the list.
     *
     * @return string The next word in the list.
     */
    private function next(): string
    {
        return $this->words[++$this->currentIndex];
    }

    /**
     * Tokenizes a given word and returns its corresponding token identifier.
     *
     * @param string $word The word to be tokenized.
     *
     * @return int The token identifier for the given word.
     */
    private function tokenize(string $word): int
    {
        return match (mb_strtolower($word)) {
            // main
            "content-security-policy:" => self::T_CSP,
            // keywords
            Keyword::Self->value => self::T_SELF,
            Keyword::None->value => self::T_NONE,
            Keyword::StrictDynamic->value => self::T_STRICT_DYNAMIC,
            Keyword::ReportSample->value => self::T_REPORT_SAMPLE,
            Keyword::InlineSpeculationRules->value => self::T_INLINE_SPECULATION_RULES,
            Keyword::UnsafeInline->value => self::T_UNSAFE_INLINE,
            Keyword::UnsafeEval->value => self::T_UNSAFE_EVAL,
            Keyword::UnsafeHashes->value => self::T_UNSAFE_HASHES,
            Keyword::WasmUnsafeEval->value => self::T_WASM_UNSAFE_EVAL,
            // directives
            Directive::ChildSrc->value => self::T_CHILD_SRC,
            Directive::ConnectSrc->value => self::T_CONNECT_SRC,
            Directive::DefaultSrc->value => self::T_DEFAULT_SRC,
            Directive::FencedFrameSrc->value => self::T_FENCED_FRAME_SRC,
            Directive::FontSrc->value => self::T_FONT_SRC,
            Directive::FrameSrc->value => self::T_FRAME_SRC,
            Directive::ImgSrc->value => self::T_IMG_SRC,
            Directive::ManifestSrc->value => self::T_MANIFEST_SRC,
            Directive::MediaSrc->value => self::T_MEDIA_SRC,
            Directive::ObjectSrc->value => self::T_OBJECT_SRC,
            Directive::PrefetchSrc->value => self::T_PREFETCH_SRC,
            Directive::ScriptSrc->value => self::T_SCRIPT_SRC,
            Directive::ScriptSrcAttr->value => self::T_SCRIPT_SRC_ATTR,
            Directive::StyleSrc->value => self::T_STYLE_SRC,
            Directive::StyleSrcElem->value => self::T_STYLE_SRC_ELEM,
            Directive::StyleSrcAttr->value => self::T_STYLE_SRC_ATTR,
            Directive::WorkerSrc->value => self::T_WORKER_SRC,
            Directive::BaseUri->value => self::T_BASE_URI,
            Directive::Sandbox->value => self::T_SANDBOX,
            Directive::FormAction->value => self::T_FORM_ACTION,
            Directive::FrameAncestors->value => self::T_FRAME_ANCESTORS,
            Directive::ReportTo->value => self::T_REPORT_TO,
            Directive::RequireTrustedTypesFor->value => self::T_REQUIRE_TRUSTED_TYPES_FOR,
            Directive::TrustedTypes->value => self::T_TRUSTED_TYPES,
            Directive::UpgradeInsecureRequests->value => self::T_UPGRADE_INSECURE_REQUESTS,
            Directive::BlockAllMixedContent->value => self::T_BLOCK_ALL_MIXED_CONTENT,
            Directive::ReportUri->value => self::T_REPORT_URI,
            ';' => ord($word),
            default => self::T_USER_DEFINED_KEYWORD,
        };
    }

    public function yyerror(string $message): void
    {
        $this->errorMessages[] = "$message at index {$this->currentIndex}. Check value \"{$this->tokenizedValue}\".";
    }

    /**
     * @return array<int, string>
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }
}
