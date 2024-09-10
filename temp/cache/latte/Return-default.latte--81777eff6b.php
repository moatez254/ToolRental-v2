<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-lending-system/app/UI/Return/default.latte */
final class Template_81777eff6b extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-lending-system/app/UI/Return/default.latte';

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
			foreach (array_intersect_key(['borrow' => '4'], $this->params) as $ʟ_v => $ʟ_l) {
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

		echo '<h1>إعادة الأدوات</h1>
<form method="post">
';
		foreach ($borrows as $borrow) /* line 4 */ {
			echo '        <div>
            <label>';
			echo LR\Filters::escapeHtmlText($borrow->tool->name) /* line 6 */;
			echo ' - المستعار: ';
			echo LR\Filters::escapeHtmlText($borrow->quantity) /* line 6 */;
			echo '</label>
            <input type="number" name="quantities[';
			echo LR\Filters::escapeHtmlAttr($borrow->id) /* line 7 */;
			echo ']" min="1" max="';
			echo LR\Filters::escapeHtmlAttr($borrow->quantity) /* line 7 */;
			echo '" value="';
			echo LR\Filters::escapeHtmlAttr($borrow->quantity) /* line 7 */;
			echo '">
            <select name="status[';
			echo LR\Filters::escapeHtmlAttr($borrow->id) /* line 8 */;
			echo ']">
                <option value="good">سليمة</option>
                <option value="damaged">معطوبة</option>
                <option value="lost">مفقودة</option>
            </select>
        </div>
';

		}

		echo '    <button type="submit">إعادة الأدوات</button>
</form>
';
	}
}
