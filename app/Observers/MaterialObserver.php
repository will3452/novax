<?php

namespace App\Observers;

use App\Models\Material;

class MaterialObserver
{
    public function creating(Material $material)
    {
        if ($material->type == Material::TYPE_HYPERLINK) {
            $material->content = $material->link;
        } else {
            $material->content = $material->file;
        }

        unset($material->file);
        unset($material->link);
    }
}
