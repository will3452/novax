<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\Account;

use App\Models\GroupMember;
use function PHPUnit\Framework\isEmpty;

class GroupMemberObserver
{
    public function getAccountOnGroup($groupId): Account
    {
        $group = Group::find($groupId);

        $accountIds = auth()->user()->accounts()->pluck('id')->toArray();

        //the reason why account ids use loop because account might not be numerous.
        foreach ($accountIds as $aId) {
            $isExists = $group->members->where('account_member_id', $aId)->count();

            if ($isExists) {
                return Account::find($aId); // return the account id
            }
        }
    }
    public function creating(GroupMember $member)
    {
        $account = $this->getAccountOnGroup($member->group_id);

        if (! $account) {
            $member->group_id = null; // this will prevent the wrong moves of the user,
        }

        $member->account_requestor_id = $account->id;
        if (isEmpty($member->remarks)) {
            $member->remarks = "Added by $account->penname";
        }
    }
}
