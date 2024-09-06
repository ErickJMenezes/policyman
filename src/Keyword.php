<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

enum Keyword: string
{
    case Self = "self";
    case None = "none";
    case StrictDynamic = "strict-dynamic";
    case ReportSample = "report-sample";
    case InlineSpeculationRules = "inline-speculation-rules";
    case UnsafeInline = "unsafe-inline";
    case UnsafeEval = "unsafe-eval";
    case UnsafeHashes = "unsafe-hashes";
    case WasmUnsafeEval = "wasm-unsafe-eval";

    public function escaped(): string
    {
        return "'$this->value'";
    }
}
