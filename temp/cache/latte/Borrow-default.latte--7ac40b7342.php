<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-lending-system/app/UI/Borrow/default.latte */
final class Template_7ac40b7342 extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-lending-system/app/UI/Borrow/default.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['tool' => '4'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '    <h1>تسجيل خروج الأدوات</h1>
    <form method="post">
';
		foreach ($tools as $tool) /* line 4 */ {
			echo '            <div>
                <label for="tool-';
			echo LR\Filters::escapeHtmlAttr($tool->id) /* line 6 */;
			echo '">';
			echo LR\Filters::escapeHtmlText(($this->filters->escapeHtml)($tool->name)) /* line 6 */;
			echo ' المتوفر: ';
			echo LR\Filters::escapeHtmlText(($this->filters->escapeHtml)($tool->quantity)) /* line 6 */;
			echo '</label>
                <input type="number" id="tool-';
			echo LR\Filters::escapeHtmlAttr($tool->id) /* line 7 */;
			echo '" name="quantities[';
			echo LR\Filters::escapeHtmlAttr($tool->id) /* line 7 */;
			echo ']" min="1" max="';
			echo LR\Filters::escapeHtmlAttr($tool->quantity) /* line 7 */;
			echo '" value="1">
                <input type="hidden" name="toolIds[';
			echo LR\Filters::escapeHtmlAttr($tool->id) /* line 8 */;
			echo ']" value="';
			echo LR\Filters::escapeHtmlAttr($tool->id) /* line 8 */;
			echo '">
            </div>
';

		}

		echo '        <button type="submit">تسجيل خروج الأدوات</button>
    </form>
';
	}
}
