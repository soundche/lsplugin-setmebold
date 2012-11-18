{include file='header.tpl'}
<a href="{router page="setmebold"}settings">{$aLang.plugin.setmebold.back_to_settings}</a>
<form method="post">
{if isset({$_aRequest.id}) AND {$_aRequest.id} != ''}
	<input type="hidden" name="id" value="{$_aRequest.id}">
{/if}
<span class="note">{$aLang.plugin.setmebold.add_new_row_notice}</span>
<label for="string">{$aLang.plugin.setmebold.sring_notice}</label>
<input name="string" id="string" size="30" type="text" value="{$_aRequest.string}">

<label for="variant">{$aLang.plugin.setmebold.variant_notice}</label>
<textarea name="variant" id="variant"  rows="5" cols="45">{$_aRequest.variant}</textarea>

<label for="bold">{$aLang.plugin.setmebold.bold_notice}</label>

{if isset({$_aRequest.bold}) AND {$_aRequest.bold} == '1'}
	<input name="bold" id="bold" type="checkbox" checked>
{else}
	<input name="bold" id="bold" type="checkbox">
{/if}
<label for="reference">{$aLang.plugin.setmebold.reference_notice}</label>
<input name="reference" id="reference" type="text" value="{$_aRequest.reference}">
<!-- 
<label for="number">{$aLang.plugin.setmebold.number_notice}</label>
{if isset({$_aRequest.number}) AND {$_aRequest.number} != ''}
	<input name="number" id="number" type="text" value="{$_aRequest.number}">
{else}
	<input name="number" id="number" type="text" value="0">
{/if}
 -->
<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" /> 
{if isset({$_aRequest.id}) AND {$_aRequest.id} != ''}
	<br /><input type="submit" name="add_new_setmebold" value="{$aLang.plugin.setmebold.submit_change}">
{else}
	<br /><input type="submit" name="add_new_setmebold" value="{$aLang.plugin.setmebold.add_new}">
{/if}

</form>
{include file='footer.tpl'}