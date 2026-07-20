<?php
declare(strict_types=1);

namespace Tanuck\Markdown\View\Helper;

use Cake\View\Helper;

class MarkdownHelper extends Helper
{
    protected array $_defaultConfig = [
        'parser' => 'Markdown',
    ];

    public ?object $parser = null;

    /**
     * Parse Markdown input to HTML.
     *
     * @param mixed $input Markdown to be parsed.
     * @return string|null
     */
    public function transform(mixed $input): ?string
    {
        if (!is_string($input)) {
            return null;
        }

        if ($this->parser === null) {
            $className = "cebe\\markdown\\{$this->getConfig('parser')}";
            $this->parser = new $className();
            $this->parser->html5 = true;
        }

        return $this->parser->parse($input);
    }
}
