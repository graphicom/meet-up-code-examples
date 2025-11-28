<?php
class ParentClass
{
    protected string $status = 'active';
}

class ChildClass extends ParentClass
{
    // ✅ OK: This property exists in the parent class
    #[Override]
    protected string $status = 'suspended';

    // ❌ ERROR: If you misspell the property name in the child class:
    // #[Override]
    // protected string $statuss = 'error';
    // PHP will throw a compile-time error, because 'statuss' does not exist
    // in the parent class, ensuring the intent is clear.
}