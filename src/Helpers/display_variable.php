<?php 

function display_variable($variable)
{
    if (is_bool($variable)) {
        if ($variable) {
            return '<div class="icon-text"><span class="icon has-text-success"><i class="fas fa-check-square">+</i></span></div>';
        } else {
            return '<span class="icon-text"><span class="icon has-text-danger"><i class="fas fa-check-square">-</i></span></span>';
        }
    } else if (is_scalar($variable)) {
        return e($variable);
    } else if (is_a($variable, \StdClass::class) && property_exists($variable, 'link')) {
        return '<a href="'.$variable->link.'">'.e($variable->text).'</a>';        
    } else if (is_array($variable)) {
        $return = '<div class="list">';
        foreach ($variable as $entry) {
            $return .= '<div class="list-item">'.display_variable($entry).'</div>';
        }
        return $return.'</div>';
    }
}

function make_link($link, $text)
{
    $result = new \StdClass();
    $result->link = $link;
    $result->text = $text;
    return $result;
}