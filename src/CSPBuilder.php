<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

use Stringable;

/**
 * CSPBuilder is a class that helps in creating and managing
 * Content Security Policy (CSP) for a web application.
 * It allows adding various types of directives and sources
 * to the policy.
 */
class CSPBuilder implements Stringable
{
    private ContentSecurityPolicy $csp;

    public function __construct()
    {
        $this->csp = new ContentSecurityPolicy([]);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function childSrc(array $sources): self
    {
        return $this->addPolicy(Directive::ChildSrc, $sources);
    }

    /**
     * Adds a new policy to the content security policy (CSP).
     *
     * @param Directive                            $directive The directive type for the policy.
     * @param array<int, non-empty-string|Keyword> $sources   The list of sources associated with the directive.
     *
     * @return $this Returns the instance of the class for method chaining.
     */
    private function addPolicy(Directive $directive, array $sources): self
    {
        $this->csp->add(new Policy($directive, $sources));
        return $this;
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function connectSrc(array $sources): self
    {
        return $this->addPolicy(Directive::ConnectSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function defaultSrc(array $sources): self
    {
        return $this->addPolicy(Directive::DefaultSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function fencedFrameSrc(array $sources): self
    {
        return $this->addPolicy(Directive::FencedFrameSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function fontSrc(array $sources): self
    {
        return $this->addPolicy(Directive::FontSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function frameSrc(array $sources): self
    {
        return $this->addPolicy(Directive::FrameSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function imgSrc(array $sources): self
    {
        return $this->addPolicy(Directive::ImgSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function manifestSrc(array $sources): self
    {
        return $this->addPolicy(Directive::ManifestSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function mediaSrc(array $sources): self
    {
        return $this->addPolicy(Directive::MediaSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function objectSrc(array $sources): self
    {
        return $this->addPolicy(Directive::ObjectSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function prefetchSrc(array $sources): self
    {
        return $this->addPolicy(Directive::PrefetchSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function scriptSrc(array $sources): self
    {
        return $this->addPolicy(Directive::ScriptSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function scriptSrcAttr(array $sources): self
    {
        return $this->addPolicy(Directive::ScriptSrcAttr, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function styleSrc(array $sources): self
    {
        return $this->addPolicy(Directive::StyleSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function styleSrcElem(array $sources): self
    {
        return $this->addPolicy(Directive::StyleSrcElem, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function styleSrcAttr(array $sources): self
    {
        return $this->addPolicy(Directive::StyleSrcAttr, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function workerSrc(array $sources): self
    {
        return $this->addPolicy(Directive::WorkerSrc, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function baseUri(array $sources): self
    {
        return $this->addPolicy(Directive::BaseUri, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function sandbox(array $sources): self
    {
        return $this->addPolicy(Directive::Sandbox, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function formAction(array $sources): self
    {
        return $this->addPolicy(Directive::FormAction, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function frameAncestors(array $sources): self
    {
        return $this->addPolicy(Directive::FrameAncestors, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function reportTo(array $sources): self
    {
        return $this->addPolicy(Directive::ReportTo, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function requireTrustedTypesFor(array $sources): self
    {
        return $this->addPolicy(Directive::RequireTrustedTypesFor, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function trustedTypes(array $sources): self
    {
        return $this->addPolicy(Directive::TrustedTypes, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function upgradeInsecureRequests(array $sources): self
    {
        return $this->addPolicy(Directive::UpgradeInsecureRequests, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function blockAllMixedContent(array $sources): self
    {
        return $this->addPolicy(Directive::BlockAllMixedContent, $sources);
    }

    /**
     * @param array<int, non-empty-string|Keyword> $sources
     *
     * @return $this
     */
    public function reportUri(array $sources): self
    {
        return $this->addPolicy(Directive::ReportUri, $sources);
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Converts the current CSP object to its string representation.
     *
     * @return string The serialized CSP string.
     */
    public function toString(): string
    {
        return (new CSPSerializer())->serialize($this->csp);
    }
}
