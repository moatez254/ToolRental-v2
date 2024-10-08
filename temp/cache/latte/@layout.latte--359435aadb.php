<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-lending-system/app/UI/@layout.latte */
final class Template_359435aadb extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-lending-system/app/UI/@layout.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo ' <!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Správa nástrojů</title>
    
    <link rel="stylesheet" href="/css/styles.css">
     
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<nav>
    <ul>
        <li><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Homepage:default')) /* line 18 */;
		echo '" class="active">Hlavní stránka</a></li>
        <li><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Borrow:default')) /* line 19 */;
		echo '">Vypůjčení nástrojů</a></li>
        <li><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Return:default')) /* line 20 */;
		echo '">Vrácení nástrojů</a></li>

';
		if ($user->isInRole('admin')) /* line 22 */ {
			echo '            <li><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Manage:default')) /* line 23 */;
			echo '">Správa produktů</a></li>
';
		}
		echo '
        <li><a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Sign:out')) /* line 26 */;
		echo '">Odhlásit se</a></li>
    </ul>
</nav>

<div class="container">
';
		$this->renderBlock('content', [], 'html') /* line 31 */;
		echo '</div>

</body>
</html>
';
	}
}
