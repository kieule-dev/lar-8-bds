<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class Template
{

    //======== SHOW BUTTON FILTER =========
    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentFilterStatus, $paramsSearch)
    { // $currentFilterStatus active inactive all
        $xhtml = null;
        $tmplStatus = Config::get('zvn.template.status');

        if (count($itemsStatusCount) > 0) {
            array_unshift($itemsStatusCount, [
                'count'   => array_sum(array_column($itemsStatusCount, 'count')),
                'status'  => 'all'
            ]);

            foreach ($itemsStatusCount as $item) {  // $item = [count,status]
                $statusValue = $item['status'];  // active inactive block
                $statusValue = array_key_exists($statusValue, $tmplStatus) ? $statusValue : 'default';

                $currentTemplateStatus = $tmplStatus[$statusValue]; // $value['status'] inactive block active
                $link = route($controllerName) . "?filter_status=" .  $statusValue;

                if ($paramsSearch['value'] !== '') {
                    $link .= "&search_field=" . $paramsSearch['field'] . "&search_value=" .  $paramsSearch['value'];
                }

                $class  = ($currentFilterStatus == $statusValue) ? 'btn-danger' : 'btn-info';
                $xhtml  .= sprintf('<a href="%s" type="button" class="btn %s">
                                    %s <span class="badge bg-white">%s</span>
                                </a>', $link, $class, $currentTemplateStatus['name'], $item['count']);
            }
        }

        return $xhtml;
    }

    public static function showAreaSearch($controllerName, $paramsSearch)
    {
        $xhtml = null;
        $tmplField         = Config::get('zvn.template.search');
        $fieldInController = Config::get('zvn.config.search');

        $controllerName = (array_key_exists($controllerName, $fieldInController)) ? $controllerName : 'default';
        $xhtmlField = null;

        foreach ($fieldInController[$controllerName] as $field) { // all id
            $xhtmlField .= sprintf('<li><a href="#" class="select-field" data-field="%s">%s</a></li>', $field, $tmplField[$field]['name']);
        }

        $searchField = (in_array($paramsSearch['field'],  $fieldInController[$controllerName])) ? $paramsSearch['field'] : "all";

        $xhtml = sprintf('
            <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle btn-active-field" data-toggle="dropdown" aria-expanded="false">
                        %s <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        %s
                    </ul>
                </div>
                <input type="text" name="search_value" value="%s" class="form-control" >
                <input type="hidden" name="search_field" value="%s">
                <span class="input-group-btn">
                    <button id="btn-clear-search" type="button" class="btn btn-success" style="margin-right: 0px">Clear search </button>
                    <button id="btn-search" type="button" class="btn btn-primary">Search</button>
                </span>
            </div>', $tmplField[$searchField]['name'], $xhtmlField, $paramsSearch['value'], $searchField);
        return $xhtml;
    }

    public static function showItemHistory($by, $time)
    {


        $xhtml = sprintf(
            '<p><i class="fa fa-user"></i> %s</p>
            <p><i class="fa fa-clock-o "></i> %s</p>',
            $by,
            date(Config::get('zvn.format.short_time'), strtotime($time))
        );
        return $xhtml;
    }
    public static function showItemHistory1($time)
    {


        $xhtml = sprintf(
            '
            <p><i class="fa fa-clock-o "></i> %s</p>',

            date(Config::get('zvn.format.long_time'), strtotime($time))
        );
        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $statusValue)
    {
        $tmplStatus = Config::get('zvn.template.status');
        $statusValue        = array_key_exists($statusValue, $tmplStatus) ? $statusValue : 'default';
        $currentTemplateStatus = $tmplStatus[$statusValue];
        $link          = route($controllerName . '/status', ['status' => $statusValue, 'id' => $id]);

        $xhtml = sprintf(
            '<button data-url="%s" type="button" data-class="%s" class="btn btn-round %s status-ajax">%s</button>',
            $link,
            $currentTemplateStatus['class'],
            $currentTemplateStatus['class'],
            $currentTemplateStatus['name']
        );
        return $xhtml;
    }


    public static function showItemSelect($controllerName, $id, $displayValue, $fieldName)
    {
        $link          = route($controllerName . '/' . $fieldName, [$fieldName => 'value_new', 'id' => $id]);

        $tmplDisplay = Config::get('zvn.template.' . $fieldName);
        $xhtml = sprintf('<select name="select_change_attr" data-url="%s" class="form-control">', $link);

        foreach ($tmplDisplay as $key => $value) {

            $xhtmlSelected = '';
            if (ucfirst($key) == $displayValue) $xhtmlSelected = 'selected="selected"';
            $xhtml .= sprintf('<option value="%s" %s>%s</option>', $key, $xhtmlSelected, $value['name']);
        }
        $xhtml .= '</select>';

        return $xhtml;
    }

    public static function showItemSelect1($controllerName, $id, $displayValue, $fieldName, $category_name)
    {
        $link          = route($controllerName . '/' . $fieldName, [$fieldName => 'value_new', 'id' => $id]);
        $xhtml = sprintf('<select name="select_change_attr" data-url="%s" class="form-control">', $link);

        foreach ($displayValue as $key => $value) {

            $xhtmlSelected = '';
            if ($value == $category_name) $xhtmlSelected = 'selected="selected"';
            $xhtml .= sprintf('<option value="%s" %s>%s</option>', $key, $xhtmlSelected, $value);
        }
        $xhtml .= '</select>';

        return $xhtml;
    }

    public static function showItemThumb1($controllerName, $thumbName, $thumbAlt, $w = 200, $h = 100)
    {

        // dd($thumbAlt);

        $xhtml = sprintf(
            '<img src="%s" width="%s" height="%s" alt="%s">',
            asset("images/$controllerName") . "/$thumbName",
            $w,
            $h,
            $thumbAlt
        );
        return $xhtml;
    }

    public static function showItemThumb($controllerName, $thumbName, $thumbAlt)
    {
        $xhtml = sprintf(
            '<img src="%s" alt="%s" class="zvn-thumb">',
            asset("images/$controllerName/$thumbName"),
            $thumbAlt
        );
        return $xhtml;
    }
    public static function showItemThumb2($controllerName, $thumbName, $thumbAlt)
    {
        $xhtml = sprintf(
            '<img src="%s" alt="%s" class="zvn-thumb1">',
            asset("images/$controllerName/$thumbName"),
            $thumbAlt
        ); //zvn-thumb
        return $xhtml;
    }
    public static function showItemThumbs($controllerName, $thumbName, $thumbAlt)
    {
        $thumbName =  json_decode($thumbName, true);
        // dd($thumbName);
        $xhtml = '';

        if ($thumbName != '') {
            foreach ($thumbName as $value) {

                $xhtml .= sprintf(
                    '<img src="%s" alt="%s" class="zvn-thumb2">',
                    asset("images/$controllerName/$value"),
                    $thumbAlt
                );
            }
        }

        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        $tmplButton   = Config::get('zvn.template.button');
        $buttonInArea = Config::get('zvn.config.button');

        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : "default";
        $listButtons    = $buttonInArea[$controllerName]; // ['edit', 'delete']

        $xhtml = '<div class="zvn-box-btn-filter">';

        foreach ($listButtons as $btn) {
            $currentButton = $tmplButton[$btn];

            $link = route($controllerName . $currentButton['route-name'], ['id' => $id]);
            $xhtml .= sprintf(
                '<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" 
                    data-original-title="%s">
                    <i class="fa %s"></i>
                </a>',
                $link,
                $currentButton['class'],
                $currentButton['title'],
                $currentButton['icon']
            );
        }

        $xhtml .= '</div>';

        return $xhtml;
    }

    public static function showDatetimeFrontend($dateTime)
    {
        return date_format(date_create($dateTime), Config::get('zvn.format.short_time'));
    }

    public static function showContent($content, $length, $prefix = '...')
    {
        $prefix = ($length == 0) ? '' : $prefix;
        $content = str_replace(['<p>', '</p>'], '', $content);
        return preg_replace('/\s+?(\S+)?$/', '', substr($content, 0, $length)) . $prefix;
    }
}
