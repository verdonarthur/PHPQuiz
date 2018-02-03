<div class="field">
    {if !empty($options)}
        {if $isMultiple}
            <div class="control">
                {foreach from=$options item=option}
                    <label class="checkbox">
                        <input type="checkbox" value="{$option}"  name="questionId{$question->id}">
                        {$option}
                    </label>
                    <br>
                {/foreach}
            </div>
        {else}
            <div class="control">
                {foreach from=$options item=option}
                    <label class="radio">
                        <input type="radio" value="{$option}"  name="questionId{$question->id}">
                        {$option}
                    </label>
                    <br>
                {/foreach}
            </div>
        {/if}
    {else}
        <div class="control">
            <input class="input is-large" type="text" value=""  name="questionId{$question->id}" placeholder="Votre réponse">
        </div>
    {/if}
</div>