<?php
namespace Models\Users;

interface Person {
    function getName();
    function setName($name);
    function getAge();
    function setAge($age);
}

