{**
* @package     EsayD
* @subpackage  Core
* @author      Stéphane Ramé <stephane.rame@dev-system.com>
* @version     v.1.0.0 (03/03/2019)
* @copyright   Copyright (c) 2019, Dev-System
*}

{extends file="core/base.tpl"}

{block "h1"}
    {$module->txt['addTitle']}
{/block}

{block "buttonTop"}
    <a href="{$module::$chemin}" class="btn btn-outline-secondary">
        <i class="fas fa-chevron-left"></i> Retour à la liste
    </a>
{/block}

{block "body"}

    <form method="post" action="" class="form-horizontal" role="form">
        <div class="infos">
            {Form::getElem('input-text', 'name', 'Nom *', {$entity->getName()|escape})}
            {Form::getElem('input-email', 'email', 'Email *', {$entity->getEmail()|escape})}
            {Form::getElem('input-text', 'number', 'Number', {$entity->getNumber()|escape})}
        </div>

        <div class="w-100 text-right">
            {Form::getSaveButton()}
        </div>

    </form>

{/block}

{block "footer"}
    <script src="{$pathDir}default/lib/js/emailCheck.js"/>
{/block}