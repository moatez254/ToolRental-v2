<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-lending-system/app/UI/Sign/in.latte */
final class Template_2d1c279b00 extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-lending-system/app/UI/Sign/in.latte';


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<h1>تسجيل الدخول</h1>

';
		$form = $this->global->formsStack[] = $this->global->uiControl['signInForm'] /* line 3 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo '<form';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), [], false) /* line 3 */;
		echo '>
    <div>
        <label for="username">اسم المستخدم:</label>
        <input type="text"';
		echo ($ʟ_elem = Nette\Bridges\FormsLatte\Runtime::item('username', $this->global)->getControlPart())->addAttributes(['type' => null, 'id' => null, 'required' => null])->attributes() /* line 6 */;
		echo ' id="username" required>
    </div>

    <div>
        <label for="password">كلمة المرور:</label>
        <input type="password"';
		echo ($ʟ_elem = Nette\Bridges\FormsLatte\Runtime::item('password', $this->global)->getControlPart())->addAttributes(['type' => null, 'id' => null, 'required' => null])->attributes() /* line 11 */;
		echo ' id="password" required>
    </div>

    <div>
        <button type="submit">تسجيل الدخول</button>
    </div>
';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(end($this->global->formsStack), false) /* line 3 */;
		echo '</form>
';
		array_pop($this->global->formsStack);
		echo '

';
		if ($form->errors) /* line 20 */ {
			echo '    <ul class="errors">
';
			foreach ($form->errors as $error) /* line 22 */ {
				echo '            <li>';
				echo LR\Filters::escapeHtmlText($error) /* line 23 */;
				echo '</li>
';

			}

			echo '    </ul>
';
		}
		echo ' <link rel="stylesheet" href="/css/styles.css">


';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['error' => '22'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}
}
