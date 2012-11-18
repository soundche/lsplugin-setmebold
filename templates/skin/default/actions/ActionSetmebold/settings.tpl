{include file='header.tpl'}

<form id="addSettings" action="" method="POST">
	<div class="setmebold-row setmebold-row-title">
		<div class="id">
			{$aLang.plugin.setmebold.id}
		</div>
		<div class="string">
			{$aLang.plugin.setmebold.string}
		</div>
		<div class="bold">
			<strong>{$aLang.plugin.setmebold.bold}</strong>
		</div>
		<div class="reference">
			{$aLang.plugin.setmebold.reference}
		</div>
		<!--  <div class="number">
			{$aLang.plugin.setmebold.number}
		</div>-->
		<div class="edit">
			{$aLang.plugin.setmebold.edit}
		</div>
		<div class="delete">
			{$aLang.plugin.setmebold.delete}
		</div>
	</div>
	{foreach from=$aSetmebold item=oSetmebold}
		<div class="setmebold-row">
			<div class="id">
				{$oSetmebold->getId()}
			</div>
			<div class="string">
				{$oSetmebold->getString()} {if $oSetmebold->getVariant() != ''}({$oSetmebold->getCountVariant()}){/if}
			</div>
			<div class="bold">
				{if $oSetmebold->getBold() == 1}
					<input type="checkbox" name="bold{$oSetmebold->getId()}" checked>
				{else}
					<input type="checkbox" name="bold{$oSetmebold->getId()}">
				{/if}
			</div>
			<div class="reference">
				{$oSetmebold->getReference()}
			</div>
			<!-- <div class="number">
				{$oSetmebold->getNumber()}
			</div> -->
			<div class="edit">
				<a  href="{router page="setmebold"}add?id={$oSetmebold->getId()}&string={$oSetmebold->getString()}&variant={$oSetmebold->getVariant()}&bold={$oSetmebold->getBold()}&reference={$oSetmebold->getReference()}&number={$oSetmebold->getNumber()}"><img alt="{$aLang.plugin.setmebold.edit_row}" title="{$aLang.plugin.setmebold.edit_row}" src="{$oConfig->GetValue('path.root.web')}/plugins/setmebold/templates/skin/default/css/image/edit.png" /></a>
			</div>
			<div class="delete" id="{$oSetmebold->getId()}">
				<input type="hidden" value="{$oSetmebold->getId()}">
				<img alt="{$aLang.plugin.setmebold.delete_row}" title="{$aLang.plugin.setmebold.delete_row}" src="{$oConfig->GetValue('path.root.web')}/plugins/setmebold/templates/skin/default/css/image/delete.png" />
			</div>
		</div>
	{/foreach}
</form>
<a id="addSetmeboldRow" href="{router page="setmebold"}add">{$aLang.plugin.setmebold.add_new_row}</a><br />

{literal}
<script type="text/javascript">
			jQuery(function($){
				$('.delete').click(function () {
					var url = aRouter.setmebold+'deleterow/';
					var params = {id: $(this).children().val()};
					ls.ajax(url, params, function(result){$('div#'+result.id).parent().slideUp()})
				}) 				
			});
</script>
{/literal}
{include file='footer.tpl'}