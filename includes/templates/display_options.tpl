{if $youtubeLink}
    <div style=" overflow:hidden;    padding-bottom:56.25%;    position:relative;    height:0;">
        <iframe style="left:0;    top:0;    height:100%;    width:100%;    position:absolute;" src="{$youtubeLink}"
                frameborder="0" allow="autoplay; encrypted-media"
                allowfullscreen></iframe>
    </div>
{/if}
<div class="field">

    {if !empty($options)}
        {if $isMultiple}
            <div class="control">
                {foreach from=$options item=option}
                    <label class="checkbox">
                        <input type="checkbox" value="{$option}" name="questionId{$question->id}">
                        {$option}
                    </label>
                    <br>
                {/foreach}
            </div>
        {else}
            <div class="control">
                {foreach from=$options item=option}
                    <label class="radio">
                        <input type="radio" value="{$option}" name="questionId{$question->id}">
                        {$option}
                    </label>
                    <br>
                {/foreach}
            </div>
        {/if}
    {else}
        <div class="control">
            <input class="input is-large" type="text" value="" name="questionId{$question->id}"
                   placeholder="Votre réponse">
        </div>
    {/if}
</div>