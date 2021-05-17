{extends file='page.tpl'}
{block name='page_title'}
    {l s='Студены' mod='students'}
{/block}
{block name='page_content'}
    <table class="table">
        <thead>
            <th>№</th>
            <th>{l s='Имя' mod='students'}</th>
            <th>{l s='Дата рождения' mod='students'}</th>
            <th>{l s='Статус' mod='students'}</th>
            <th>{l s='Средний балл' mod='students'}</th>
        </thead>
        <tbody>
            {foreach $students as $k => $v}
            <tr>
                <td>{$v.id}</td>
                <td>{$v.name}</td>
                <td>{$v.date}</td>
                <td>{if $v.status == 1}{l s='Учится' mod='students'}{else}{l s='Отчислен' mod='students'}{/if}</td>
                <td>{$v.average_score}</td>
            </tr>
            {/foreach}
        </tbody>
    </table>
{/block}
