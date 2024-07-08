<?php

interface InterfaceSlugManager
{
    public function selectOneBySlug(string $slug);
}


interface InterfaceSlugManager {

    /**
     * Generates a unique slug from the interface name.
     *
     * @param string $name Interface name.
     * @param int $id (Optional) Interface ID to avoid slug conflicts with existing interfaces.
     * @return string Unique slug.
     */
    public function generateSlug(string $name, int $id = null): string;

    /**
     * Checks if a slug is already used for an interface.
     *
     * @param string $slug Slug to check.
     * @param int $id (Optional) Interface ID to exclude from the check (useful for updating).
     * @return bool True if slug exists for a different interface, false otherwise.
     */
    public function checkSlugUniqueness(string $slug, int $id = null): bool;

    // ... Other methods (findInterfaceBySlug) remain the same.

}