<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function getSkills(User $user)
    {
        $skills = $user->skills;
        return response([
            'skills' => $skills,
        ], 200);
    }

    public function addSkill(User $user)
    {
        $hasSkillExisting = $user->skills()->where('description', request()->description)->count();


        if (!$hasSkillExisting) {
            $user->skills()->create([
                'description' => request()->description,
            ]);
        }

        $skills = $user->skills;

        return response([
            'skills' => $skills,
        ], 200);
    }

    public function removeSkill(User $user, $id)
    {
        Skill::find($id)->delete();
        $skills = $user->skills;

        return response([
            'skills' => $skills,
        ], 200);
    }
}
