<?php
/* A Bison parser, made by GNU Bison 3.8.2.  */

/* Skeleton implementation for Bison LALR(1) parsers in PHP

   Copyright (C) 2007-2015, 2018-2021 Free Software Foundation, Inc.

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <https://www.gnu.org/licenses/>.  */

/* As a special exception, you may create a larger work that contains
   part or all of the Bison parser skeleton and distribute that work
   under terms of your choice, so long as that work isn't itself a
   parser generator using the skeleton or a modified version thereof
   as a parser skeleton.  Alternatively, if you modify or redistribute
   the parser skeleton itself, you may (at your option) remove this
   special exception, which will cause the skeleton and the resulting
   Bison output files to be licensed under the GNU General Public
   License without this special exception.

   This special exception was added by the Free Software Foundation in
   version 2.2 of Bison.  */

/* DO NOT RELY ON FEATURES THAT ARE NOT DOCUMENTED in the manual,
   especially those whose name start with YY_ or yy_.  They are
   private implementation details that can be changed or removed.  */

namespace ErickJMenezes\PolicymanParser;



/* "%code imports" blocks.  */
/* "grammar.y":3  */

use ErickJMenezes\Policyman\Directive;
use ErickJMenezes\Policyman\Keyword;
use ErickJMenezes\Policyman\Policy;
use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\FormatsErrorMessages;

/* "lib/parser.php":52  */



/**
 * A Bison parser, automatically generated from <tt>grammar.y</tt>.
 *
 * @author LALR (1) parser skeleton written by Paolo Bonzini.
 * Port to PHP language was done by Anton Sukhachev <mrsuh6@gmail.com>.
 */

 /**
   * Communication interface between the scanner and the Bison-generated
   * parser <tt>Parser</tt>.
   */
interface LexerInterface {
    /* Token kinds.  */
    /** Token "end of file", to be returned by the scanner.  */
    public const YYEOF = 0;
    /** Token error, to be returned by the scanner.  */
    public const YYerror = 256;
    /** Token "invalid token", to be returned by the scanner.  */
    public const YYUNDEF = 257;
    /** Token T_CSP, to be returned by the scanner.  */
    public const T_CSP = 258;
    /** Token T_CHILD_SRC, to be returned by the scanner.  */
    public const T_CHILD_SRC = 259;
    /** Token T_CONNECT_SRC, to be returned by the scanner.  */
    public const T_CONNECT_SRC = 260;
    /** Token T_DEFAULT_SRC, to be returned by the scanner.  */
    public const T_DEFAULT_SRC = 261;
    /** Token T_FENCED_FRAME_SRC, to be returned by the scanner.  */
    public const T_FENCED_FRAME_SRC = 262;
    /** Token T_FONT_SRC, to be returned by the scanner.  */
    public const T_FONT_SRC = 263;
    /** Token T_FRAME_SRC, to be returned by the scanner.  */
    public const T_FRAME_SRC = 264;
    /** Token T_IMG_SRC, to be returned by the scanner.  */
    public const T_IMG_SRC = 265;
    /** Token T_MANIFEST_SRC, to be returned by the scanner.  */
    public const T_MANIFEST_SRC = 266;
    /** Token T_MEDIA_SRC, to be returned by the scanner.  */
    public const T_MEDIA_SRC = 267;
    /** Token T_OBJECT_SRC, to be returned by the scanner.  */
    public const T_OBJECT_SRC = 268;
    /** Token T_PREFETCH_SRC, to be returned by the scanner.  */
    public const T_PREFETCH_SRC = 269;
    /** Token T_SCRIPT_SRC, to be returned by the scanner.  */
    public const T_SCRIPT_SRC = 270;
    /** Token T_SCRIPT_SRC_ATTR, to be returned by the scanner.  */
    public const T_SCRIPT_SRC_ATTR = 271;
    /** Token T_STYLE_SRC, to be returned by the scanner.  */
    public const T_STYLE_SRC = 272;
    /** Token T_STYLE_SRC_ELEM, to be returned by the scanner.  */
    public const T_STYLE_SRC_ELEM = 273;
    /** Token T_STYLE_SRC_ATTR, to be returned by the scanner.  */
    public const T_STYLE_SRC_ATTR = 274;
    /** Token T_WORKER_SRC, to be returned by the scanner.  */
    public const T_WORKER_SRC = 275;
    /** Token T_BASE_URI, to be returned by the scanner.  */
    public const T_BASE_URI = 276;
    /** Token T_SANDBOX, to be returned by the scanner.  */
    public const T_SANDBOX = 277;
    /** Token T_FORM_ACTION, to be returned by the scanner.  */
    public const T_FORM_ACTION = 278;
    /** Token T_FRAME_ANCESTORS, to be returned by the scanner.  */
    public const T_FRAME_ANCESTORS = 279;
    /** Token T_REPORT_TO, to be returned by the scanner.  */
    public const T_REPORT_TO = 280;
    /** Token T_REQUIRE_TRUSTED_TYPES_FOR, to be returned by the scanner.  */
    public const T_REQUIRE_TRUSTED_TYPES_FOR = 281;
    /** Token T_TRUSTED_TYPES, to be returned by the scanner.  */
    public const T_TRUSTED_TYPES = 282;
    /** Token T_UPGRADE_INSECURE_REQUESTS, to be returned by the scanner.  */
    public const T_UPGRADE_INSECURE_REQUESTS = 283;
    /** Token T_BLOCK_ALL_MIXED_CONTENT, to be returned by the scanner.  */
    public const T_BLOCK_ALL_MIXED_CONTENT = 284;
    /** Token T_REPORT_URI, to be returned by the scanner.  */
    public const T_REPORT_URI = 285;
    /** Token T_SELF, to be returned by the scanner.  */
    public const T_SELF = 286;
    /** Token T_NONE, to be returned by the scanner.  */
    public const T_NONE = 287;
    /** Token T_STRICT_DYNAMIC, to be returned by the scanner.  */
    public const T_STRICT_DYNAMIC = 288;
    /** Token T_REPORT_SAMPLE, to be returned by the scanner.  */
    public const T_REPORT_SAMPLE = 289;
    /** Token T_INLINE_SPECULATION_RULES, to be returned by the scanner.  */
    public const T_INLINE_SPECULATION_RULES = 290;
    /** Token T_UNSAFE_INLINE, to be returned by the scanner.  */
    public const T_UNSAFE_INLINE = 291;
    /** Token T_UNSAFE_EVAL, to be returned by the scanner.  */
    public const T_UNSAFE_EVAL = 292;
    /** Token T_UNSAFE_HASHES, to be returned by the scanner.  */
    public const T_UNSAFE_HASHES = 293;
    /** Token T_WASM_UNSAFE_EVAL, to be returned by the scanner.  */
    public const T_WASM_UNSAFE_EVAL = 294;
    /** Token T_USER_DEFINED_KEYWORD, to be returned by the scanner.  */
    public const T_USER_DEFINED_KEYWORD = 295;




    /**
     * Method to retrieve the semantic value of the last scanned token.
     * @return mixed the semantic value of the last scanned token.
     */
     public function getLVal();

    /**
     * Entry point for the scanner.  Returns the token identifier corresponding
     * to the next token and prepares to return the semantic value
     * of the token.
     * @return int the token identifier corresponding to the next token.
     */
    public function yylex(): int;

    /**
     * Emit an errorin a user-defined way.
     *
     *
     * @param string $message The string for the error message.
     */
     public function yyerror(string $message): void;


  }




  /**
   * Information needed to get the list of expected tokens and to forge
   * a syntax error diagnostic.
   */
  class Context {
    public function __construct(Parser $parser, YYStack $stack, SymbolKind $token) {
      $this->yyparser = $parser;
      $this->yystack = $stack;
      $this->yytoken = $token;
    }

    private Parser $yyparser;
    private YYStack $yystack;


    /**
     * The symbol kind of the lookahead token.
     */
    public function getToken(): SymbolKind {
      return $this->yytoken;
    }

    private SymbolKind $yytoken;
    public const NTOKENS = Parser::YYNTOKENS;

    /**
     * Put in YYARG at most YYARGN of the expected tokens given the
     * current YYCTX, and return the number of tokens stored in YYARG.  If
     * YYARG is null, return the number of expected tokens (guaranteed to
     * be less than YYNTOKENS).
     * @param SymbolKind[] $yyarg
     */
    public function getExpectedTokens(array &$yyarg, int $yyoffset, int $yyargn): int {
      $yycount = $yyoffset;
      $yyn = $this->yyparser->yypact[$this->yystack->stateAt(0)];
      if (!$this->yyparser->yyPactValueIsDefault($yyn))
        {
          /* Start YYX at -YYN if negative to avoid negative
             indexes in YYCHECK.  In other words, skip the first
             -YYN actions for this state because they are default
             actions.  */
          $yyxbegin = $yyn < 0 ? -$yyn : 0;
          /* Stay within bounds of both yycheck and yytname.  */
          $yychecklim = Parser::YYLAST - $yyn + 1;
          $yyxend = $yychecklim < self::NTOKENS ? $yychecklim : self::NTOKENS;
          for ($yyx = $yyxbegin; $yyx < $yyxend; ++$yyx)
            if ($this->yyparser->yycheck[$yyx + $yyn] === $yyx && $yyx !== SymbolKind::S_YYerror
                && !$this->yyparser->yyTableValueIsError($this->yyparser->yytable[$yyx + $yyn]))
              {
                if ($yyarg === null)
                  $yycount += 1;
                else if ($yycount === $yyargn)
                  return 0; // FIXME: this is incorrect.
                else
                  $yyarg[$yycount++] = new SymbolKind($yyx);
              }
        }
      if ($yyarg !== null && $yycount === $yyoffset && $yyoffset < $yyargn)
        $yyarg[$yycount] = null;
      return $yycount - $yyoffset;
    }
  }

  class YYStack {
    private array $stateStack = [];
    private array $valueStack = [];

    public int $height = -1;

    /**
     * @param mixed $value
     */
    public function push(int $state, $value): void {
      $this->height++;

      $this->stateStack[$this->height] = $state;
      $this->valueStack[$this->height] = $value;
    }

    public function pop(int $num = 1): void {
      $this->height -= $num;
    }

    public function &stateAt(int $i): int {
      return $this->stateStack[$this->height - $i];
    }

    /**
     * @return mixed
     */
    public function &valueAt(int $i) {
      return $this->valueStack[$this->height - $i];
    }

    // Print the state stack on the debug stream.
    public function print($resource): void {
      fputs($resource,"Stack now");
      for ($i = 0; $i <= $this->height; $i++) {
        fputs($resource, ' ' . $this->stateStack[$i]);
      }
      fputs($resource, PHP_EOL);
    }
  }


  class SymbolKind
  {
    public const S_YYEOF = 0;      /* "end of file"  */
    public const S_YYerror = 1;    /* error  */
    public const S_YYUNDEF = 2;    /* "invalid token"  */
    public const S_T_CSP = 3;      /* T_CSP  */
    public const S_T_CHILD_SRC = 4; /* T_CHILD_SRC  */
    public const S_T_CONNECT_SRC = 5; /* T_CONNECT_SRC  */
    public const S_T_DEFAULT_SRC = 6; /* T_DEFAULT_SRC  */
    public const S_T_FENCED_FRAME_SRC = 7; /* T_FENCED_FRAME_SRC  */
    public const S_T_FONT_SRC = 8; /* T_FONT_SRC  */
    public const S_T_FRAME_SRC = 9; /* T_FRAME_SRC  */
    public const S_T_IMG_SRC = 10; /* T_IMG_SRC  */
    public const S_T_MANIFEST_SRC = 11; /* T_MANIFEST_SRC  */
    public const S_T_MEDIA_SRC = 12; /* T_MEDIA_SRC  */
    public const S_T_OBJECT_SRC = 13; /* T_OBJECT_SRC  */
    public const S_T_PREFETCH_SRC = 14; /* T_PREFETCH_SRC  */
    public const S_T_SCRIPT_SRC = 15; /* T_SCRIPT_SRC  */
    public const S_T_SCRIPT_SRC_ATTR = 16; /* T_SCRIPT_SRC_ATTR  */
    public const S_T_STYLE_SRC = 17; /* T_STYLE_SRC  */
    public const S_T_STYLE_SRC_ELEM = 18; /* T_STYLE_SRC_ELEM  */
    public const S_T_STYLE_SRC_ATTR = 19; /* T_STYLE_SRC_ATTR  */
    public const S_T_WORKER_SRC = 20; /* T_WORKER_SRC  */
    public const S_T_BASE_URI = 21; /* T_BASE_URI  */
    public const S_T_SANDBOX = 22; /* T_SANDBOX  */
    public const S_T_FORM_ACTION = 23; /* T_FORM_ACTION  */
    public const S_T_FRAME_ANCESTORS = 24; /* T_FRAME_ANCESTORS  */
    public const S_T_REPORT_TO = 25; /* T_REPORT_TO  */
    public const S_T_REQUIRE_TRUSTED_TYPES_FOR = 26; /* T_REQUIRE_TRUSTED_TYPES_FOR  */
    public const S_T_TRUSTED_TYPES = 27; /* T_TRUSTED_TYPES  */
    public const S_T_UPGRADE_INSECURE_REQUESTS = 28; /* T_UPGRADE_INSECURE_REQUESTS  */
    public const S_T_BLOCK_ALL_MIXED_CONTENT = 29; /* T_BLOCK_ALL_MIXED_CONTENT  */
    public const S_T_REPORT_URI = 30; /* T_REPORT_URI  */
    public const S_T_SELF = 31;    /* T_SELF  */
    public const S_T_NONE = 32;    /* T_NONE  */
    public const S_T_STRICT_DYNAMIC = 33; /* T_STRICT_DYNAMIC  */
    public const S_T_REPORT_SAMPLE = 34; /* T_REPORT_SAMPLE  */
    public const S_T_INLINE_SPECULATION_RULES = 35; /* T_INLINE_SPECULATION_RULES  */
    public const S_T_UNSAFE_INLINE = 36; /* T_UNSAFE_INLINE  */
    public const S_T_UNSAFE_EVAL = 37; /* T_UNSAFE_EVAL  */
    public const S_T_UNSAFE_HASHES = 38; /* T_UNSAFE_HASHES  */
    public const S_T_WASM_UNSAFE_EVAL = 39; /* T_WASM_UNSAFE_EVAL  */
    public const S_T_USER_DEFINED_KEYWORD = 40; /* T_USER_DEFINED_KEYWORD  */
    public const S_41_ = 41;       /* ';'  */
    public const S_YYACCEPT = 42;  /* $accept  */
    public const S_start = 43;     /* start  */
    public const S_policies = 44;  /* policies  */
    public const S_policy = 45;    /* policy  */
    public const S_directive = 46; /* directive  */
    public const S_keyword = 47;   /* keyword  */
    public const S_keywords = 48;  /* keywords  */


    private int $yycode;

    public function __construct(int $yycode) {
      $this->yycode = $yycode;
    }

    public function getCode(): int {
        return $this->yycode;
    }


    private const NAMES = array("\"end of file\"", "error", "\"invalid token\"", "T_CSP", "T_CHILD_SRC",
  "T_CONNECT_SRC", "T_DEFAULT_SRC", "T_FENCED_FRAME_SRC", "T_FONT_SRC",
  "T_FRAME_SRC", "T_IMG_SRC", "T_MANIFEST_SRC", "T_MEDIA_SRC",
  "T_OBJECT_SRC", "T_PREFETCH_SRC", "T_SCRIPT_SRC", "T_SCRIPT_SRC_ATTR",
  "T_STYLE_SRC", "T_STYLE_SRC_ELEM", "T_STYLE_SRC_ATTR", "T_WORKER_SRC",
  "T_BASE_URI", "T_SANDBOX", "T_FORM_ACTION", "T_FRAME_ANCESTORS",
  "T_REPORT_TO", "T_REQUIRE_TRUSTED_TYPES_FOR", "T_TRUSTED_TYPES",
  "T_UPGRADE_INSECURE_REQUESTS", "T_BLOCK_ALL_MIXED_CONTENT",
  "T_REPORT_URI", "T_SELF", "T_NONE", "T_STRICT_DYNAMIC",
  "T_REPORT_SAMPLE", "T_INLINE_SPECULATION_RULES", "T_UNSAFE_INLINE",
  "T_UNSAFE_EVAL", "T_UNSAFE_HASHES", "T_WASM_UNSAFE_EVAL",
  "T_USER_DEFINED_KEYWORD", "';'", "\$accept", "start", "policies",
  "policy", "directive", "keyword", "keywords", null);

    public function getName(): string {
        return trim(self::NAMES[$this->yycode], '"\'');
    }

  }




class Parser
{
  /** Version number for the Bison executable that generated this parser.  */
  public const BISON_VERSION = "3.8.2";

  /** Name of the skeleton that generated this parser.  */
  public const BISON_SKELETON = "vendor/mrsuh/php-bison-skeleton/src/php-skel.m4";

/* "%code parser" blocks.  */
/* "grammar.y":10  */

    use FormatsErrorMessages;

    private ContentSecurityPolicy $csp;
    public function setCsp(ContentSecurityPolicy $csp): void { $this->csp = $csp; }
    public function getCsp(): ContentSecurityPolicy { return $this->csp; }

/* "lib/parser.php":392  */






  /**
   * The object doing lexical analysis for us.
   */
  private LexerInterface $yylexer;




  /**
   * Instantiates the Bison-generated parser.
   * @param LexerInterface $lexer The scanner that will supply tokens to the parser.
   */
  public function __construct(LexerInterface $lexer)
  {

    $this->yylexer = $lexer;
    $this->yystack          = new YYStack();


  }




  private int $yynerrs = 0;

  /**
   * The number of syntax errors so far.
   */
  public function getNumberOfErrors(): int { return $this->yynerrs; }

  /**
   * Print an error message via the lexer.
   *
   * @param msg The error message.
   */
  public function yyerror(string $msg): void {
      $this->yylexer->yyerror($msg);
  }


  /**
   * Returned by a Bison action in order to stop the parsing process and
   * return success (<tt>true</tt>).
   */
  public const YYACCEPT = 0;

  /**
   * Returned by a Bison action in order to stop the parsing process and
   * return failure (<tt>false</tt>).
   */
  public const YYABORT = 1;



  /**
   * Returned by a Bison action in order to start error recovery without
   * printing an error message.
   */
  public const YYERROR = 2;

  /**
   * Internal return codes that are not supported for user semantic
   * actions.
   */
  private const YYERRLAB = 3;
  private const YYNEWSTATE = 4;
  private const YYDEFAULT = 5;
  private const YYREDUCE = 6;
  private const YYERRLAB1 = 7;
  private const YYRETURN = 8;


  private int $yyerrstatus = 0;

    /**
     * Lookahead token kind.
     */
    private int $yychar = Parser::YYEMPTY;
    /**
     * Lookahead symbol kind.
     */
    private ?SymbolKind $yytoken = null;

    /* State.  */
    private int $yyn     = 0;
    private int $yylen   = 0;
    private int $yystate = 0;
    private YYStack $yystack;
    private int $label = Parser::YYNEWSTATE;



    /**
     * Semantic value of the lookahead.
     * @var mixed
     */
    private $yylval = null;

  /**
   * Whether error recovery is being done.  In this state, the parser
   * reads token until it reaches a known state, and then restarts normal
   * operation.
   */
  public function recovering(): bool
  {
    return $this->yyerrstatus === 0;
  }

  /** Compute post-reduction state.
   * @param yystate   the current state
   * @param yysym     the nonterminal to push on the stack
   */
  private function yyLRGotoState(int $yystate, int $yysym): int {

    $yyr = $this->yypgoto[$yysym - Parser::YYNTOKENS] + $yystate;
    if (0 <= $yyr && $yyr <= Parser::YYLAST && $this->yycheck[$yyr] === $yystate)
      return $this->yytable[$yyr];
    else
      return $this->yydefgoto[$yysym - Parser::YYNTOKENS];
  }

  private function yyaction(int $yyn, YYStack $yystack, int $yylen): int
  {
    /* If YYLEN is nonzero, implement the default value of the action:
       '$$ = $1'.  Otherwise, use the top of the stack.

       Otherwise, the following line sets YYVAL to garbage.
       This behavior is undocumented and Bison
       users should not rely upon it.  */
     /** @var mixed $yyval */
     $yyval = (0 < $yylen) ? $yystack->valueAt($yylen - 1) : $yystack->valueAt(0);

    switch ($yyn)
      {
          case 2: /* start: T_CSP policies  */
    /* "grammar.y":64  */
                     { self::setCsp(new ContentSecurityPolicy($yystack->valueAt(0))); };
  break;


  case 3: /* policies: %empty  */
    /* "grammar.y":68  */
                            { $yyval = []; };
  break;


  case 4: /* policies: policy  */
    /* "grammar.y":69  */
                            { $yyval = [$yystack->valueAt(0)]; };
  break;


  case 5: /* policies: policy ';' policies  */
    /* "grammar.y":70  */
                            { $yyval = [$yystack->valueAt(2), ...$yystack->valueAt(0)]; };
  break;


  case 6: /* policy: directive keywords  */
    /* "grammar.y":74  */
                         { $yyval = new Policy($yystack->valueAt(1), $yystack->valueAt(0)); };
  break;


  case 7: /* directive: T_CHILD_SRC  */
    /* "grammar.y":78  */
                  { $yyval = Directive::ChildSrc; };
  break;


  case 8: /* directive: T_CONNECT_SRC  */
    /* "grammar.y":79  */
                    { $yyval = Directive::ConnectSrc; };
  break;


  case 9: /* directive: T_DEFAULT_SRC  */
    /* "grammar.y":80  */
                    { $yyval = Directive::DefaultSrc; };
  break;


  case 10: /* directive: T_FENCED_FRAME_SRC  */
    /* "grammar.y":81  */
                         { $yyval = Directive::FencedFrameSrc; };
  break;


  case 11: /* directive: T_FONT_SRC  */
    /* "grammar.y":82  */
                 { $yyval = Directive::FontSrc; };
  break;


  case 12: /* directive: T_FRAME_SRC  */
    /* "grammar.y":83  */
                  { $yyval = Directive::FrameSrc; };
  break;


  case 13: /* directive: T_IMG_SRC  */
    /* "grammar.y":84  */
                { $yyval = Directive::ImgSrc; };
  break;


  case 14: /* directive: T_MANIFEST_SRC  */
    /* "grammar.y":85  */
                     { $yyval = Directive::ManifestSrc; };
  break;


  case 15: /* directive: T_MEDIA_SRC  */
    /* "grammar.y":86  */
                  { $yyval = Directive::MediaSrc; };
  break;


  case 16: /* directive: T_OBJECT_SRC  */
    /* "grammar.y":87  */
                   { $yyval = Directive::ObjectSrc; };
  break;


  case 17: /* directive: T_PREFETCH_SRC  */
    /* "grammar.y":88  */
                     { $yyval = Directive::PrefetchSrc; };
  break;


  case 18: /* directive: T_SCRIPT_SRC  */
    /* "grammar.y":89  */
                   { $yyval = Directive::ScriptSrc; };
  break;


  case 19: /* directive: T_SCRIPT_SRC_ATTR  */
    /* "grammar.y":90  */
                        { $yyval = Directive::ScriptSrcAttr; };
  break;


  case 20: /* directive: T_STYLE_SRC  */
    /* "grammar.y":91  */
                  { $yyval = Directive::StyleSrc; };
  break;


  case 21: /* directive: T_STYLE_SRC_ELEM  */
    /* "grammar.y":92  */
                       { $yyval = Directive::StyleSrcElem; };
  break;


  case 22: /* directive: T_STYLE_SRC_ATTR  */
    /* "grammar.y":93  */
                       { $yyval = Directive::StyleSrcAttr; };
  break;


  case 23: /* directive: T_WORKER_SRC  */
    /* "grammar.y":94  */
                   { $yyval = Directive::WorkerSrc; };
  break;


  case 24: /* directive: T_BASE_URI  */
    /* "grammar.y":95  */
                 { $yyval = Directive::BaseUri; };
  break;


  case 25: /* directive: T_SANDBOX  */
    /* "grammar.y":96  */
                { $yyval = Directive::Sandbox; };
  break;


  case 26: /* directive: T_FORM_ACTION  */
    /* "grammar.y":97  */
                    { $yyval = Directive::FormAction; };
  break;


  case 27: /* directive: T_FRAME_ANCESTORS  */
    /* "grammar.y":98  */
                        { $yyval = Directive::FrameAncestors; };
  break;


  case 28: /* directive: T_REPORT_TO  */
    /* "grammar.y":99  */
                  { $yyval = Directive::ReportTo; };
  break;


  case 29: /* directive: T_REQUIRE_TRUSTED_TYPES_FOR  */
    /* "grammar.y":100  */
                                  { $yyval = Directive::RequireTrustedTypesFor; };
  break;


  case 30: /* directive: T_TRUSTED_TYPES  */
    /* "grammar.y":101  */
                      { $yyval = Directive::TrustedTypes; };
  break;


  case 31: /* directive: T_UPGRADE_INSECURE_REQUESTS  */
    /* "grammar.y":102  */
                                  { $yyval = Directive::UpgradeInsecureRequests; };
  break;


  case 32: /* directive: T_BLOCK_ALL_MIXED_CONTENT  */
    /* "grammar.y":103  */
                                { $yyval = Directive::BlockAllMixedContent; };
  break;


  case 33: /* directive: T_REPORT_URI  */
    /* "grammar.y":104  */
                   { $yyval = Directive::ReportUri; };
  break;


  case 34: /* keyword: T_SELF  */
    /* "grammar.y":108  */
             { $yyval = Keyword::Self; };
  break;


  case 35: /* keyword: T_NONE  */
    /* "grammar.y":109  */
             { $yyval = Keyword::None; };
  break;


  case 36: /* keyword: T_STRICT_DYNAMIC  */
    /* "grammar.y":110  */
                       { $yyval = Keyword::StrictDynamic; };
  break;


  case 37: /* keyword: T_REPORT_SAMPLE  */
    /* "grammar.y":111  */
                      { $yyval = Keyword::ReportSample; };
  break;


  case 38: /* keyword: T_INLINE_SPECULATION_RULES  */
    /* "grammar.y":112  */
                                 { $yyval = Keyword::InlineSpeculationRules; };
  break;


  case 39: /* keyword: T_UNSAFE_INLINE  */
    /* "grammar.y":113  */
                      { $yyval = Keyword::UnsafeInline; };
  break;


  case 40: /* keyword: T_UNSAFE_EVAL  */
    /* "grammar.y":114  */
                    { $yyval = Keyword::UnsafeEval; };
  break;


  case 41: /* keyword: T_UNSAFE_HASHES  */
    /* "grammar.y":115  */
                      { $yyval = Keyword::UnsafeHashes; };
  break;


  case 42: /* keyword: T_WASM_UNSAFE_EVAL  */
    /* "grammar.y":116  */
                         { $yyval = Keyword::WasmUnsafeEval; };
  break;


  case 43: /* keyword: T_USER_DEFINED_KEYWORD  */
    /* "grammar.y":117  */
                             { $yyval = $yystack->valueAt(0); };
  break;


  case 44: /* keywords: %empty  */
    /* "grammar.y":121  */
      { $yyval = []; };
  break;


  case 45: /* keywords: keyword keywords  */
    /* "grammar.y":122  */
                       { $yyval = [$yystack->valueAt(1), ...$yystack->valueAt(0)]; };
  break;



/* "lib/parser.php":799  */

        default: break;
      }

    $yystack->pop($yylen);
    $yylen = 0;
    /* Shift the result of the reduction.  */
    $yystate = $this->yyLRGotoState($yystack->stateAt(0), $this->yyr1[$yyn]);
    $yystack->push($yystate, $yyval);
    return Parser::YYNEWSTATE;
  }




  /**
   * Parse input from the scanner that was specified at object construction
   * time.  Return whether the end of the input was reached successfully.
   *
   * @return <tt>true</tt> if the parsing succeeds.  Note that this does not
   *          imply that there were no syntax errors.
   */
  public function parse(): bool

  {




    $this->yyerrstatus = 0;
    $this->yynerrs = 0;

    /* Initialize the stack.  */
    $this->yystack->push($this->yystate, $this->yylval);



    for (;;)
      switch ($this->label)
      {
        /* New state.  Unlike in the C/C++ skeletons, the state is already
           pushed when we come here.  */
      case Parser::YYNEWSTATE:

        /* Accept?  */
        if ($this->yystate === Parser::YYFINAL) {
          return true;
        }

        /* Take a decision.  First try without lookahead.  */
        $this->yyn = $this->yypact[$this->yystate];
        if ($this->yyPactValueIsDefault($this->yyn))
          {
            $this->label = Parser::YYDEFAULT;
            break;
          }

        /* Read a lookahead token.  */
        if ($this->yychar === Parser::YYEMPTY)
          {

            $this->yychar = $this->yylexer->yylex();
            $this->yylval = $this->yylexer->getLVal();

          }

        /* Convert token to internal form.  */
        $this->yytoken = $this->yytranslate($this->yychar);

        if ($this->yytoken->getCode() === SymbolKind::S_YYerror)
          {
            // The scanner already issued an error message, process directly
            // to error recovery.  But do not keep the error token as
            // lookahead, it is too special and may lead us to an endless
            // loop in error recovery. */
            $this->yychar = LexerInterface::YYUNDEF;
            $this->yytoken = new SymbolKind(SymbolKind::S_YYUNDEF);
            $this->label = Parser::YYERRLAB1;
          }
        else
          {
            /* If the proper action on seeing token YYTOKEN is to reduce or to
               detect an error, take that action.  */
            $this->yyn += $this->yytoken->getCode();
            if ($this->yyn < 0 || Parser::YYLAST < $this->yyn || $this->yycheck[$this->yyn] !== $this->yytoken->getCode()) {
              $this->label = Parser::YYDEFAULT;
            }

            /* <= 0 means reduce or error.  */
            else if (($this->yyn = $this->yytable[$this->yyn]) <= 0)
              {
                if ($this->yyTableValueIsError($this->yyn)) {
                  $this->label = Parser::YYERRLAB;
                } else {
                  $this->yyn = -$this->yyn;
                  $this->label = Parser::YYREDUCE;
                }
              }

            else
              {
                /* Shift the lookahead token.  */
                /* Discard the token being shifted.  */
                $this->yychar = Parser::YYEMPTY;

                /* Count tokens shifted since error; after three, turn off error
                   status.  */
                if ($this->yyerrstatus > 0)
                  --$this->yyerrstatus;

                $this->yystate = $this->yyn;
                $this->yystack->push($this->yystate, $this->yylval);
                $this->label = Parser::YYNEWSTATE;
              }
          }
        break;

      /*-----------------------------------------------------------.
      | yydefault -- do the default action for the current state.  |
      `-----------------------------------------------------------*/
      case Parser::YYDEFAULT:
        $this->yyn = $this->yydefact[$this->yystate];
        if ($this->yyn === 0)
          $this->label = Parser::YYERRLAB;
        else
          $this->label = Parser::YYREDUCE;
        break;

      /*-----------------------------.
      | yyreduce -- Do a reduction.  |
      `-----------------------------*/
      case Parser::YYREDUCE:
        $this->yylen = $this->yyr2[$this->yyn];
        $this->label = $this->yyaction($this->yyn, $this->yystack, $this->yylen);
        $this->yystate = $this->yystack->stateAt(0);
        break;

      /*------------------------------------.
      | yyerrlab -- here on detecting error |
      `------------------------------------*/
      case Parser::YYERRLAB:
        /* If not already recovering from an error, report this error.  */
        if ($this->yyerrstatus === 0)
          {
            ++$this->yynerrs;
            if ($this->yychar === Parser::YYEMPTY) {
              $this->yytoken = null;
            }
            $this->yyreportSyntaxError(new Context($this, $this->yystack, $this->yytoken));
          }

        if ($this->yyerrstatus === 3)
          {
            /* If just tried and failed to reuse lookahead token after an
               error, discard it.  */

            if ($this->yychar <= LexerInterface::YYEOF)
              {
                /* Return failure if at end of input.  */
                if ($this->yychar === LexerInterface::YYEOF) {
                  return false;
                }
              }
            else
              $this->yychar = Parser::YYEMPTY;
          }

        /* Else will try to reuse lookahead token after shifting the error
           token.  */
        $this->label = Parser::YYERRLAB1;
        break;

      /*-------------------------------------------------.
      | errorlab -- error raised explicitly by YYERROR.  |
      `-------------------------------------------------*/
      case Parser::YYERROR:
        /* Do not reclaim the symbols of the rule which action triggered
           this YYERROR.  */
        $this->yystack->pop($this->yylen);
        $this->yylen = 0;
        $this->yystate = $this->yystack->stateAt(0);
        $this->label = Parser::YYERRLAB1;
        break;

      /*-------------------------------------------------------------.
      | yyerrlab1 -- common code for both syntax error and YYERROR.  |
      `-------------------------------------------------------------*/
      case Parser::YYERRLAB1:
        $this->yyerrstatus = 3;       /* Each real token shifted decrements this.  */

        // Pop stack until we find a state that shifts the error token.
        for (;;)
          {
            $this->yyn = $this->yypact[$this->yystate];
            if (!$this->yyPactValueIsDefault($this->yyn))
              {
                $this->yyn += SymbolKind::S_YYerror;
                if (0 <= $this->yyn && $this->yyn <= Parser::YYLAST
                    && $this->yycheck[$this->yyn] === SymbolKind::S_YYerror)
                  {
                    $this->yyn = $this->yytable[$this->yyn];
                    if (0 < $this->yyn)
                      break;
                  }
              }

            /* Pop the current state because it cannot handle the
             * error token.  */
            if ($this->yystack->height === 0) {
              return false;
            }


            $this->yystack->pop();
            $this->yystate = $this->yystack->stateAt(0);
          }

        if ($this->label === Parser::YYABORT)
          /* Leave the switch.  */
          break;



        /* Shift the error token.  */

        $this->yystate = $this->yyn;
        $this->yystack->push($this->yyn, $this->yylval);
        $this->label = Parser::YYNEWSTATE;
        break;

        /* Accept.  */
      case Parser::YYACCEPT:
        return true;

        /* Abort.  */
      case Parser::YYABORT:
        return false;
      }
}








  /**
   * Build and emit a "syntax error" message in a user-defined way.
   *
   * @param ctx  The context of the error.
   */
  private function yyreportSyntaxError(Context $yyctx): void {
      $this->yyerror($this->buildErrorMessage($yyctx));
  }

  /**
   * Whether the given <code>yypact_</code> value indicates a defaulted state.
   * @param yyvalue   the value to check
   */
  public function yyPactValueIsDefault(int $yyvalue): bool {
    return $yyvalue === $this->yypact_ninf;
  }

  /**
   * Whether the given <code>yytable_</code>
   * value indicates a syntax error.
   * @param yyvalue the value to check
   */
  public function yyTableValueIsError(int $yyvalue): bool {
    return $yyvalue === $this->yytable_ninf;
  }

  public int $yypact_ninf = -5;
  public int $yytable_ninf = -1;

/* YYPACT[STATE-NUM] -- Index in YYTABLE of the portion describing
   STATE-NUM.  */

  /** @var int[] */
  public array $yypact = array(    24,    -4,    38,    -5,    -5,    -5,    -5,    -5,    -5,    -5,
      -5,    -5,    -5,    -5,    -5,    -5,    -5,    -5,    -5,    -5,
      -5,    -5,    -5,    -5,    -5,    -5,    -5,    -5,    -5,    -5,
      -5,    -2,    -3,    -5,    -4,    -5,    -5,    -5,    -5,    -5,
      -5,    -5,    -5,    -5,    -5,    -3,    -5,    -5,    -5);


/* YYDEFACT[STATE-NUM] -- Default reduction number in state STATE-NUM.
   Performed when YYTABLE does not specify something else to do.  Zero
   means the default is an error.  */

  /** @var int[] */
  public array $yydefact = array(     0,     3,     0,     7,     8,     9,    10,    11,    12,    13,
      14,    15,    16,    17,    18,    19,    20,    21,    22,    23,
      24,    25,    26,    27,    28,    29,    30,    31,    32,    33,
       2,     4,    44,     1,     3,    34,    35,    36,    37,    38,
      39,    40,    41,    42,    43,    44,     6,     5,    45);


/* YYPGOTO[NTERM-NUM].  */

  /** @var int[] */
  public array $yypgoto = array(    -5,    -5,     6,    -5,    -5,    -5,    -1);


/* YYDEFGOTO[NTERM-NUM].  */

  /** @var int[] */
  public array $yydefgoto = array(     0,     2,    30,    31,    32,    45,    46);


/* YYTABLE[YYPACT[STATE-NUM]] -- What to do in state STATE-NUM.  If
   positive, shift that token.  If negative, reduce the rule whose
   number is the opposite.  If YYTABLE_NINF, syntax error.  */

  /** @var int[] */
  public array $yytable = array(     3,     4,     5,     6,     7,     8,     9,    10,    11,    12,
      13,    14,    15,    16,    17,    18,    19,    20,    21,    22,
      23,    24,    25,    26,    27,    28,    29,     1,    35,    36,
      37,    38,    39,    40,    41,    42,    43,    44,    33,    34,
      47,     0,     0,     0,    48);



  /** @var int[] */
  public array $yycheck = array(     4,     5,     6,     7,     8,     9,    10,    11,    12,    13,
      14,    15,    16,    17,    18,    19,    20,    21,    22,    23,
      24,    25,    26,    27,    28,    29,    30,     3,    31,    32,
      33,    34,    35,    36,    37,    38,    39,    40,     0,    41,
      34,    -1,    -1,    -1,    45);


/* YYSTOS[STATE-NUM] -- The symbol kind of the accessing symbol of
   state STATE-NUM.  */

  /** @var int[] */
  public array $yystos = array(     0,     3,    43,     4,     5,     6,     7,     8,     9,    10,
      11,    12,    13,    14,    15,    16,    17,    18,    19,    20,
      21,    22,    23,    24,    25,    26,    27,    28,    29,    30,
      44,    45,    46,     0,    41,    31,    32,    33,    34,    35,
      36,    37,    38,    39,    40,    47,    48,    44,    48);


/* YYR1[RULE-NUM] -- Symbol kind of the left-hand side of rule RULE-NUM.  */

  /** @var int[] */
  public array $yyr1 = array(     0,    42,    43,    44,    44,    44,    45,    46,    46,    46,
      46,    46,    46,    46,    46,    46,    46,    46,    46,    46,
      46,    46,    46,    46,    46,    46,    46,    46,    46,    46,
      46,    46,    46,    46,    47,    47,    47,    47,    47,    47,
      47,    47,    47,    47,    48,    48);


/* YYR2[RULE-NUM] -- Number of symbols on the right-hand side of rule RULE-NUM.  */

  /** @var int[] */
  public array $yyr2 = array(     0,     2,     2,     0,     1,     3,     2,     1,     1,     1,
       1,     1,     1,     1,     1,     1,     1,     1,     1,     1,
       1,     1,     1,     1,     1,     1,     1,     1,     1,     1,
       1,     1,     1,     1,     1,     1,     1,     1,     1,     1,
       1,     1,     1,     1,     0,     2);





  /* YYTRANSLATE(TOKEN-NUM) -- Symbol number corresponding to TOKEN-NUM
     as returned by yylex, with out-of-bounds checking.  */
  private function yytranslate(int $t): SymbolKind
  {
    // Last valid token kind.
    $code_max = 295;
    if ($t <= 0)
      return new SymbolKind(SymbolKind::S_YYEOF);
    else if ($t <= $code_max)
      return new SymbolKind($this->yytranslate_table[$t]);
    else
      return new SymbolKind(SymbolKind::S_YYUNDEF);
  }

  /** @var int[] */
  public array $yytranslate_table = array(     0,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,    41,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     2,     2,     2,     2,
       2,     2,     2,     2,     2,     2,     1,     2,     3,     4,
       5,     6,     7,     8,     9,    10,    11,    12,    13,    14,
      15,    16,    17,    18,    19,    20,    21,    22,    23,    24,
      25,    26,    27,    28,    29,    30,    31,    32,    33,    34,
      35,    36,    37,    38,    39,    40);



  public const YYLAST = 44;
  public const YYEMPTY = -2;
  public const YYFINAL = 33;
  public const YYNTOKENS = 42;


}
/* "grammar.y":124  */

