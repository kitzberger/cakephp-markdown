<?php
declare(strict_types=1);

namespace Tanuck\Markdown\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use cebe\markdown\GithubMarkdown;
use cebe\markdown\Markdown;
use Tanuck\Markdown\View\Helper\MarkdownHelper;

class MarkdownHelperTest extends TestCase
{
    private MarkdownHelper $markdown;

    public function setUp(): void
    {
        parent::setUp();
        $this->markdown = new MarkdownHelper(new View());
    }

    public function tearDown(): void
    {
        unset($this->markdown);
        parent::tearDown();
    }

    public function testTransform(): void
    {
        $expected = "<h1>Markdown h1 header</h1>\n";
        $this->assertEquals($expected, $this->markdown->transform('# Markdown h1 header'));

        $this->assertInstanceOf(Markdown::class, $this->markdown->parser);

        $this->assertNull($this->markdown->transform(1234));
        $this->assertNull($this->markdown->transform(true));
        $this->assertNull($this->markdown->transform([]));
    }

    public function testParserClassSetOnLoad(): void
    {
        $markdown = new MarkdownHelper(new View(), ['parser' => 'GithubMarkdown']);

        $expected = "<p><del>Strikethrough text</del></p>\n";
        $this->assertEquals($expected, $markdown->transform('~~Strikethrough text~~'));

        $this->assertInstanceOf(GithubMarkdown::class, $markdown->parser);
    }
}
