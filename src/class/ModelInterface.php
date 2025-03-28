<?php

interface ModelInterface
{
    public function selectAll() : null|array;
    public function selectById(int $id) : null|object;
    // public function insert(object $object) : void;
}