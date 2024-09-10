<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-lending-system/app/UI/Borrow/@layout.latte */
final class Template_e956b4fd88 extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-lending-system/app/UI/Borrow/@layout.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo ' <!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الأدوات</title>
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- قائمة التنقل -->
<nav>
    <ul>
     
		<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Homepage:default')) /* line 16 */;
		echo '">الصفحة الرئيسية</a>
		<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Borrow:default')) /* line 17 */;
		echo '">تسجيل خروج الأدوات</a>
		<a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Return:default')) /* line 18 */;
		echo '">إعادة الأدوات</a>

';
		if ($user->isInRole('admin')) /* line 20 */ {
			echo '            <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Manage:default')) /* line 21 */;
			echo '">إدارة المنتجات</a>
';
		}
		echo '        <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:out')) /* line 23 */;
		echo '">تسجيل الخروج</a>

    </ul>
</nav>

';
		$this->renderBlock('content', [], 'html') /* line 28 */;
		echo '
</body>
</html>
';
	}
}
