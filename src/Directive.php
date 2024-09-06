<?php

declare(strict_types=1);

namespace ErickJMenezes\Policyman;

enum Directive: string
{
    case ChildSrc = 'child-src';
    case ConnectSrc = 'connect-src';
    case DefaultSrc = 'default-src';
    case FencedFrameSrc = 'fenced-frame-src';
    case FontSrc = 'font-src';
    case FrameSrc = 'frame-src';
    case ImgSrc = 'img-src';
    case ManifestSrc = 'manifest-src';
    case MediaSrc = 'media-src';
    case ObjectSrc = 'object-src';
    case PrefetchSrc = 'prefetch-src';
    case ScriptSrc = 'script-src';
    case ScriptSrcAttr = 'script-src-attr';
    case StyleSrc = 'style-src';
    case StyleSrcElem = 'style-src-elem';
    case StyleSrcAttr = 'style-src-attr';
    case WorkerSrc = 'worker-src';
    case BaseUri = 'base-uri';
    case Sandbox = 'sandbox';
    case FormAction = 'form-action';
    case FrameAncestors = 'frame-ancestors';
    case ReportTo = 'report-to';
    case RequireTrustedTypesFor = 'require-trusted-types-for';
    case TrustedTypes = 'trusted-types';
    case UpgradeInsecureRequests = 'upgrade-insecure-requests';
    case BlockAllMixedContent = 'block-all-mixed-content';
    case ReportUri = 'report-uri';
}
