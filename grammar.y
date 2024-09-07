%define api.parser.class {Parser}
%define api.namespace {ErickJMenezes\PolicymanParser}
%code imports {
use ErickJMenezes\Policyman\Directive;
use ErickJMenezes\Policyman\Keyword;
use ErickJMenezes\Policyman\Policy;
use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\FormatsErrorMessages;
}
%code parser {
    use FormatsErrorMessages;

    private ContentSecurityPolicy $csp;
    public function setCsp(ContentSecurityPolicy $csp): void { $this->csp = $csp; }
    public function getCsp(): ContentSecurityPolicy { return $this->csp; }
}

// Header name
%token T_CSP

// Directives
%token T_CHILD_SRC
%token T_CONNECT_SRC
%token T_DEFAULT_SRC
%token T_FENCED_FRAME_SRC
%token T_FONT_SRC
%token T_FRAME_SRC
%token T_IMG_SRC
%token T_MANIFEST_SRC
%token T_MEDIA_SRC
%token T_OBJECT_SRC
%token T_PREFETCH_SRC
%token T_SCRIPT_SRC
%token T_SCRIPT_SRC_ATTR
%token T_STYLE_SRC
%token T_STYLE_SRC_ELEM
%token T_STYLE_SRC_ATTR
%token T_WORKER_SRC
%token T_BASE_URI
%token T_SANDBOX
%token T_FORM_ACTION
%token T_FRAME_ANCESTORS
%token T_REPORT_TO
%token T_REQUIRE_TRUSTED_TYPES_FOR
%token T_TRUSTED_TYPES
%token T_UPGRADE_INSECURE_REQUESTS
%token T_BLOCK_ALL_MIXED_CONTENT
%token T_REPORT_URI

// Keywords
%token T_SELF
%token T_NONE
%token T_STRICT_DYNAMIC
%token T_REPORT_SAMPLE
%token T_INLINE_SPECULATION_RULES
%token T_UNSAFE_INLINE
%token T_UNSAFE_EVAL
%token T_UNSAFE_HASHES
%token T_WASM_UNSAFE_EVAL
%token T_USER_DEFINED_KEYWORD

%%
start
    : T_CSP policies { self::setCsp(new ContentSecurityPolicy($2)); }
    ;

policies
    :                       { $$ = []; }
    | policy                { $$ = [$1]; }
    | policy ';' policies   { $$ = [$1, ...$3]; }
    ;

policy
    : directive keywords { $$ = new Policy($1, $2); }
    ;

directive
    : T_CHILD_SRC { $$ = Directive::ChildSrc; }
    | T_CONNECT_SRC { $$ = Directive::ConnectSrc; }
    | T_DEFAULT_SRC { $$ = Directive::DefaultSrc; }
    | T_FENCED_FRAME_SRC { $$ = Directive::FencedFrameSrc; }
    | T_FONT_SRC { $$ = Directive::FontSrc; }
    | T_FRAME_SRC { $$ = Directive::FrameSrc; }
    | T_IMG_SRC { $$ = Directive::ImgSrc; }
    | T_MANIFEST_SRC { $$ = Directive::ManifestSrc; }
    | T_MEDIA_SRC { $$ = Directive::MediaSrc; }
    | T_OBJECT_SRC { $$ = Directive::ObjectSrc; }
    | T_PREFETCH_SRC { $$ = Directive::PrefetchSrc; }
    | T_SCRIPT_SRC { $$ = Directive::ScriptSrc; }
    | T_SCRIPT_SRC_ATTR { $$ = Directive::ScriptSrcAttr; }
    | T_STYLE_SRC { $$ = Directive::StyleSrc; }
    | T_STYLE_SRC_ELEM { $$ = Directive::StyleSrcElem; }
    | T_STYLE_SRC_ATTR { $$ = Directive::StyleSrcAttr; }
    | T_WORKER_SRC { $$ = Directive::WorkerSrc; }
    | T_BASE_URI { $$ = Directive::BaseUri; }
    | T_SANDBOX { $$ = Directive::Sandbox; }
    | T_FORM_ACTION { $$ = Directive::FormAction; }
    | T_FRAME_ANCESTORS { $$ = Directive::FrameAncestors; }
    | T_REPORT_TO { $$ = Directive::ReportTo; }
    | T_REQUIRE_TRUSTED_TYPES_FOR { $$ = Directive::RequireTrustedTypesFor; }
    | T_TRUSTED_TYPES { $$ = Directive::TrustedTypes; }
    | T_UPGRADE_INSECURE_REQUESTS { $$ = Directive::UpgradeInsecureRequests; }
    | T_BLOCK_ALL_MIXED_CONTENT { $$ = Directive::BlockAllMixedContent; }
    | T_REPORT_URI { $$ = Directive::ReportUri; }
    ;

keyword
    : T_SELF { $$ = Keyword::Self; }
    | T_NONE { $$ = Keyword::None; }
    | T_STRICT_DYNAMIC { $$ = Keyword::StrictDynamic; }
    | T_REPORT_SAMPLE { $$ = Keyword::ReportSample; }
    | T_INLINE_SPECULATION_RULES { $$ = Keyword::InlineSpeculationRules; }
    | T_UNSAFE_INLINE { $$ = Keyword::UnsafeInline; }
    | T_UNSAFE_EVAL { $$ = Keyword::UnsafeEval; }
    | T_UNSAFE_HASHES { $$ = Keyword::UnsafeHashes; }
    | T_WASM_UNSAFE_EVAL { $$ = Keyword::WasmUnsafeEval; }
    | T_USER_DEFINED_KEYWORD { $$ = $1; }
    ;

keywords
    : { $$ = []; }
    | keyword keywords { $$ = [$1, ...$2]; }
    ;
%%
