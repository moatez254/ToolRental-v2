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

		echo "\n";
		$this->renderBlock('content', get_defined_vars()) /* line 2 */;
	}


	/** {block content} on line 2 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
 
<div class="container">
    <h1>مرحبًا، ';
		echo LR\Filters::escapeHtmlText($user->identity->username) /* line 6 */;
		echo '</h1>
 
    <div class="canvas-container">
        <canvas id="availableToolsChart" width="400" height="400"></canvas>
        <canvas id="borrowedToolsChart" width="400" height="400"></canvas>
    </div>
</div>
 <script>
 
    var availableToolsData = ';
		echo LR\Filters::convertJSToHtmlRawText($availableToolsJson) /* line 15 */;
		echo ';
    var borrowedToolsData = ';
		echo LR\Filters::convertJSToHtmlRawText($borrowedToolsJson) /* line 16 */;
		echo ';

    
    console.log("Available Tools Data:", availableToolsData);
    console.log("Borrowed Tools Data:", borrowedToolsData);

    
    if (!Array.isArray(availableToolsData)) {
         
        availableToolsData = Object.values(availableToolsData);
    }

    if (!Array.isArray(borrowedToolsData)) {
        borrowedToolsData = Object.values(borrowedToolsData);
    }

     

    var ctx1 = document.getElementById(\'availableToolsChart\').getContext(\'2d\');
    new Chart(ctx1, {
        type: \'pie\',
        data: {
            labels: availableToolsData.map(tool => tool.name),  
            datasets: [{
                data: availableToolsData.map(tool => tool.quantity),  
                backgroundColor: [\'#36A2EB\', \'#FF6384\', \'#FFCE56\', \'#4BC0C0\']
            }]
        }
    });

    var ctx2 = document.getElementById(\'borrowedToolsChart\').getContext(\'2d\');
    new Chart(ctx2, {
        type: \'bar\',
        data: {
            labels: borrowedToolsData.map(tool => tool.name),  
            datasets: [{
                label: \'Borrowed Quantity\',
                data: borrowedToolsData.map(tool => tool.quantity), 
                backgroundColor: \'#FF6384\'
            }]
        }
    });
</script>

';
	}
}
