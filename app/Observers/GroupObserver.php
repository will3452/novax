<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\GroupMember;

class GroupObserver
{
    public function created(Group $group)
    {
        // by default when the group was created, the system will automatically add the user who created the group as member.

        GroupMember::create([
            'group_id' => $group->id,
            'remarks' => "Group Creator",
            'account_member_id' => auth()->id(),
            'confirmed_at' => now(),
            'status' => GroupMember::STATUS_CONFIRMED,
        ]);
    }
}
