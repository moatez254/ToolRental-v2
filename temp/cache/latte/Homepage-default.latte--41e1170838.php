<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-lending-system/app/UI/Homepage/default.latte */
final class Template_41e1170838 extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-lending-system/app/UI/Homepage/default.latte';

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


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<h1>Welcome, ';
		echo LR\Filters::escapeHtmlText($user->identity->username) /* line 2 */;
		echo '</h1>

<canvas id="toolsChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById(\'toolsChart\').getContext(\'2d\');
    var chart = new Chart(ctx, {
        type: \'bar\',
        data: {
            labels: ';
		echo LR\Filters::convertJSToHtmlRawText($toolNamesJson) /* line 12 */;
		echo ',
            datasets: [{
                label: \'Available Tools\',
                data: ';
		echo LR\Filters::convertJSToHtmlRawText($toolQuantitiesJson) /* line 15 */;
		echo ',
                backgroundColor: \'rgba(54, 162, 235, 0.6)\'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
';
	}
}
