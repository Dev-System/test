{**
* @package     EsayD
* @subpackage  Core
* @author      Stéphane Ramé <stephane.rame@dev-system.com>
* @version     v.1.0.0 (03/03/2019)
* @copyright   Copyright (c) 2019, Dev-System
*}

{extends file="core/base.tpl"}

{block "h1"}
    {$module->txt['listTitle']} ({$nbtotal})
{/block}

{block "buttonTop"}
    {if $barre_nav2}
        <div id="BarreNav">
            {$barre_nav2}
        </div>
    {/if}
{/block}

{block name="body"}

    <div class="liste">

        <form method="post" action="">
            <div class="recherche">

                <!-- Recherche par champs -->
                <div class="row form-group ml-sm-1">
                    <label class="col-sm-auto col-form-label text-md-right">Recherche&nbsp;:</label>
                    <div class="col-sm-8 col-md-6 col-lg-4 pr-sm-0">
                        <input type="text" name="what" value="{$recherche.what|escape}" class="form-control form-control-sm" id="what">
                    </div>
                    <div class="col-sm-auto pl-sm-0 pr-sm-0">
                        <select name="where" class="form-control form-control-sm">
                            <option value="name" {if $recherche.where == 'name'}selected="selected"{/if}>Nom</option>
                            <option value="email" {if $recherche.where == 'email'}selected="selected"{/if}>Email</option>
                        </select>
                    </div>
                    <div class="col-sm-auto pl-sm-0">
                        <select name="exact" class="form-control form-control-sm">
                            <option value="" {if $recherche.exact == ''}selected="selected"{/if}>Contient...</option>
                            <option value="=" {if $recherche.exact == '='}selected="selected"{/if}>Est égal à...</option>
                            <option value="x%" {if $recherche.exact == 'x%'}selected="selected"{/if}>Commence par...</option>
                            <option value="%x" {if $recherche.exact == '%x'}selected="selected"{/if}>Se termine par...</option>
                            <option value=">" {if $recherche.exact == '>'}selected="selected"{/if}>Supérieur à...</option>
                            <option value="<" {if $recherche.exact == '<'}selected="selected"{/if}>Inférieur à...</option>
                            <option value=">=" {if $recherche.exact == '>='}selected="selected"{/if}>Supérieur ou égal à...</option>
                            <option value="<=" {if $recherche.exact == '<='}selected="selected"{/if}>Inférieur ou égal à...</option>
                        </select>
                    </div>
                </div>
                <!-- Recherche par champs / end -->

                <!-- Zone des critères de recherche -->
                <div class="w-100 d-block d-sm-none mb-2">
                    <button class="btn btn-outline-secondary" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#SearchParameters" 
                            aria-expanded="true" 
                            aria-controls="SearchParameters">
                        <i class="fas fa-plus" id="IconeSearchParameters"></i> de critères
                    </button>
                </div>
                <div class="collapse dont-collapse-sm" id="SearchParameters">
                    <div class="d-flex flex-wrap collapse">

                        <!-- Activé -->
                        <div class="row form-group ml-sm-1">
                            <label class="col-sm-auto col-form-label text-sm-right">Activé :</label>
                            <div class="col-sm-auto">
                                <select name="active" class="form-control form-control-sm">
                                    <option value="">Tous</option>
                                    <option value="true" {if $recherche.active=='true'}selected="selected"{/if}>oui</option>
                                    <option value="false" {if $recherche.active=='false'}selected="selected"{/if}>non</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Zone des critères de recherche / end -->

                <div class="row">
                    <div class="col-sm-6 text-center py-2">
                        {if $recherche}
                            <div class="mt-2">
                                <button type="submit" name="submit" value="reset" class="btn btn-outline-secondary">
                                    <i class="fas fa-eraser"></i> Effacer
                                </button>
                            </div>
                        {/if}
                    </div>
                    <div class="col-sm-6 text-center py-2">
                        <button type="submit" name="submit" value="recherche" class="btn btn-outline-secondary">
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </div>
                </div>

            </div>
        </form>

        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th class="text-center">Activé</th>
                <th></th>
            </tr>
            {section name=liste loop=$liste}
                <tr class="{if $smarty.section.liste.index % 2 == 1}fonce{else}clair{/if} lien" 
                    onclick="window.open('{$module::$chemin}?a=edit&id={$liste[liste].id}', '_self');">
                    <td>{$liste[liste].name}</td>
                    <td>{$liste[liste].email}</td>
                    <td class="text-center">
                        {if $liste[liste].active}
                            <i class="fas fa-check fa-lg text-success" title="oui"></i>
                        {else}
                            <i class="fas fa-times fa-lg text-danger" title="non"></i>
                        {/if}
                    </td>
                    <td class="text-center"><i class="fas fa-chevron-right"></i></td>
                </tr>
            {sectionelse}
                <tr><td colspan="3" class="text-center"><i>Aucun résultat...</i></td></tr>
            {/section}	
        </table>
    </div>

    <div class="text-sm-right">
        <a href="{$module::$chemin}?a=add" class="btn btn-outline-secondary">
            <i class="fas fa-plus"></i> {$module->txt['addButton']}
        </a>
    </div>

{/block}

{block "footer"}
    {literal}
        <script>
            $(document).ready(function () {

                $('.lienLeft', window.parent.document).each(function () {
                    $(this, window.parent.document).removeClass("hover");
                });
                $('.default', window.parent.document).addClass("hover");

            });
        </script>
    {/literal}
{/block}
