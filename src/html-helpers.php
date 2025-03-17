<?php

    function htmlAttributes(array $attributes): string{
        $data = "";
        foreach ($attributes as $key => $attribute) {
            if($attribute === "disabled" || $attribute === "selected")
                $data .= $attribute;
            elseif($attribute){
                $data .= "{$key}='{$attribute}' ";
            }
        }
        return $data;
    }
    function htmlStartTag(string|bool|null $name, array $attributes): string{
        $attributes = htmlAttributes($attributes);
        return $name ? "<{$name} {$attributes}>" : '';
    }
    
    function htmlEndTag(string|bool|null $name){
        return $name ? "</{$name}>" : '';
    }
    function htmlTag(string|bool|null $name, array $attributes, string $text): string{
        if(!$name){
            return $text;
        }

        return htmlStartTag($name, $attributes) . $text . htmlEndTag($name);
    }
